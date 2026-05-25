param(
	[Parameter(Mandatory = $false)]
	[string]$ThemeSlug = ""
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest

function Write-Die([string]$Message) {
	throw $Message
}

function Has-Command([string]$Name) {
	return [bool](Get-Command $Name -ErrorAction SilentlyContinue)
}

function Get-RepoRoot {
	$here = Resolve-Path $PSScriptRoot | Select-Object -ExpandProperty Path
	return (Resolve-Path (Join-Path $here "..") | Select-Object -ExpandProperty Path)
}

function Get-ThemeSlugs([string]$ThemesDir) {
	$dirs = Get-ChildItem -LiteralPath $ThemesDir -Directory -ErrorAction Stop |
		Where-Object { $_.Name -match '^nolan-young-showcase-theme-x\d+$' }

	$parsed = foreach ($d in $dirs) {
		$m = [regex]::Match($d.Name, '^nolan-young-showcase-theme-x(\d+)$')
		if ($m.Success) {
			[pscustomobject]@{ Slug = $d.Name; Version = [int]$m.Groups[1].Value }
		}
	}

	return ($parsed | Sort-Object Version | Select-Object -ExpandProperty Slug)
}

function Get-ZipEntries([string]$ZipPath) {
	Add-Type -AssemblyName System.IO.Compression.FileSystem
	$zip = [System.IO.Compression.ZipFile]::OpenRead($ZipPath)
	try {
		return @($zip.Entries | ForEach-Object { $_.FullName })
	} finally {
		$zip.Dispose()
	}
}

$root = Get-RepoRoot
$themesDir = Join-Path $root "wp-content/themes"
$docsDir = Join-Path $root "docs"
$zipDir = Join-Path $root "zippedTheme"

if (-not (Test-Path -LiteralPath $themesDir)) { Write-Die "Missing themes directory: $themesDir" }
if (-not (Test-Path -LiteralPath (Join-Path $docsDir "index.html"))) { Write-Die "Missing docs/index.html" }

$needsNodeBuild = $false
try {
	$themeEntrypoints = @(Get-ChildItem -LiteralPath $themesDir -Recurse -File -ErrorAction Stop |
		Where-Object { $_.Name -match '^theme\.entry\.(js|jsx|ts|tsx)$' })
	if ($themeEntrypoints.Count -gt 0) { $needsNodeBuild = $true }
} catch { }

try {
	$previewEntrypoints = @(Get-ChildItem -LiteralPath (Join-Path $docsDir "themes") -Recurse -File -ErrorAction SilentlyContinue |
		Where-Object { $_.Name -match '^preview\.entry\.(js|jsx|ts|tsx)$' })
	if ($previewEntrypoints.Count -gt 0) { $needsNodeBuild = $true }
} catch { }

if ($needsNodeBuild) {
	if (-not (Has-Command "node")) { Write-Die "node is required on PATH when using React entrypoints (theme.entry.* / preview.entry.*)." }
	if (-not (Has-Command "npm")) { Write-Die "npm is required on PATH when using React entrypoints (theme.entry.* / preview.entry.*)." }
	if (Test-Path -LiteralPath (Join-Path $root "package.json")) {
		Write-Output "Building React bundles (entrypoints detected)..."
		& npm run check:npm-allowlist
		if ($LASTEXITCODE -ne 0) { throw "npm allowlist check failed" }
		& npm run build:react-bundles
		if ($LASTEXITCODE -ne 0) { throw "npm build:react-bundles failed" }
	}
}

$themes = @(Get-ThemeSlugs -ThemesDir $themesDir)
if (-not $themes -or $themes.Count -eq 0) {
	if ($ThemeSlug) {
		Write-Die "Theme '$ThemeSlug' not found under $themesDir"
	}
	Write-Output "No themes found matching nolan-young-showcase-theme-x* under $themesDir. Nothing to validate."
	exit 0
}

if ($ThemeSlug) {
	if ($themes -notcontains $ThemeSlug) {
		Write-Die "Theme '$ThemeSlug' not found under $themesDir"
	}
	$themes = @($ThemeSlug)
}

$isSingle = [bool]$ThemeSlug
New-Item -ItemType Directory -Force $zipDir | Out-Null
if (-not $isSingle) {
	Get-ChildItem -LiteralPath $zipDir -Filter "*.zip" -File -ErrorAction SilentlyContinue | Remove-Item -Force -ErrorAction SilentlyContinue
}

$required = @(
	"style.css",
	"functions.php",
	"index.php",
	"header.php",
	"footer.php",
	"front-page.php",
	"page.php",
	"single.php",
	"archive.php",
	"search.php",
	"404.php",
	"comments.php",
	"template-parts/content.php",
	"template-parts/content-page.php",
	"template-parts/content-none.php",
	"assets/css/theme.css",
	"assets/js/theme.js",
	"README.md"
)

$phpAvailable = Has-Command "php"

Write-Output "Validating themes:"
$themes | ForEach-Object { Write-Output ("  - " + $_) }

foreach ($slug in $themes) {
	$themeDir = Join-Path $themesDir $slug
	$previewDir = Join-Path (Join-Path $docsDir "themes") $slug

	Write-Output "==> $slug"

	foreach ($rel in $required) {
		$p = Join-Path $themeDir $rel
		if (-not (Test-Path -LiteralPath $p)) {
			Write-Die "Missing required file: $p"
		}
	}

	$stylePath = Join-Path $themeDir "style.css"
	$style = Get-Content -LiteralPath $stylePath -Raw
	if ($style -notmatch '(?m)^Theme Name:\s*.+$') {
		Write-Die "Missing Theme Name header: $stylePath"
	}

	$themeCssPath = Join-Path $themeDir "assets/css/theme.css"
	$cssBytes = (Get-Item -LiteralPath $themeCssPath).Length
	if ($cssBytes -lt 800) {
		Write-Die "Theme stylesheet too small ($cssBytes bytes): $themeCssPath"
	}

	$themeFiles = Get-ChildItem -LiteralPath $themeDir -Recurse -File
	$hasCssRef = $false
	foreach ($f in $themeFiles) {
		try {
			$c = Get-Content -LiteralPath $f.FullName -Raw -ErrorAction Stop
			if ($c -match [regex]::Escape("assets/css/theme.css")) { $hasCssRef = $true; break }
		} catch {
			# ignore binary reads
		}
	}
	if (-not $hasCssRef) {
		Write-Die "Theme does not reference assets/css/theme.css: $themeDir"
	}

	$hasEnqueue = $false
	foreach ($f in $themeFiles | Where-Object { $_.Extension -eq ".php" }) {
		$c = Get-Content -LiteralPath $f.FullName -Raw
		if ($c -match "wp_enqueue_style") { $hasEnqueue = $true; break }
	}
	if (-not $hasEnqueue) {
		Write-Die "Theme does not call wp_enqueue_style: $themeDir"
	}

	if ($phpAvailable) {
		foreach ($f in $themeFiles | Where-Object { $_.Extension -eq ".php" }) {
			# php -l writes to stdout/stderr; treat nonzero as failure.
			& php -l $f.FullName *> $null
			if ($LASTEXITCODE -ne 0) {
				Write-Die "PHP syntax error: $($f.FullName)"
			}
		}
	} else {
		Write-Warning "php not found on PATH; skipping php -l checks."
	}

	$previewIndex = Join-Path $previewDir "index.html"
	$previewCss = Join-Path $previewDir "assets/css/preview.css"
	$previewJs = Join-Path $previewDir "assets/js/preview.js"

	foreach ($p in @($previewIndex, $previewCss, $previewJs)) {
		if (-not (Test-Path -LiteralPath $p)) {
			Write-Die "Missing preview file: $p"
		}
	}

	$previewHtml = Get-Content -LiteralPath $previewIndex -Raw
	if ($previewHtml -notmatch "assets/css/preview\.css") {
		Write-Die "Preview HTML does not link preview.css: $previewIndex"
	}

	$previewCssBytes = (Get-Item -LiteralPath $previewCss).Length
	if ($previewCssBytes -lt 800) {
		Write-Die "Preview stylesheet too small ($previewCssBytes bytes): $previewCss"
	}

	# Package ZIP for this theme.
	$zipPath = Join-Path $zipDir ("$slug.zip")
	if (Test-Path -LiteralPath $zipPath) { Remove-Item -LiteralPath $zipPath -Force }

	$tmpDir = Join-Path $root "tmpZips"
	New-Item -ItemType Directory -Force $tmpDir | Out-Null
	$stageRoot = Join-Path $tmpDir "_stage"
	New-Item -ItemType Directory -Force $stageRoot | Out-Null
	$stageThemeDir = Join-Path $stageRoot $slug
	if (Test-Path -LiteralPath $stageThemeDir) { Remove-Item -LiteralPath $stageThemeDir -Recurse -Force }
	Copy-Item -LiteralPath $themeDir -Destination $stageThemeDir -Recurse -Force

	Compress-Archive -Path $stageThemeDir -DestinationPath $zipPath -Force

	$entries = Get-ZipEntries -ZipPath $zipPath
	$entriesNorm = @($entries | ForEach-Object { $_ -replace '\\', '/' })
	$mustHave = @(
		"$slug/style.css",
		"$slug/functions.php",
		"$slug/assets/css/theme.css",
		"$slug/assets/js/theme.js"
	)
	foreach ($m in $mustHave) {
		if ($entriesNorm -notcontains $m) {
			Write-Die "Zip missing required member '$m': $zipPath"
		}
	}
}

Write-Output "OK"
