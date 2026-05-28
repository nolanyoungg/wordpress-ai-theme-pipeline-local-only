param(
[Parameter(Mandatory = $true)]
[string]$ThemeSlug
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

function Write-Fail {
param(
[Parameter(Mandatory = $true)]
[string]$Message
)

throw $Message
}

function Get-TextFiles {
param(
[Parameter(Mandatory = $true)]
[string[]]$Roots
)

$extensions = @(
".php",
".html",
".css",
".scss",
".js",
".json",
".md",
".txt",
".yml",
".yaml"
)

foreach ($root in $Roots) {
if (-not (Test-Path -LiteralPath $root)) {
continue
}

Get-ChildItem -LiteralPath $root -Recurse -File |
Where-Object { $extensions -contains $_.Extension.ToLowerInvariant() }
}
}

function Test-ForbiddenText {
param(
[Parameter(Mandatory = $true)]
[System.IO.FileInfo[]]$Files
)

$backtick = [char]96

$forbiddenPatterns = @(
"$backtick$backtick$backtick",
"$backtick$backtick$backtick" + "php",
"$backtick$backtick$backtick" + "html",
"$backtick$backtick$backtick" + "css",
"$backtick$backtick$backtick" + "scss",
"$backtick$backtick$backtick" + "js",
"$backtick$backtick$backtick" + "json",
"TODO",
"FIXME",
"placeholder",
"Add more",
"as needed",
"Example of",
"This can be expanded",
"Client 1",
"Client 2",
"Your Name",
"Lorem ipsum",
"coming soon",
"Insert ",
"Replace this"
)

foreach ($file in $Files) {
$content = Get-Content -LiteralPath $file.FullName -Raw

foreach ($pattern in $forbiddenPatterns) {
if ($content -match [regex]::Escape($pattern)) {
Write-Fail "Forbidden text '$pattern' found in $($file.FullName)"
}
}
}
}

function Test-RequiredContent {
param(
[Parameter(Mandatory = $true)]
[string]$ThemeRoot,

[Parameter(Mandatory = $true)]
[string]$PreviewRoot
)

$previewIndex = Join-Path $PreviewRoot "index.html"
$previewCss = Join-Path $PreviewRoot "assets\css\preview.css"
$previewJs = Join-Path $PreviewRoot "assets\js\preview.js"

$themeCss = Join-Path $ThemeRoot "assets\css\main.css"
$themeJs = Join-Path $ThemeRoot "assets\js\bundle.js"

$requiredFiles = @(
$previewIndex,
$previewCss,
$previewJs,
$themeCss,
$themeJs,
(Join-Path $ThemeRoot "style.css"),
(Join-Path $ThemeRoot "functions.php"),
(Join-Path $ThemeRoot "front-page.php"),
(Join-Path $ThemeRoot "header.php"),
(Join-Path $ThemeRoot "footer.php")
)

foreach ($file in $requiredFiles) {
if (-not (Test-Path -LiteralPath $file)) {
Write-Fail "Missing required finished-theme file: $file"
}

$item = Get-Item -LiteralPath $file

if ($item.Length -le 0) {
Write-Fail "Required finished-theme file is empty: $file"
}
}

$previewHtml = Get-Content -LiteralPath $previewIndex -Raw
$previewCssContent = Get-Content -LiteralPath $previewCss -Raw
$themeCssContent = Get-Content -LiteralPath $themeCss -Raw
$themeJsContent = Get-Content -LiteralPath $themeJs -Raw
$previewJsContent = Get-Content -LiteralPath $previewJs -Raw

$requiredPreviewTerms = @(
"What We Do",
"Who We Are",
"Work",
"Resources",
"Contact",
"Contact Us",
"nolan-menu",
"site-header",
"site-footer"
)

foreach ($term in $requiredPreviewTerms) {
if ($previewHtml -notmatch [regex]::Escape($term)) {
Write-Fail "Static preview missing required term: $term"
}
}

$requiredCssSelectors = @(
"site-header",
"nolan-menu",
"hero",
"btn",
"site-footer"
)

foreach ($selector in $requiredCssSelectors) {
if (($previewCssContent -notmatch [regex]::Escape($selector)) -and ($themeCssContent -notmatch [regex]::Escape($selector))) {
Write-Fail "Missing required CSS selector coverage: $selector"
}
}

$requiredJsFunctions = @(
"initHeaderMenu",
"initMobileDrawer",
"initRailPanels",
"initPortfolioFilter",
"initCarousel",
"initBeforeAfter",
"initTestimonials",
"initScrollReveal"
)

foreach ($functionName in $requiredJsFunctions) {
if (($themeJsContent -notmatch [regex]::Escape($functionName)) -and ($previewJsContent -notmatch [regex]::Escape($functionName))) {
Write-Fail "Missing required JavaScript function: $functionName"
}
}
}

function Test-BrokenLocalAssetReferences {
param(
[Parameter(Mandatory = $true)]
[System.IO.FileInfo[]]$Files,

[Parameter(Mandatory = $true)]
[string]$PreviewRoot
)

$resolvedPreviewRoot = (Resolve-Path -LiteralPath $PreviewRoot).Path
$assetReferencePattern = "(?:src|href)=[""']([^""']+\.(?:png|jpg|jpeg|webp|gif|svg|css|js))[""']"

foreach ($file in $Files) {
$content = Get-Content -LiteralPath $file.FullName -Raw
$matches = [regex]::Matches($content, $assetReferencePattern, [System.Text.RegularExpressions.RegexOptions]::IgnoreCase)

foreach ($match in $matches) {
$assetPath = $match.Groups[1].Value

if ($assetPath -match "^(https?:)?//") {
Write-Fail "Remote asset reference is not allowed in $($file.FullName): $assetPath"
}

if ($assetPath -match "^#" -or $assetPath -match "^mailto:" -or $assetPath -match "^tel:") {
continue
}

if ($assetPath -match "^/") {
continue
}

if ($file.FullName.StartsWith($resolvedPreviewRoot, [System.StringComparison]::OrdinalIgnoreCase)) {
$resolvedAsset = Join-Path (Split-Path $file.FullName -Parent) $assetPath

if (-not (Test-Path -LiteralPath $resolvedAsset)) {
Write-Fail "Broken static preview asset reference in $($file.FullName): $assetPath"
}
}
}
}
}

function Test-PhpSyntax {
param(
[Parameter(Mandatory = $true)]
[string]$ThemeRoot
)

$phpCommand = Get-Command php -ErrorAction SilentlyContinue

if (-not $phpCommand) {
Write-Output "WARNING: php command not found. Skipping php -l checks."
return
}

$phpFiles = Get-ChildItem -LiteralPath $ThemeRoot -Recurse -File -Filter "*.php"

foreach ($phpFile in $phpFiles) {
$output = & php -l $phpFile.FullName 2>&1

if ($LASTEXITCODE -ne 0) {
Write-Fail "PHP syntax error in $($phpFile.FullName): $output"
}
}
}

$repoRoot = (Get-Location).Path
$themeRoot = Join-Path $repoRoot "wp-content\themes\$ThemeSlug"
$previewRoot = Join-Path $repoRoot "docs\themes\$ThemeSlug"
$zipPath = Join-Path $repoRoot "zippedTheme\$ThemeSlug.zip"

Write-Output "Running finished-theme validation for $ThemeSlug"

if (-not (Test-Path -LiteralPath $themeRoot)) {
Write-Fail "Theme root not found: $themeRoot"
}

if (-not (Test-Path -LiteralPath $previewRoot)) {
Write-Fail "Static preview root not found: $previewRoot"
}

if (-not (Test-Path -LiteralPath $zipPath)) {
Write-Fail "Theme ZIP not found: $zipPath"
}

$textFiles = @(Get-TextFiles -Roots @($themeRoot, $previewRoot))

if ($textFiles.Count -eq 0) {
Write-Fail "No text files found to validate."
}

Test-ForbiddenText -Files $textFiles
Test-RequiredContent -ThemeRoot $themeRoot -PreviewRoot $previewRoot
Test-BrokenLocalAssetReferences -Files $textFiles -PreviewRoot $previewRoot
Test-PhpSyntax -ThemeRoot $themeRoot

Write-Output "Finished-theme validation OK: $ThemeSlug"
