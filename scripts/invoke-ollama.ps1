param(
	[Parameter(Mandatory = $true)]
	[string]$PromptText,

	[Parameter(Mandatory = $false)]
	[string]$Model = "qwen2.5-coder:32b",

	[Parameter(Mandatory = $true)]
	[string]$OutputPath
)

$ErrorActionPreference = "Stop"
Set-StrictMode -Version Latest

function Write-Die([string]$Message) {
	Write-Error $Message
	exit 1
}

$root = Resolve-Path (Join-Path $PSScriptRoot "..") | Select-Object -ExpandProperty Path
$aiDir = Join-Path $root ".ai"
New-Item -ItemType Directory -Force $aiDir | Out-Null

if ($env:OLLAMA_MODEL) {
	$Model = $env:OLLAMA_MODEL
}

$baseUri = "http://localhost:11434"

try {
	$tags = Invoke-RestMethod -Method Get -Uri "$baseUri/api/tags" -TimeoutSec 5
} catch {
	Write-Die "Ollama is not reachable at $baseUri. Start Ollama and retry. Underlying error: $($_.Exception.Message)"
}

if (-not $tags -or -not $tags.models) {
	Write-Die "Unexpected response from $baseUri/api/tags. Cannot verify installed models."
}

$installed = @($tags.models | ForEach-Object { $_.name })
if ($installed -notcontains $Model) {
	$listed = ($installed | Sort-Object) -join "`n  - "
	Write-Die "Ollama model '$Model' is not installed. Install it locally with: ollama pull $Model`nInstalled models:`n  - $listed"
}

$body = @{
	model  = $Model
	prompt = $PromptText
	stream = $false
} | ConvertTo-Json -Depth 10

$outFull = Join-Path $root $OutputPath
$outDir = Split-Path -Parent $outFull
if ($outDir) { New-Item -ItemType Directory -Force $outDir | Out-Null }

try {
	Add-Type -AssemblyName System.Net.Http
	$client = New-Object System.Net.Http.HttpClient

	# Some models/prompts can take a long time. Allow overriding via env var.
	# Default: 2 hours (more forgiving than 1h to avoid spurious TaskCanceledException).
	$timeoutMinutes = 120
	if ($env:OLLAMA_HTTP_TIMEOUT_MINUTES) {
		$parsed = 0
		if ([int]::TryParse($env:OLLAMA_HTTP_TIMEOUT_MINUTES, [ref]$parsed) -and $parsed -ge 1) {
			$timeoutMinutes = $parsed
		}
	}
	$client.Timeout = [TimeSpan]::FromMinutes($timeoutMinutes)

	$content = New-Object System.Net.Http.StringContent($body, [System.Text.Encoding]::UTF8, "application/json")

	$attempts = 3
	$httpResp = $null
	$respText = $null
	for ($attempt = 1; $attempt -le $attempts; $attempt++) {
		try {
			$httpResp = $client.PostAsync("$baseUri/api/generate", $content).GetAwaiter().GetResult()
			$respText = $httpResp.Content.ReadAsStringAsync().GetAwaiter().GetResult()
			break
		} catch {
			# Ollama can intermittently drop/timeout long generations; retry a couple times.
			$isCanceled =
				$_.Exception -is [System.Threading.Tasks.TaskCanceledException] -or
				($_.Exception.Message -match '(?i)task was canceled')
			if ($isCanceled -and $attempt -lt $attempts) {
				Start-Sleep -Seconds ([Math]::Min(30, 5 * $attempt))
				continue
			}
			throw
		}
	}

	if (-not $httpResp.IsSuccessStatusCode) {
		$rawStamp = Get-Date -Format "yyyyMMdd-HHmmss"
		$errPath = Join-Path $aiDir ("ollama-generate-error-$rawStamp.txt")
		$respText | Set-Content -Encoding UTF8 -Path $errPath
		Write-Die "Failed calling Ollama generate endpoint at $baseUri/api/generate. HTTP $([int]$httpResp.StatusCode) $($httpResp.ReasonPhrase). Response body saved to: $errPath"
	}

	$resp = $respText | ConvertFrom-Json
} catch {
	$hint = ""
	if ($_.Exception -is [System.Threading.Tasks.TaskCanceledException] -or ($_.Exception.Message -match '(?i)task was canceled')) {
		$hint = " This often means the request exceeded the HTTP timeout or Ollama stalled. Try setting OLLAMA_HTTP_TIMEOUT_MINUTES (e.g. 240) and rerun."
	}
	Write-Die "Failed calling Ollama generate endpoint at $baseUri/api/generate. Underlying error: $($_.Exception.Message)$hint"
} finally {
	if ($client) { $client.Dispose() }
}

$rawStamp = Get-Date -Format "yyyyMMdd-HHmmss"
$rawPath = Join-Path $aiDir ("ollama-generate-$rawStamp.json")
$resp | ConvertTo-Json -Depth 20 | Set-Content -Encoding UTF8 -Path $rawPath

if (-not $resp.response) {
	Write-Die "Ollama response did not include a 'response' field. Raw saved to: $rawPath"
}

$resp.response | Set-Content -Encoding UTF8 -Path $outFull
Write-Output $outFull
