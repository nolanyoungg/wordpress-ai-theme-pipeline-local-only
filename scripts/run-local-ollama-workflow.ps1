param(
	[Parameter(Mandatory = $true)]
	[string]$UserTask
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest

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
	Get-ChildItem -LiteralPath $ThemesDir -Directory -ErrorAction Stop |
		Where-Object { $_.Name -match '^nolan-showcase-theme-x(\d+)$' } |
		ForEach-Object {
			$v = [int]([regex]::Match($_.Name, '^nolan-showcase-theme-x(\d+)$').Groups[1].Value)
			if ($v -gt $max) { $max = $v }
		}
	return $max
}

function Copy-Starter([string]$Src, [string]$Dst) {
	if (-not (Test-Path -LiteralPath $Src)) { Write-Die "Starter folder missing: $Src" }
	if (Test-Path -LiteralPath $Dst) { Write-Die "Destination already exists: $Dst" }
	New-Item -ItemType Directory -Force (Split-Path -Parent $Dst) | Out-Null
	Copy-Item -LiteralPath $Src -Destination $Dst -Recurse -Force
}

function Replace-TextInFile([string]$Path, [hashtable]$Replacements) {
	if (-not (Test-Path -LiteralPath $Path)) { return }
	$c = Get-Content -LiteralPath $Path -Raw
	$orig = $c
	foreach ($k in $Replacements.Keys) {
		$c = $c -replace [regex]::Escape($k), [string]$Replacements[$k]
	}
	if ($c -ne $orig) {
		$c | Set-Content -Encoding UTF8 -Path $Path
	}
}

function Replace-ObviousVersionRefs([string]$Root, [string]$OldSlug, [string]$NewSlug, [string]$OldDisplay, [string]$NewDisplay) {
	# Keep this intentionally conservative: update obvious display/text-domain references in plain-text files.
	$targets = @(
		Join-Path $Root "wp-content/themes/$NewSlug/style.css",
		Join-Path $Root "wp-content/themes/$NewSlug/README.md",
		Join-Path $Root "docs/themes/$NewSlug/index.html"
	)

	$rep = @{
		$OldSlug = $NewSlug
		$OldDisplay = $NewDisplay
	}
	foreach ($t in $targets) { Replace-TextInFile -Path $t -Replacements $rep }
}

$root = Get-RepoRoot
$aiDir = Join-Path $root ".ai"
New-Item -ItemType Directory -Force $aiDir | Out-Null

$model = "qwen2.5-coder:32b"
if ($env:OLLAMA_MODEL) { $model = $env:OLLAMA_MODEL }

$baseUri = "http://localhost:11434"
Ensure-Ollama -BaseUri $baseUri -Model $model

$themesDir = Join-Path $root "wp-content/themes"
$docsThemesDir = Join-Path $root "docs/themes"

$latestVersion = Get-LatestThemeVersion -ThemesDir $themesDir
if ($latestVersion -lt 1) { Write-Die "No existing numbered themes found to copy as a starter." }

$nextVersion = $latestVersion + 1
$THEME_VERSION = $nextVersion
$THEME_SLUG = "nolan-showcase-theme-x$THEME_VERSION"
$THEME_DISPLAY_NAME = "Nolan Showcase Theme X$THEME_VERSION"
$THEME_DIR = "wp-content/themes/$THEME_SLUG"
$PREVIEW_DIR = "docs/themes/$THEME_SLUG"
$THEME_ZIP = "zippedTheme/$THEME_SLUG.zip"

Write-Output "THEME_SLUG=$THEME_SLUG"
Write-Output "THEME_DISPLAY_NAME=$THEME_DISPLAY_NAME"

# Find latest existing theme/preview to copy.
$latestSlug = "nolan-showcase-theme-x$latestVersion"
$latestThemeDir = "wp-content/themes/$latestSlug"
$latestPreviewDir = "docs/themes/$latestSlug"

Copy-Starter -Src (Join-Path $root $latestThemeDir) -Dst (Join-Path $root $THEME_DIR)
Copy-Starter -Src (Join-Path $root $latestPreviewDir) -Dst (Join-Path $root $PREVIEW_DIR)

Replace-ObviousVersionRefs -Root $root -OldSlug $latestSlug -NewSlug $THEME_SLUG -OldDisplay ("Nolan Showcase Theme X$latestVersion") -NewDisplay $THEME_DISPLAY_NAME

# Planner -> Builder -> Validate -> Reviewer -> optional Fixer -> Validate -> Zip
Write-Output "Running Planner Agent via Ollama ($model)..."
& (Join-Path $PSScriptRoot "ollama-agent.ps1") -Agent "planner" -UserTask $UserTask -ThemeSlug $THEME_SLUG -ThemeDisplayName $THEME_DISPLAY_NAME -ThemeVersion $THEME_VERSION -ThemeDir $THEME_DIR -PreviewDir $PREVIEW_DIR -ThemeZip $THEME_ZIP -Model $model -LatestThemeSlug $latestSlug -LatestThemeDir $latestThemeDir -LatestPreviewDir $latestPreviewDir | Out-Null

Write-Output "Running Builder Agent via Ollama ($model)..."
& (Join-Path $PSScriptRoot "ollama-agent.ps1") -Agent "builder" -UserTask $UserTask -ThemeSlug $THEME_SLUG -ThemeDisplayName $THEME_DISPLAY_NAME -ThemeVersion $THEME_VERSION -ThemeDir $THEME_DIR -PreviewDir $PREVIEW_DIR -ThemeZip $THEME_ZIP -Model $model -LatestThemeSlug $latestSlug -LatestThemeDir $latestThemeDir -LatestPreviewDir $latestPreviewDir | Out-Null

Write-Output "Running local validation..."
$validationFailed = $false
$validationError = ""
try {
	& (Join-Path $PSScriptRoot "validate-themes.ps1") -ThemeSlug $THEME_SLUG
} catch {
	$validationFailed = $true
	$validationError = $_.Exception.Message
	Write-Warning "Validation failed for $THEME_SLUG: $validationError"
}

Write-Output "Running Reviewer Agent via Ollama ($model)..."
$reviewOutPath = & (Join-Path $PSScriptRoot "ollama-agent.ps1") -Agent "reviewer" -UserTask $UserTask -ThemeSlug $THEME_SLUG -ThemeDisplayName $THEME_DISPLAY_NAME -ThemeVersion $THEME_VERSION -ThemeDir $THEME_DIR -PreviewDir $PREVIEW_DIR -ThemeZip $THEME_ZIP -Model $model -LatestThemeSlug $latestSlug -LatestThemeDir $latestThemeDir -LatestPreviewDir $latestPreviewDir

$reviewText = Get-Content -LiteralPath $reviewOutPath -Raw
$needsFix = $false
if ($reviewText -match '(?im)\b(critical|must fix|blocker|fails validation|error)\b') { $needsFix = $true }

if ($validationFailed -or $needsFix) {
	Write-Output "Reviewer indicates fixes are needed. Running Fixer Agent via Ollama ($model)..."
	$fixTask = $UserTask + "`n`nReviewer report:`n" + $reviewText
	if ($validationFailed) {
		$fixTask += "`n`nValidation failure:`n" + $validationError
	}
	& (Join-Path $PSScriptRoot "ollama-agent.ps1") -Agent "fixer" -UserTask $fixTask -ThemeSlug $THEME_SLUG -ThemeDisplayName $THEME_DISPLAY_NAME -ThemeVersion $THEME_VERSION -ThemeDir $THEME_DIR -PreviewDir $PREVIEW_DIR -ThemeZip $THEME_ZIP -Model $model -LatestThemeSlug $latestSlug -LatestThemeDir $latestThemeDir -LatestPreviewDir $latestPreviewDir | Out-Null

	Write-Output "Running validation again..."
	& (Join-Path $PSScriptRoot "validate-themes.ps1") -ThemeSlug $THEME_SLUG
}

Write-Output ""
Write-Output "Created theme:   $(Join-Path $root $THEME_DIR)"
Write-Output "Created preview: $(Join-Path $root $PREVIEW_DIR)"
Write-Output "ZIP:            $(Join-Path $root $THEME_ZIP)"
Write-Output ""
Write-Output "Manual git commands:"
Write-Output "  cd `"$root`""
Write-Output "  git status"
Write-Output "  git add ."
Write-Output "  git commit -m `"Add $THEME_SLUG (Ollama local-only)`""
Write-Output "  git push"
