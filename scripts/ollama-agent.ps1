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
	[string]$Model = "qwen2.5-coder:14b",

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

$disableLatestContext = $env:OLLAMA_DISABLE_LATEST_CONTEXT
if ($disableLatestContext) {
$disableLatestContext = $disableLatestContext.Trim().ToLowerInvariant()
if ($disableLatestContext -in @("1", "true", "yes", "y", "on")) {
return ""
}
}
	if (-not $ThemeSlug -or -not $ThemeDir -or -not $PreviewDir) { return "" }

	$parts = @()
	$parts += "Latest existing theme context (read-only reference):"
	$parts += "Theme slug: $ThemeSlug"
	$parts += "Theme dir: $ThemeDir"
	$parts += "Preview dir: $PreviewDir"
	$parts += ""

	$files = @(
		@("Theme header", [System.IO.Path]::Combine($Root, $ThemeDir, "style.css"), 4000),
		@("Theme functions", [System.IO.Path]::Combine($Root, $ThemeDir, "functions.php"), 12000),
		@("Theme front-page", [System.IO.Path]::Combine($Root, $ThemeDir, "front-page.php"), 8000),
		@("Theme JS", [System.IO.Path]::Combine($Root, $ThemeDir, "assets", "js", "theme.js"), 8000),
		@("Theme CSS (excerpt)", [System.IO.Path]::Combine($Root, $ThemeDir, "assets", "css", "theme.css"), 8000),
		@("Preview index (excerpt)", [System.IO.Path]::Combine($Root, $PreviewDir, "index.html"), 12000),
		@("Preview CSS (excerpt)", [System.IO.Path]::Combine($Root, $PreviewDir, "assets", "css", "preview.css"), 8000),
		@("Preview JS (excerpt)", [System.IO.Path]::Combine($Root, $PreviewDir, "assets", "js", "preview.js"), 8000),
		@("Docs gallery index", [System.IO.Path]::Combine($Root, "docs", "index.html"), 8000)
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

function Normalize-FileBlockPath([string]$RelPath) {
$path = $RelPath.Trim()

# Remove common model-added wrappers around paths.
$path = $path.Trim('"')
$path = $path.Trim("'")
$path = $path.Trim([char]0x60)
$path = $path.Trim()

# Normalize separators.
$path = $path -replace '\\', '/'

if ([string]::IsNullOrWhiteSpace($path)) {
throw "File block path is empty."
}

if ($path -match '[\r\n]') {
throw "File block path contains a newline: $RelPath"
}

foreach ($invalidChar in [System.IO.Path]::GetInvalidPathChars()) {
if ($path.Contains($invalidChar)) {
throw "File block path contains illegal character '$invalidChar': $RelPath"
}
}

return $path
}

function Normalize-FileBlockOutput([string]$Text) {
if ([string]::IsNullOrWhiteSpace($Text)) {
return $Text
}

$normalizedLines = New-Object System.Collections.Generic.List[string]
$lines = $Text -split "(`r`n|`n|`r)"

foreach ($line in $lines) {
$trimmedLine = $line.Trim()

# Drop Markdown fence-only wrapper lines. Keep real code/content lines.
if ($trimmedLine -match '^```(?:text|txt|markdown|md)?\s*$') {
continue
}

# Handle a Markdown fence glued directly to the FILE marker.
# Example: ```---FILE: path---
if ($trimmedLine -match '^```\s*(---FILE:\s*.+)$') {
$normalizedLines.Add($Matches[1]) | Out-Null
continue
}

# Handle a Markdown fence glued directly after the END marker.
# Example: ---END FILE---```
if ($trimmedLine -match '^(---END FILE---)\s*```$') {
$normalizedLines.Add($Matches[1]) | Out-Null
continue
}

$normalizedLines.Add($line) | Out-Null
}

$normalized = ($normalizedLines -join "`n").Trim()

# Defensive second pass in case fence markers appear after line normalization.
$normalized = [regex]::Replace($normalized, '(?m)^```\s*(---FILE:\s*.+)$', '$1')
$normalized = [regex]::Replace($normalized, '(?m)^(---END FILE---)\s*```$', '$1')

$hasFileBlockStart = $normalized -match '(?m)^---FILE:\s*.+'
$hasFileBlockEnd = $normalized -match '(?m)^---END FILE---\s*$'

# Local models sometimes produce a valid single file block but omit the final end marker.
# Treat EOF as the end of the final file block so one-file stages can continue safely.
if ($hasFileBlockStart -and -not $hasFileBlockEnd) {
$normalized = $normalized.TrimEnd() + "`n---END FILE---"
}

return $normalized
}

function Write-FileBlocks([string]$RepoRoot, [string]$Text, [string]$ThemeSlug) {
# Accept both:
# ---FILE: path---
# ---FILE: path
#
# The model often omits the closing --- after the file path.
# We still require a matching ---END FILE--- before writing anything.

$lines = $Text -split "(`r`n|`n|`r)"
$inBlock = $false
$curPath = $null
$buf = New-Object System.Collections.Generic.List[string]
$written = New-Object System.Collections.Generic.List[string]

for ($i = 0; $i -lt $lines.Length; $i++) {
$line = $lines[$i]

if (-not $inBlock) {
if ($line -match '^---FILE:\s*(.+?)\s*(?:---)?\s*$') {
$curPath = Normalize-FileBlockPath -RelPath $Matches[1]
Assert-AllowedRelativePath -RepoRoot $RepoRoot -RelPath $curPath -ThemeSlug $ThemeSlug
$inBlock = $true
$buf.Clear() | Out-Null
}

continue
}

if ($line.Trim() -eq '---END FILE---') {
$rel = $curPath
$dest = Join-Path $RepoRoot $rel
$destDir = Split-Path -Parent $dest

if ($destDir) {
New-Item -ItemType Directory -Force $destDir | Out-Null
}

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
throw "No valid file blocks found. Builder/Fixer must output at least one ---FILE: ... ---END FILE--- block."
}

return $written
}

# MAIN EXECUTION
# Composes the agent prompt, runs Ollama, saves raw output, and writes file blocks.
$repoRoot = Resolve-Path (Join-Path $PSScriptRoot "..") | Select-Object -ExpandProperty Path
$agentPromptPath = Join-Path $repoRoot (Join-Path "agents" "$Agent-agent.md")
$aiDir = Join-Path $repoRoot ".ai"

New-Item -ItemType Directory -Force $aiDir | Out-Null

if (-not (Test-Path -LiteralPath $agentPromptPath)) {
Write-Die "Agent prompt file not found: $agentPromptPath"
}

$agentInstructions = Get-Content -LiteralPath $agentPromptPath -Raw

$latestContext = ""
if ($LatestThemeSlug -and $LatestThemeDir -and $LatestPreviewDir) {
$latestContext = Build-LatestContext `
-Root $repoRoot `
-ThemeSlug $LatestThemeSlug `
-ThemeDir $LatestThemeDir `
-PreviewDir $LatestPreviewDir
}

$timestamp = Get-Date -Format "yyyyMMdd-HHmmss-fff"
$promptLogPath = Join-Path $aiDir "$Agent-prompt-$timestamp.md"
$outputLogPath = Join-Path $aiDir "$Agent-output-$timestamp.md"

$composedPrompt = @"
LOCAL-ONLY OLLAMA AGENT RUN

Agent:
$Agent

Model:
$Model

Theme slug:
$ThemeSlug

Theme display name:
$ThemeDisplayName

Theme version:
$ThemeVersion

Theme directory:
$ThemeDir

Preview directory:
$PreviewDir

Theme ZIP:
$ThemeZip

AGENT INSTRUCTIONS:
$agentInstructions

USER TASK:
$UserTask

LATEST CONTEXT:
$latestContext
"@

Set-Content -LiteralPath $promptLogPath -Value $composedPrompt -Encoding UTF8

$timeoutSeconds = 1200

if ($env:OLLAMA_REQUEST_TIMEOUT_SECONDS) {
try {
$timeoutSeconds = [int]$env:OLLAMA_REQUEST_TIMEOUT_SECONDS
} catch {
$timeoutSeconds = 1200
}
}

$options = @{}

if ($env:OLLAMA_CONTEXT_LENGTH) {
try {
$numCtx = [int]$env:OLLAMA_CONTEXT_LENGTH
if ($numCtx -gt 0) {
$options.num_ctx = $numCtx
}
} catch {
# Ignore invalid context values and let Ollama use its default.
}
}

$numPredict = 4096

if ($env:OLLAMA_NUM_PREDICT) {
try {
$parsedNumPredict = [int]$env:OLLAMA_NUM_PREDICT
if ($parsedNumPredict -gt 0) {
$numPredict = $parsedNumPredict
}
} catch {
$numPredict = 4096
}
}

$options.num_predict = $numPredict
$options.temperature = 0.15
$options.top_p = 0.85
$options.repeat_penalty = 1.08
$generatePayload = @{
model = $Model
prompt = $composedPrompt
stream = $false
options = $options
}

$generateJson = $generatePayload | ConvertTo-Json -Depth 10

try {
$response = Invoke-RestMethod `
-Method Post `
-Uri "http://localhost:11434/api/generate" `
-ContentType "application/json" `
-Body $generateJson `
-TimeoutSec $timeoutSeconds

$outputText = [string]$response.response
} catch {
$errorDetails = $_.Exception.Message

if ($_.ErrorDetails -and $_.ErrorDetails.Message) {
$errorDetails += "`n`n" + $_.ErrorDetails.Message
}

Set-Content -LiteralPath $outputLogPath -Value $errorDetails -Encoding UTF8
Write-Die "Ollama API generation failed. Details saved to: $outputLogPath"
}

$outputText = Normalize-FileBlockOutput -Text $outputText

Set-Content -LiteralPath $outputLogPath -Value $outputText -Encoding UTF8

if ([string]::IsNullOrWhiteSpace($outputText)) {
Write-Die "Ollama API returned empty output. Output saved to: $outputLogPath"
}

if ($Agent -in @("builder", "fixer")) {
$hasFileBlockStart = $outputText -match '(?m)^---FILE:\s*.+'
$hasFileBlockEnd = $outputText -match '(?m)^---END FILE---\s*$'

if (-not ($hasFileBlockStart -and $hasFileBlockEnd)) {
Write-Die "Builder/Fixer output did not contain a complete file block. Output saved to: $outputLogPath"
}

$writtenFiles = Write-FileBlocks `
-RepoRoot $repoRoot `
-Text $outputText `
-ThemeSlug $ThemeSlug

$writtenFiles = @($writtenFiles)
Write-Output "Wrote $($writtenFiles.Count) file block(s)."
foreach ($writtenFile in $writtenFiles) {
Write-Output "  - $writtenFile"
}
} else {
Write-Output $outputText
}







