param(
[Parameter(Mandatory = $true)]
[string]$UserTask
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest
. (Join-Path $PSScriptRoot "theme-structure.ps1")

function Write-Die([string]$Message) {
Write-Error $Message
exit 1
}

function Get-RepoRoot {
$here = Resolve-Path $PSScriptRoot | Select-Object -ExpandProperty Path
return (Resolve-Path (Join-Path $here "..") | Select-Object -ExpandProperty Path)
}

function Ensure-Ollama([string]$BaseUri, [string]$Model) {
try {
$tags = Invoke-RestMethod -Method Get -Uri "$BaseUri/api/tags" -TimeoutSec 5
} catch {
Write-Die "Ollama is not reachable at $BaseUri. Start Ollama and retry."
}

$installed = @($tags.models | ForEach-Object { $_.name })
if ($installed -notcontains $Model) {
Write-Die "Required Ollama model '$Model' is not installed. Install it locally with: ollama pull $Model"
}
}

function Get-LatestThemeVersion([string]$ThemesDir) {
$max = 0

if (-not (Test-Path -LiteralPath $ThemesDir)) {
return 0
}

Get-ChildItem -LiteralPath $ThemesDir -Directory -ErrorAction Stop |
Where-Object { $_.Name -match '^nolan-young-showcase-theme-x(\d+)$' } |
ForEach-Object {
$v = [int]([regex]::Match($_.Name, '^nolan-young-showcase-theme-x(\d+)$').Groups[1].Value)
if ($v -gt $max) { $max = $v }
}

return $max
}

function Should-KeepFailedOutput {
$v = $env:OLLAMA_KEEP_FAILED_OUTPUT
if ($null -eq $v) { return $false }
$v = $v.Trim().ToLowerInvariant()
return ($v -in @("1", "true", "yes", "y", "on"))
}

$root = Get-RepoRoot
$model = "qwen2.5-coder:14b"
if ($env:OLLAMA_MODEL) { $model = $env:OLLAMA_MODEL }

$baseUri = "http://localhost:11434"
Ensure-Ollama -BaseUri $baseUri -Model $model

$themesDir = Join-Path $root "wp-content/themes"
$latestVersion = Get-LatestThemeVersion -ThemesDir $themesDir

$nextVersion = $latestVersion + 1
$THEME_VERSION = $nextVersion
$THEME_SLUG = "nolan-young-showcase-theme-x{0:D2}" -f $THEME_VERSION
$THEME_DISPLAY_NAME = "Nolan Young Showcase Theme X{0:D2}" -f $THEME_VERSION
$THEME_DIR = "wp-content/themes/$THEME_SLUG"
$PREVIEW_DIR = "docs/themes/$THEME_SLUG"
$THEME_ZIP = "zippedTheme/$THEME_SLUG.zip"

$createdThemeFull = Join-Path $root $THEME_DIR
$createdPreviewFull = Join-Path $root $PREVIEW_DIR
$createdZipFull = Join-Path $root $THEME_ZIP
$docsIndexPath = Join-Path $root "docs/index.html"

$docsIndexBefore = $null
if (Test-Path -LiteralPath $docsIndexPath) {
$docsIndexBefore = Get-Content -LiteralPath $docsIndexPath -Raw
}

Write-Output "THEME_SLUG=$THEME_SLUG"
Write-Output "THEME_DISPLAY_NAME=$THEME_DISPLAY_NAME"
Write-Output "GROUPED_BUILDER_MODE=1"

New-Item -ItemType Directory -Force (Join-Path $root $THEME_DIR) | Out-Null
New-Item -ItemType Directory -Force (Join-Path $root $PREVIEW_DIR) | Out-Null

$keepFailed = Should-KeepFailedOutput

# Large-prompt safety:
# Disable latest-theme context unless the caller explicitly set it differently.
if (-not $env:OLLAMA_DISABLE_LATEST_CONTEXT) {
$env:OLLAMA_DISABLE_LATEST_CONTEXT = "1"
}

$latestSlug = ""
$latestThemeDir = ""
$latestPreviewDir = ""

if ($latestVersion -ge 1) {
$latestSlug = "nolan-young-showcase-theme-x{0:D2}" -f $latestVersion
$latestThemeDir = "wp-content/themes/$latestSlug"
$latestPreviewDir = "docs/themes/$latestSlug"
}

$stages = @(
@{
Name = "WordPress core PHP files"
Files = @(
"wp-content/themes/$THEME_SLUG/style.css",
"wp-content/themes/$THEME_SLUG/functions.php",
"wp-content/themes/$THEME_SLUG/index.php",
"wp-content/themes/$THEME_SLUG/header.php",
"wp-content/themes/$THEME_SLUG/footer.php",
"wp-content/themes/$THEME_SLUG/front-page.php",
"wp-content/themes/$THEME_SLUG/page.php",
"wp-content/themes/$THEME_SLUG/single.php",
"wp-content/themes/$THEME_SLUG/archive.php",
"wp-content/themes/$THEME_SLUG/search.php",
"wp-content/themes/$THEME_SLUG/404.php",
"wp-content/themes/$THEME_SLUG/comments.php",
"wp-content/themes/$THEME_SLUG/template-parts/content.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-page.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-none.php"
)
}
@{
Name = "WordPress theme CSS and JavaScript assets"
Files = @(
"wp-content/themes/$THEME_SLUG/assets/css/main.css",
"wp-content/themes/$THEME_SLUG/assets/js/bundle.js"
)
}
@{
Name = "Static preview files"
Files = @(
"docs/themes/$THEME_SLUG/index.html",
"docs/themes/$THEME_SLUG/assets/css/preview.css",
"docs/themes/$THEME_SLUG/assets/js/preview.js"
)
}
@{
Name = "Docs gallery index"
Files = @(
"docs/index.html"
)
}
)

try {
foreach ($stage in $stages) {
$stageName = [string]$stage.Name
$stageFiles = @($stage.Files)
$stageFileList = ($stageFiles | ForEach-Object { "- $_" }) -join "`n"

$stageTask = @"
GROUPED BUILDER STAGE

Stage name:
$stageName

Theme:
$THEME_DISPLAY_NAME

Theme slug:
$THEME_SLUG

Original user prompt remains authoritative:
$UserTask

For this grouped stage, output ONLY these files:

$stageFileList

Rules for this stage:
- Output file blocks only.
- First non-empty characters must be ---FILE:
- Do not output JSON.
- Do not output markdown fences.
- Do not output explanations.
- Do not output files outside the listed paths.
- Do not output files from other stages.
- Each listed file must be complete and production-ready.
- Use local-only assets and vanilla WordPress/PHP/HTML/CSS/JS.

Required WordPress asset-loading rules:
- If this stage includes functions.php, functions.php must call wp_enqueue_style.
- If this stage includes functions.php, functions.php must contain the exact literal text assets/css/main.css.
- If this stage includes functions.php, functions.php must enqueue assets/css/main.css using get_template_directory_uri().
- If this stage includes functions.php, functions.php should enqueue assets/js/bundle.js using get_template_directory_uri() when that file exists.
- Do not rely only on get_stylesheet_uri(); the generated stylesheet must be assets/css/main.css.

Required preview asset-loading rules:
- If this stage includes docs/themes/{{THEME_SLUG}}/index.html, that HTML must contain the exact literal text assets/css/preview.css.
- If this stage includes docs/themes/{{THEME_SLUG}}/index.html, that HTML should also reference assets/js/preview.js.
"@

Write-Output ""
Write-Output "Running Builder Agent stage: $stageName"
& (Join-Path $PSScriptRoot "ollama-agent.ps1") `
-Agent "builder" `
-UserTask $stageTask `
-ThemeSlug $THEME_SLUG `
-ThemeDisplayName $THEME_DISPLAY_NAME `
-ThemeVersion $THEME_VERSION `
-ThemeDir $THEME_DIR `
-PreviewDir $PREVIEW_DIR `
-ThemeZip $THEME_ZIP `
-Model $model `
-LatestThemeSlug $latestSlug `
-LatestThemeDir $latestThemeDir `
-LatestPreviewDir $latestPreviewDir | Out-Null
}
$themeReadmePath = Join-Path $root (Join-Path $THEME_DIR "README.md")

$themeReadmeLines = @(
"# $THEME_DISPLAY_NAME",
"",
"Generated by the local-only Ollama WordPress theme pipeline.",
"",
"## Theme Slug",
"",
"$THEME_SLUG",
"",
"## Contents",
"",
"This theme includes classic WordPress PHP templates, local CSS, local JavaScript, and a matching static GitHub Pages preview.",
"",
"## Local-Only Rules",
"",
"- No OpenAI API usage.",
"- No external AI services.",
"- No remote runtime dependencies.",
"- No API keys or secrets.",
"- Assets should remain local to the theme or preview.",
"",
"## Generated Paths",
"",
"- WordPress theme: $THEME_DIR",
"- Static preview: $PREVIEW_DIR",
"- ZIP package: $THEME_ZIP"
)

$themeReadme = $themeReadmeLines -join "`r`n"
Set-Content -LiteralPath $themeReadmePath -Value $themeReadme -Encoding UTF8
Ensure-ThemeStructure `
-Root $root `
-ThemeDir $THEME_DIR `
-ThemeSlug $THEME_SLUG `
-ThemeDisplayName $THEME_DISPLAY_NAME `
-PreviewDir $PREVIEW_DIR `
-ThemeZip $THEME_ZIP
Ensure-PreviewStructure `
-Root $root `
-PreviewDir $PREVIEW_DIR `
-ThemeSlug $THEME_SLUG `
-ThemeDisplayName $THEME_DISPLAY_NAME





Write-Output ""
Write-Output "Running local validation..."
& (Join-Path $PSScriptRoot "validate-themes.ps1") -ThemeSlug $THEME_SLUG
} catch {
if (-not $keepFailed) {
if (Test-Path -LiteralPath $createdThemeFull) {
Remove-Item -LiteralPath $createdThemeFull -Recurse -Force -ErrorAction SilentlyContinue
}

if (Test-Path -LiteralPath $createdPreviewFull) {
Remove-Item -LiteralPath $createdPreviewFull -Recurse -Force -ErrorAction SilentlyContinue
}

if (Test-Path -LiteralPath $createdZipFull) {
Remove-Item -LiteralPath $createdZipFull -Force -ErrorAction SilentlyContinue
}

if ($null -ne $docsIndexBefore) {
Set-Content -LiteralPath $docsIndexPath -Value $docsIndexBefore -Encoding UTF8 -NoNewline
}

Write-Warning "Grouped workflow failed; cleaned up generated theme/preview/zip and restored docs/index.html. Set OLLAMA_KEEP_FAILED_OUTPUT=1 to keep partial outputs."
}

throw
}

Write-Output ""
Write-Output "Created theme:   $(Join-Path $root $THEME_DIR)"
Write-Output "Created preview: $(Join-Path $root $PREVIEW_DIR)"
Write-Output "ZIP:             $(Join-Path $root $THEME_ZIP)"
Write-Output ""
Write-Output "Manual git commands:"
Write-Output "  cd `"$root`""
Write-Output "  git status"
Write-Output "  git add -f $THEME_DIR $PREVIEW_DIR $THEME_ZIP"
Write-Output "  git add docs/index.html"
Write-Output "  git commit -m `"Add $THEME_SLUG (Ollama grouped local-only)`""
Write-Output "  git push"







