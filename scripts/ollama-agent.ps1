param(
	[Parameter(Mandatory = $true)]
	[ValidateSet("planner", "builder", "reviewer", "fixer")]
	[string]$Agent,

	[Parameter(Mandatory = $true)]
	[string]$UserTask,

	[Parameter(Mandatory = $true)]
	[string]$ThemeSlug,

	[Parameter(Mandatory = $true)]
	[string]$ThemeDisplayName,

	[Parameter(Mandatory = $true)]
	[int]$ThemeVersion,

	[Parameter(Mandatory = $true)]
	[string]$ThemeDir,

	[Parameter(Mandatory = $true)]
	[string]$PreviewDir,

	[Parameter(Mandatory = $true)]
	[string]$ThemeZip,

	[Parameter(Mandatory = $false)]
	[string]$Model = "qwen2.5-coder:32b",

	[Parameter(Mandatory = $false)]
	[string]$LatestThemeSlug = "",

	[Parameter(Mandatory = $false)]
	[string]$LatestThemeDir = "",

	[Parameter(Mandatory = $false)]
	[string]$LatestPreviewDir = ""
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest

function Write-Die([string]$Message) {
	Write-Error $Message
	exit 1
}

function Read-TextOrEmpty([string]$Path) {
	if (Test-Path -LiteralPath $Path) {
		return Get-Content -LiteralPath $Path -Raw
	}
	return ""
}

function Truncate([string]$Text, [int]$MaxChars) {
	if (-not $Text) { return "" }
	if ($Text.Length -le $MaxChars) { return $Text }
	return ($Text.Substring(0, $MaxChars) + "`n...[truncated]...")
}

function Build-LatestContext([string]$Root, [string]$ThemeSlug, [string]$ThemeDir, [string]$PreviewDir) {
	if (-not $ThemeSlug -or -not $ThemeDir -or -not $PreviewDir) { return "" }

	$parts = @()
	$parts += "Latest existing theme context (read-only reference):"
	$parts += "Theme slug: $ThemeSlug"
	$parts += "Theme dir: $ThemeDir"
	$parts += "Preview dir: $PreviewDir"
	$parts += ""

	$files = @(
		@("Theme header", Join-Path $Root $ThemeDir "style.css", 4000),
		@("Theme functions", Join-Path $Root $ThemeDir "functions.php", 12000),
		@("Theme front-page", Join-Path $Root $ThemeDir "front-page.php", 8000),
		@("Theme JS", Join-Path $Root $ThemeDir "assets/js/theme.js", 8000),
		@("Theme CSS (excerpt)", Join-Path $Root $ThemeDir "assets/css/theme.css", 8000),
		@("Preview index (excerpt)", Join-Path $Root $PreviewDir "index.html", 12000),
		@("Preview CSS (excerpt)", Join-Path $Root $PreviewDir "assets/css/preview.css", 8000),
		@("Preview JS (excerpt)", Join-Path $Root $PreviewDir "assets/js/preview.js", 8000),
		@("Docs gallery index", Join-Path $Root "docs/index.html", 8000)
	)

	foreach ($f in $files) {
		$label = $f[0]
		$path = $f[1]
		$max = [int]$f[2]
		$content = Read-TextOrEmpty $path
		if ($content) {
			$parts += "### $label"
			$parts += "Path: $(Resolve-Path -LiteralPath $path | Select-Object -ExpandProperty Path)"
			$parts += ""
			$parts += Truncate $content $max
			$parts += ""
		}
	}

	return ($parts -join "`n")
}

function Expand-Template([string]$Template, [hashtable]$Vars) {
	$out = $Template
	foreach ($k in $Vars.Keys) {
		$out = $out.Replace("{{${k}}}", [string]$Vars[$k])
	}
	return $out
}

function Assert-AllowedRelativePath([string]$RepoRoot, [string]$RelPath, [string]$ThemeSlug) {
	if ([string]::IsNullOrWhiteSpace($RelPath)) { throw "Empty FILE path." }

	# Normalize separators to forward slashes for checks; we'll still write using native paths.
	$p = $RelPath.Trim()

	if ([System.IO.Path]::IsPathRooted($p) -or $p -match '^[a-zA-Z]:') {
		throw "Absolute paths are not allowed: $RelPath"
	}
	if ($p -match '(^|[\\/])\.\.([\\/]|$)') {
		throw "Parent directory segments ('..') are not allowed: $RelPath"
	}
	if ($p -match '(^|[\\/])\.git([\\/]|$)') {
		throw "Writes to .git are not allowed: $RelPath"
	}
	if ($p -match '(^|[\\/])scripts([\\/]|$)') {
		throw "Writes to scripts/ are not allowed: $RelPath"
	}
	if ($p -match '(^|[\\/])\.github[\\/]workflows([\\/]|$)') {
		throw "Writes to .github/workflows/ are not allowed: $RelPath"
	}
	if ($p -ieq 'package.json' -or $p -ieq 'AGENTS.md') {
		throw "Writes to $RelPath are not allowed."
	}

	$allowA = "wp-content/themes/$ThemeSlug/"
	$allowB = "docs/themes/$ThemeSlug/"
	$allowC = "docs/index.html"
	$allowD = ".ai/"

	$pNorm = $p -replace '\\', '/'
	$allowed =
		$pNorm.StartsWith($allowA) -or
		$pNorm.StartsWith($allowB) -or
		($pNorm -ieq $allowC) -or
		$pNorm.StartsWith($allowD)

	if (-not $allowed) {
		throw "Path is outside the allowed write locations: $RelPath"
	}

	$full = [System.IO.Path]::GetFullPath((Join-Path $RepoRoot $p))
	$rootFull = [System.IO.Path]::GetFullPath($RepoRoot)
	if (-not $full.StartsWith($rootFull, [System.StringComparison]::OrdinalIgnoreCase)) {
		throw "Resolved path escapes repository root: $RelPath"
	}
}

function Write-FileBlocks([string]$RepoRoot, [string]$Text, [string]$ThemeSlug) {
	$lines = $Text -split "(`r`n|`n|`r)"
	$inBlock = $false
	$curPath = $null
	$buf = New-Object System.Collections.Generic.List[string]
	$written = New-Object System.Collections.Generic.List[string]

	for ($i = 0; $i -lt $lines.Length; $i++) {
		$line = $lines[$i]

		if (-not $inBlock) {
			if ($line -match '^---FILE:\s*(.+?)\s*---$') {
				$curPath = $Matches[1]
				Assert-AllowedRelativePath -RepoRoot $RepoRoot -RelPath $curPath -ThemeSlug $ThemeSlug
				$inBlock = $true
				$buf.Clear() | Out-Null
			} elseif ($line.Trim().Length -gt 0) {
				throw "Non-file-block content detected outside file blocks. Builder/Fixer must output ONLY file blocks."
			}
			continue
		}

		if ($line -eq '---END FILE---') {
			$rel = $curPath
			$dest = Join-Path $RepoRoot $rel
			$destDir = Split-Path -Parent $dest
			if ($destDir) { New-Item -ItemType Directory -Force $destDir | Out-Null }
			($buf -join "`n") | Set-Content -Encoding UTF8 -Path $dest
			$written.Add($rel) | Out-Null
			$inBlock = $false
			$curPath = $null
			$buf.Clear() | Out-Null
			continue
		}

		$buf.Add($line) | Out-Null
	}

	if ($inBlock) {
		throw "Unterminated file block for path: $curPath"
	}

	if ($written.Count -eq 0) {
		throw "No valid file blocks found. Builder/Fixer must output ONLY file blocks."
	}

	return $written
}

$root = Resolve-Path (Join-Path $PSScriptRoot "..") | Select-Object -ExpandProperty Path
$aiDir = Join-Path $root ".ai"
New-Item -ItemType Directory -Force $aiDir | Out-Null
$promptsDir = Join-Path $root "prompts"

$agentsMd = Read-TextOrEmpty (Join-Path $root "AGENTS.md")
if (-not $agentsMd) { Write-Die "Missing AGENTS.md at repo root." }

$templatePath = Join-Path $promptsDir ("$Agent-agent.md")
if (-not (Test-Path -LiteralPath $templatePath)) { Write-Die "Missing prompt template: $templatePath" }
$template = Get-Content -LiteralPath $templatePath -Raw

$latestCtx = Build-LatestContext -Root $root -ThemeSlug $LatestThemeSlug -ThemeDir $LatestThemeDir -PreviewDir $LatestPreviewDir

$vars = @{
	"AGENTS_MD" = $agentsMd
	"USER_TASK" = $UserTask
	"THEME_SLUG" = $ThemeSlug
	"THEME_DISPLAY_NAME" = $ThemeDisplayName
	"THEME_VERSION" = "$ThemeVersion"
	"THEME_DIR" = $ThemeDir
	"PREVIEW_DIR" = $PreviewDir
	"THEME_ZIP" = $ThemeZip
	"LATEST_CONTEXT" = $latestCtx
}

$prompt = Expand-Template -Template $template -Vars $vars

$stamp = Get-Date -Format "yyyyMMdd-HHmmss"
$promptOut = Join-Path $aiDir ("$Agent-prompt-$stamp.md")
$resultOut = Join-Path $aiDir ("$Agent-output-$stamp.md")

$prompt | Set-Content -Encoding UTF8 -Path $promptOut

& (Join-Path $PSScriptRoot "invoke-ollama.ps1") -PromptText $prompt -Model $Model -OutputPath (".ai/" + (Split-Path -Leaf $resultOut)) | Out-Null

$result = Get-Content -LiteralPath $resultOut -Raw

if ($Agent -in @("builder", "fixer")) {
	$written = Write-FileBlocks -RepoRoot $root -Text $result -ThemeSlug $ThemeSlug
	$manifestPath = Join-Path $aiDir ("$Agent-written-files-$stamp.txt")
	($written | Sort-Object) | Set-Content -Encoding UTF8 -Path $manifestPath
	Write-Output $manifestPath
} else {
	Write-Output $resultOut
}
