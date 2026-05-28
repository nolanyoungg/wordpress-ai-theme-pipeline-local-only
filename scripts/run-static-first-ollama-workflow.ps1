param(
[Parameter(Mandatory = $true)]
[string]$UserTask
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest

function Write-Die {
param(
[Parameter(Mandatory = $true)]
[string]$Message
)

Write-Error $Message
exit 1
}

function Get-RepoRoot {
$here = Resolve-Path $PSScriptRoot | Select-Object -ExpandProperty Path
return (Resolve-Path (Join-Path $here "..") | Select-Object -ExpandProperty Path)
}

function Ensure-Ollama {
param(
[Parameter(Mandatory = $true)]
[string]$BaseUri,

[Parameter(Mandatory = $true)]
[string]$Model
)

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

function Get-LatestThemeVersion {
param(
[Parameter(Mandatory = $true)]
[string]$ThemesDir
)

$max = 0

if (-not (Test-Path -LiteralPath $ThemesDir)) {
return 0
}

Get-ChildItem -LiteralPath $ThemesDir -Directory -ErrorAction Stop |
Where-Object { $_.Name -match '^nolan-young-showcase-theme-x(\d+)$' } |
ForEach-Object {
$stylePath = Join-Path $_.FullName "style.css"

if (Test-Path -LiteralPath $stylePath) {
$version = [int]([regex]::Match($_.Name, '^nolan-young-showcase-theme-x(\d+)$').Groups[1].Value)

if ($version -gt $max) {
$max = $version
}
}
}

return $max
}

function Should-KeepFailedOutput {
$value = $env:OLLAMA_KEEP_FAILED_OUTPUT

if ($null -eq $value) {
return $false
}

$value = $value.Trim().ToLowerInvariant()

return ($value -in @("1", "true", "yes", "y", "on"))
}

function Assert-FileExists {
param(
[Parameter(Mandatory = $true)]
[string]$Path,

[Parameter(Mandatory = $true)]
[string]$Label
)

if (-not (Test-Path -LiteralPath $Path)) {
Write-Die "$Label was not created: $Path"
}

$item = Get-Item -LiteralPath $Path -ErrorAction Stop

if ($item.Length -le 0) {
Write-Die "$Label is empty: $Path"
}
}

function Invoke-StaticFirstAgent {
param(
[Parameter(Mandatory = $true)]
[string]$AgentName,

[Parameter(Mandatory = $true)]
[string]$AgentPromptPath,

[Parameter(Mandatory = $true)]
[string]$AgentTask
)

Write-Output ""
Write-Output "Running static-first agent: $AgentName"

& (Join-Path $PSScriptRoot "ollama-agent.ps1") `
-Agent $AgentName `
-AgentPromptPath $AgentPromptPath `
-UserTask $AgentTask `
-ThemeSlug $script:THEME_SLUG `
-ThemeDisplayName $script:THEME_DISPLAY_NAME `
-ThemeVersion $script:THEME_VERSION `
-ThemeDir $script:THEME_DIR `
-PreviewDir $script:PREVIEW_DIR `
-ThemeZip $script:THEME_ZIP `
-Model $script:model `
-LatestThemeSlug $script:latestSlug `
-LatestThemeDir $script:latestThemeDir `
-LatestPreviewDir $script:latestPreviewDir | Out-Null
}

$root = Get-RepoRoot
$model = "qwen2.5-coder:14b"

if ($env:OLLAMA_MODEL) {
$model = $env:OLLAMA_MODEL
}

$baseUri = "http://localhost:11434"
Ensure-Ollama -BaseUri $baseUri -Model $model

. (Join-Path $PSScriptRoot "theme-structure.ps1")

$themesDir = Join-Path $root "wp-content/themes"
$latestVersion = Get-LatestThemeVersion -ThemesDir $themesDir
$nextVersion = $latestVersion + 1

$script:THEME_VERSION = $nextVersion
$script:THEME_SLUG = "nolan-young-showcase-theme-x{0:D2}" -f $script:THEME_VERSION
$script:THEME_DISPLAY_NAME = "Nolan Young Showcase Theme X{0:D2}" -f $script:THEME_VERSION
$script:THEME_DIR = "wp-content/themes/$script:THEME_SLUG"
$script:PREVIEW_DIR = "docs/themes/$script:THEME_SLUG"
$script:THEME_ZIP = "zippedTheme/$script:THEME_SLUG.zip"
$script:model = $model

$createdThemeFull = Join-Path $root $script:THEME_DIR
$createdPreviewFull = Join-Path $root $script:PREVIEW_DIR
$createdZipFull = Join-Path $root $script:THEME_ZIP
$docsIndexPath = Join-Path $root "docs/index.html"

$docsIndexBefore = $null

if (Test-Path -LiteralPath $docsIndexPath) {
$docsIndexBefore = Get-Content -LiteralPath $docsIndexPath -Raw
}

$keepFailed = Should-KeepFailedOutput

if (-not $env:OLLAMA_DISABLE_LATEST_CONTEXT) {
$env:OLLAMA_DISABLE_LATEST_CONTEXT = "1"
}

$script:latestSlug = ""
$script:latestThemeDir = ""
$script:latestPreviewDir = ""

if ($latestVersion -ge 1) {
$script:latestSlug = "nolan-young-showcase-theme-x{0:D2}" -f $latestVersion
$script:latestThemeDir = "wp-content/themes/$script:latestSlug"
$script:latestPreviewDir = "docs/themes/$script:latestSlug"
}

Write-Output "THEME_SLUG=$script:THEME_SLUG"
Write-Output "THEME_DISPLAY_NAME=$script:THEME_DISPLAY_NAME"
Write-Output "STATIC_FIRST_WORKFLOW=1"

New-Item -ItemType Directory -Force (Join-Path $root ".ai/theme-plan") | Out-Null
New-Item -ItemType Directory -Force (Join-Path $root ".ai/static-site/assets/css") | Out-Null
New-Item -ItemType Directory -Force (Join-Path $root ".ai/static-site/assets/js") | Out-Null
New-Item -ItemType Directory -Force $createdThemeFull | Out-Null
New-Item -ItemType Directory -Force $createdPreviewFull | Out-Null

$commonTask = @"
STATIC-FIRST LOCAL-ONLY THEME GENERATION

Theme slug:
$script:THEME_SLUG

Theme display name:
$script:THEME_DISPLAY_NAME

WordPress theme path:
$script:THEME_DIR

Static preview path:
$script:PREVIEW_DIR

Theme ZIP path:
$script:THEME_ZIP

Original user task:
$UserTask

Global rules:
- Local Ollama only.
- No OpenAI API usage.
- No remote AI services.
- No external runtime dependencies.
- Output file blocks only.
- Do not output markdown fences.
- Do not output explanations outside file blocks.
- Do not reference image files unless those files exist.
- Use CSS-created visual panels when real images are unavailable.
- The static site is the visual source of truth.
"@

try {
Invoke-StaticFirstAgent `
-AgentName "01-architect-planner" `
-AgentPromptPath "agents/01-architect-planner.md" `
-AgentTask $commonTask

Assert-FileExists -Path (Join-Path $root ".ai/theme-plan/theme-plan.md") -Label "Theme plan markdown"
Assert-FileExists -Path (Join-Path $root ".ai/theme-plan/theme-plan.json") -Label "Theme plan JSON"

Invoke-StaticFirstAgent `
-AgentName "02-static-site-builder" `
-AgentPromptPath "agents/02-static-site-builder.md" `
-AgentTask $commonTask

Assert-FileExists -Path (Join-Path $root ".ai/static-site/index.html") -Label "Static site index"
Assert-FileExists -Path (Join-Path $root ".ai/static-site/assets/css/main.css") -Label "Static site CSS"
Assert-FileExists -Path (Join-Path $root ".ai/static-site/assets/js/main.js") -Label "Static site JS"

Invoke-StaticFirstAgent `
-AgentName "03-static-site-reviewer" `
-AgentPromptPath "agents/03-static-site-reviewer.md" `
-AgentTask $commonTask

$staticReviewPath = Join-Path $root ".ai/static-site/static-review.md"
Assert-FileExists -Path $staticReviewPath -Label "Static site review"

$staticReview = Get-Content -LiteralPath $staticReviewPath -Raw

if ($staticReview -match '(?i)conversion\s+is\s+allowed\s*:\s*no' -or $staticReview -match '(?i)pass/fail\s+result\s*:\s*fail') {
Write-Die "Static site reviewer blocked WordPress conversion. Review: $staticReviewPath"
}

Ensure-ThemeStructure `
-Root $root `
-ThemeDir $script:THEME_DIR `
-ThemeSlug $script:THEME_SLUG `
-ThemeDisplayName $script:THEME_DISPLAY_NAME `
-PreviewDir $script:PREVIEW_DIR `
-ThemeZip $script:THEME_ZIP

Ensure-PreviewStructure `
-Root $root `
-PreviewDir $script:PREVIEW_DIR `
-ThemeSlug $script:THEME_SLUG `
-ThemeDisplayName $script:THEME_DISPLAY_NAME

Invoke-StaticFirstAgent `
-AgentName "04-wordpress-converter" `
-AgentPromptPath "agents/04-wordpress-converter.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "05-header-navigation-specialist" `
-AgentPromptPath "agents/05-header-navigation-specialist.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "06-page-experience-builder" `
-AgentPromptPath "agents/06-page-experience-builder.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "07-static-preview-builder" `
-AgentPromptPath "agents/07-static-preview-builder.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "08-js-accessibility-qa" `
-AgentPromptPath "agents/08-js-accessibility-qa.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "09-wordpress-php-qa" `
-AgentPromptPath "agents/09-wordpress-php-qa.md" `
-AgentTask $commonTask

Invoke-StaticFirstAgent `
-AgentName "10-final-review-packager" `
-AgentPromptPath "agents/10-final-review-packager.md" `
-AgentTask $commonTask

Ensure-ThemeStructure `
-Root $root `
-ThemeDir $script:THEME_DIR `
-ThemeSlug $script:THEME_SLUG `
-ThemeDisplayName $script:THEME_DISPLAY_NAME `
-PreviewDir $script:PREVIEW_DIR `
-ThemeZip $script:THEME_ZIP

Ensure-PreviewStructure `
-Root $root `
-PreviewDir $script:PREVIEW_DIR `
-ThemeSlug $script:THEME_SLUG `
-ThemeDisplayName $script:THEME_DISPLAY_NAME

Write-Output ""
Write-Output "Running structural validation..."
& (Join-Path $PSScriptRoot "validate-themes.ps1") -ThemeSlug $script:THEME_SLUG

Write-Output ""
Write-Output "Running finished-theme quality validation..."
& (Join-Path $PSScriptRoot "validate-finished-theme.ps1") -ThemeSlug $script:THEME_SLUG
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

Write-Warning "Static-first workflow failed; cleaned generated theme/preview/zip and restored docs/index.html. Set OLLAMA_KEEP_FAILED_OUTPUT=1 to keep partial outputs."
}

throw
}

Write-Output ""
Write-Output "Static-first workflow complete."
Write-Output "Created theme:   $(Join-Path $root $script:THEME_DIR)"
Write-Output "Created preview: $(Join-Path $root $script:PREVIEW_DIR)"
Write-Output "ZIP:             $(Join-Path $root $script:THEME_ZIP)"
Write-Output ""
Write-Output "Manual git commands:"
Write-Output "  cd `"$root`""
Write-Output "  git status"
Write-Output "  git add -f $script:THEME_DIR $script:PREVIEW_DIR $script:THEME_ZIP"
Write-Output "  git add docs/index.html .ai/theme-plan .ai/static-site"
Write-Output "  git commit -m `"Add $script:THEME_SLUG (static-first Ollama local-only)`""
Write-Output "  git push"
