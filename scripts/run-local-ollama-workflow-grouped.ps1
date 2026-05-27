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
$stylePath = Join-Path $_.FullName "style.css"

# Failed or interrupted runs can leave empty local folders behind.
# Empty folders are not tracked by Git, but they can still exist on disk.
# Only folders with a real style.css count as completed generated themes.
if (Test-Path -LiteralPath $stylePath) {
$v = [int]([regex]::Match($_.Name, '^nolan-young-showcase-theme-x(\d+)$').Groups[1].Value)
if ($v -gt $max) { $max = $v }
}
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
Name = "Core theme bootstrap files"
Files = @(
"wp-content/themes/$THEME_SLUG/style.css",
"wp-content/themes/$THEME_SLUG/functions.php",
"wp-content/themes/$THEME_SLUG/theme.json",
"wp-content/themes/$THEME_SLUG/README.md",
"wp-content/themes/$THEME_SLUG/.editorconfig",
"wp-content/themes/$THEME_SLUG/.gitignore",
"wp-content/themes/$THEME_SLUG/index.php",
"wp-content/themes/$THEME_SLUG/header.php",
"wp-content/themes/$THEME_SLUG/footer.php",
"wp-content/themes/$THEME_SLUG/front-page.php",
"wp-content/themes/$THEME_SLUG/page.php",
"wp-content/themes/$THEME_SLUG/single.php",
"wp-content/themes/$THEME_SLUG/archive.php",
"wp-content/themes/$THEME_SLUG/search.php",
"wp-content/themes/$THEME_SLUG/404.php",
"wp-content/themes/$THEME_SLUG/comments.php"
)
}
@{
Name = "Theme setup and inc files"
Files = @(
"wp-content/themes/$THEME_SLUG/inc/setup.php",
"wp-content/themes/$THEME_SLUG/inc/enqueue.php",
"wp-content/themes/$THEME_SLUG/inc/template-tags.php",
"wp-content/themes/$THEME_SLUG/inc/helpers.php",
"wp-content/themes/$THEME_SLUG/inc/custom-post-types.php",
"wp-content/themes/$THEME_SLUG/inc/customizer.php"
)
}
@{
Name = "Homepage template parts"
Files = @(
"wp-content/themes/$THEME_SLUG/template-parts/content-hero.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-brand-statement.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-featured-work.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-services.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-process.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-style-pillars.php"
)
}
@{
Name = "Secondary template parts"
Files = @(
"wp-content/themes/$THEME_SLUG/template-parts/content-testimonials.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-resources-preview.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-final-cta.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-footer-widgets.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-none.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-page.php",
"wp-content/themes/$THEME_SLUG/template-parts/content-single.php"
)
}
@{
Name = "Page templates"
Files = @(
"wp-content/themes/$THEME_SLUG/page-templates/template-who-we-are.php",
"wp-content/themes/$THEME_SLUG/page-templates/template-what-we-do.php",
"wp-content/themes/$THEME_SLUG/page-templates/template-our-work.php",
"wp-content/themes/$THEME_SLUG/page-templates/template-resources.php",
"wp-content/themes/$THEME_SLUG/page-templates/template-contact.php"
)
}
@{
Name = "SCSS abstracts and base"
Files = @(
"wp-content/themes/$THEME_SLUG/src/scss/main.scss",
"wp-content/themes/$THEME_SLUG/src/scss/abstracts/_variables.scss",
"wp-content/themes/$THEME_SLUG/src/scss/abstracts/_mixins.scss",
"wp-content/themes/$THEME_SLUG/src/scss/abstracts/_functions.scss",
"wp-content/themes/$THEME_SLUG/src/scss/base/_reset.scss",
"wp-content/themes/$THEME_SLUG/src/scss/base/_typography.scss",
"wp-content/themes/$THEME_SLUG/src/scss/base/_accessibility.scss",
"wp-content/themes/$THEME_SLUG/src/scss/base/_forms.scss"
)
}
@{
Name = "SCSS components and layout"
Files = @(
"wp-content/themes/$THEME_SLUG/src/scss/components/_buttons.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_cards.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_forms.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_badges.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_accordion.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_carousel.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_portfolio-filter.scss",
"wp-content/themes/$THEME_SLUG/src/scss/components/_before-after.scss",
"wp-content/themes/$THEME_SLUG/src/scss/layout/_container.scss",
"wp-content/themes/$THEME_SLUG/src/scss/layout/_header.scss",
"wp-content/themes/$THEME_SLUG/src/scss/layout/_footer.scss",
"wp-content/themes/$THEME_SLUG/src/scss/layout/_grid.scss",
"wp-content/themes/$THEME_SLUG/src/scss/layout/_sections.scss"
)
}
@{
Name = "SCSS page partials"
Files = @(
"wp-content/themes/$THEME_SLUG/src/scss/pages/_home.scss",
"wp-content/themes/$THEME_SLUG/src/scss/pages/_contact.scss",
"wp-content/themes/$THEME_SLUG/src/scss/pages/_services.scss",
"wp-content/themes/$THEME_SLUG/src/scss/pages/_work.scss",
"wp-content/themes/$THEME_SLUG/src/scss/pages/_resources.scss",
"wp-content/themes/$THEME_SLUG/src/scss/pages/_who-we-are.scss"
)
}
@{
Name = "Runtime CSS"
Files = @(
"wp-content/themes/$THEME_SLUG/assets/css/main.css"
)
}
@{
Name = "Source and runtime JavaScript"
Files = @(
"wp-content/themes/$THEME_SLUG/src/js/main.js",
"wp-content/themes/$THEME_SLUG/assets/js/bundle.js"
)
}
@{
Name = "Build blocks icons and package files"
Files = @(
"wp-content/themes/$THEME_SLUG/assets/icons/README.md",
"wp-content/themes/$THEME_SLUG/blocks/README.md",
"wp-content/themes/$THEME_SLUG/build/webpack.config.js",
"wp-content/themes/$THEME_SLUG/package.json",
"wp-content/themes/$THEME_SLUG/package-lock.json"
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

# Expand grouped stage definitions into one-file Builder calls.
# This is intentionally slower, but it gives the local 14B model one file at a time
# and prevents large stages from skipping required files.
$expandedStages = @()

foreach ($stage in $stages) {
$originalStageName = [string]$stage.Name
$originalStageFiles = @($stage.Files)
$totalStageFiles = $originalStageFiles.Count
$fileNumber = 1

foreach ($stageFile in $originalStageFiles) {
$expandedStages += @{
Name = "$originalStageName file $fileNumber of $totalStageFiles"
Files = @($stageFile)
}

$fileNumber++
}
}

$stages = $expandedStages

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
- Generate every listed file for this stage. In one-file stages, generate exactly the single listed file and nothing else.
- Do not skip listed files.
- Do not leave files blank.
- Do not use placeholder-only content.
- Each listed PHP, CSS, SCSS, JS, JSON, Markdown, and config file must be complete and maintainable.
- Use local-only assets and vanilla WordPress/PHP/HTML/CSS/JS.
- The deterministic scaffold is only a fallback. Your job is to fully author the files listed for this stage.
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

foreach ($stageFile in $stageFiles) {
$stageFilePath = Join-Path $root $stageFile

if (-not (Test-Path -LiteralPath $stageFilePath)) {
Write-Die "Builder stage '$stageName' did not generate required listed file: $stageFile"
}

$stageFileItem = Get-Item -LiteralPath $stageFilePath -ErrorAction Stop

if ($stageFileItem.Length -le 0) {
Write-Die "Builder stage '$stageName' generated an empty file: $stageFile"
}
}
}
# Builder-authored output quality gates.
# These checks happen before deterministic scaffold fallback so weak or skipped Builder output cannot pass as a real theme.
$requiredDocsLink = "themes/$THEME_SLUG/index.html"

if (-not (Test-Path -LiteralPath $docsIndexPath)) {
Write-Die "Docs gallery index was not generated: docs/index.html"
}

$docsIndexAfterBuilder = Get-Content -LiteralPath $docsIndexPath -Raw

if ($docsIndexAfterBuilder -notmatch [regex]::Escape($requiredDocsLink)) {
Write-Die "Docs gallery index does not include required theme preview link: $requiredDocsLink"
}

$previewIndexPath = Join-Path $root (Join-Path $PREVIEW_DIR "index.html")

if (-not (Test-Path -LiteralPath $previewIndexPath)) {
Write-Die "Static preview index was not generated: $PREVIEW_DIR/index.html"
}

$previewIndexAfterBuilder = Get-Content -LiteralPath $previewIndexPath -Raw

$requiredPreviewTerms = @(
"What We Do",
"Who We Are",
"Our Work",
"Resources",
"Contact Us",
"nolan-menu"
)

foreach ($requiredPreviewTerm in $requiredPreviewTerms) {
if ($previewIndexAfterBuilder -notmatch [regex]::Escape($requiredPreviewTerm)) {
Write-Die "Static preview index is missing required preview/header term: $requiredPreviewTerm"
}
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















