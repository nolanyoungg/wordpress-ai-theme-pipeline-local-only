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

function Write-OllamaLog {
	param(
		[Parameter(Mandatory = $true)]
		[string]$Message
	)

	$logDir = Join-Path $aiDir "logs"
	New-Item -ItemType Directory -Force $logDir | Out-Null

	$logPath = Join-Path $logDir "ollama-workflow.log"
	$timestamp = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
	"[$timestamp] $Message" | Add-Content -Encoding UTF8 -Path $logPath
}

if ($env:OLLAMA_MODEL) {
	$Model = $env:OLLAMA_MODEL
}

$baseUri = "http://localhost:11434"

Write-OllamaLog "invoke-ollama.ps1 start. Model=$Model BaseUri=$baseUri"

try {
	$tags = Invoke-RestMethod -Method Get -Uri "$baseUri/api/tags" -TimeoutSec 5
} catch {
	Write-OllamaLog "Ollama tags request failed. Error=$($_.Exception.Message)"
	Write-Die "Ollama is not reachable at $baseUri. Start Ollama and retry. Underlying error: $($_.Exception.Message)"
}

if (-not $tags -or -not $tags.models) {
	Write-OllamaLog "Unexpected tags response from $baseUri/api/tags (missing models)."
	Write-Die "Unexpected response from $baseUri/api/tags. Cannot verify installed models."
}

$installed = @($tags.models | ForEach-Object { $_.name })
if ($installed -notcontains $Model) {
	$listed = ($installed | Sort-Object) -join "`n  - "
	Write-OllamaLog "Model not installed. Model=$Model"
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

Write-OllamaLog "Request config. TimeoutMinutesEnv=$($env:OLLAMA_HTTP_TIMEOUT_MINUTES) PromptChars=$($PromptText.Length) OutputPath=$OutputPath OutputFull=$outFull"

try {
	Add-Type -AssemblyName System.Net.Http
	$client = New-Object System.Net.Http.HttpClient

	# Some models/prompts can take a long time. Allow overriding via env var.
	# Default: 6 hours (360 minutes).
	$timeoutMinutes = 360
	if ($env:OLLAMA_HTTP_TIMEOUT_MINUTES) {
		if (-not [int]::TryParse($env:OLLAMA_HTTP_TIMEOUT_MINUTES, [ref]$timeoutMinutes) -or $timeoutMinutes -le 0) {
			Write-OllamaLog "Invalid OLLAMA_HTTP_TIMEOUT_MINUTES value: '$($env:OLLAMA_HTTP_TIMEOUT_MINUTES)'"
			Write-Die "OLLAMA_HTTP_TIMEOUT_MINUTES must be a positive integer."
		}
	}
	$client.Timeout = [TimeSpan]::FromMinutes($timeoutMinutes)
	Write-OllamaLog "HttpClient configured. TimeoutMinutes=$timeoutMinutes"

	$content = New-Object System.Net.Http.StringContent($body, [System.Text.Encoding]::UTF8, "application/json")

	$attempts = 1
	$httpResp = $null
	$respText = $null
	$requestStart = Get-Date
	Write-OllamaLog "Generate request starting. Attempts=$attempts Start=$($requestStart.ToString('yyyy-MM-dd HH:mm:ss'))"
	try {
		$httpResp = $client.PostAsync("$baseUri/api/generate", $content).GetAwaiter().GetResult()
		$respText = $httpResp.Content.ReadAsStringAsync().GetAwaiter().GetResult()
	} catch {
		Write-OllamaLog "Generate attempt failed. Attempt=1 Error=$($_.Exception.Message)"
		throw
	}
	$requestEnd = Get-Date
	$elapsedSeconds = [int][Math]::Round((New-TimeSpan -Start $requestStart -End $requestEnd).TotalSeconds)
	$statusCode = ""
	if ($httpResp) { $statusCode = [string]([int]$httpResp.StatusCode) }
	Write-OllamaLog "Generate request completed. End=$($requestEnd.ToString('yyyy-MM-dd HH:mm:ss')) ElapsedSeconds=$elapsedSeconds HttpStatus=$statusCode"

	if (-not $httpResp.IsSuccessStatusCode) {
		$rawStamp = Get-Date -Format "yyyyMMdd-HHmmss"
		$errPath = Join-Path $aiDir ("ollama-generate-error-$rawStamp.txt")
		$respText | Set-Content -Encoding UTF8 -Path $errPath
		Write-OllamaLog "Generate request returned non-success. HttpStatus=$([int]$httpResp.StatusCode) Reason=$($httpResp.ReasonPhrase) ErrorBodySavedTo=$errPath"
		Write-Die "Failed calling Ollama generate endpoint at $baseUri/api/generate. HTTP $([int]$httpResp.StatusCode) $($httpResp.ReasonPhrase). Response body saved to: $errPath"
	}

	$resp = $respText | ConvertFrom-Json
} catch {
	Write-OllamaLog "Generate request failed. Error=$($_.Exception.Message)"
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
Write-OllamaLog "Raw JSON saved. Path=$rawPath"

if (-not $resp.response) {
	Write-OllamaLog "Ollama response missing 'response' field. Raw=$rawPath"
	Write-Die "Ollama response did not include a 'response' field. Raw saved to: $rawPath"
}

$resp.response | Set-Content -Encoding UTF8 -Path $outFull
Write-OllamaLog "Final output saved. Path=$outFull"
Write-Output $outFull
