# WordPress AI Theme Pipeline (Local-Only, Ollama)

## Current State

- This repository is intentionally "empty" of generated themes right now: no `wp-content/themes/nolan-young-showcase-theme-xNN/`, no `docs/themes/nolan-young-showcase-theme-xNN/`, and no committed ZIPs under `zippedTheme/`.
- GitHub Pages serves the static gallery from `docs/index.html` (Pages deploy is handled by GitHub Actions).
- Theme generation happens locally via Ollama at `http://localhost:11434`. No cloud AI is required.

## What This Repo Does

- Generates a versioned classic WordPress theme under `wp-content/themes/nolan-young-showcase-theme-xNN/`
- Generates a matching static preview under `docs/themes/nolan-young-showcase-theme-xNN/` for GitHub Pages
- Validates required files + PHP syntax, then packages a ZIP under `zippedTheme/`
- You commit/push results to `main` to publish the gallery + previews

## Prerequisites

- Git
- PHP (for `php -l` validation)
- Ollama running locally
- The model you want to use installed (default is `qwen2.5-coder:32b`)

## Generate (Next Version)

Pass your prompt as a single string, or load it from a local `.txt` file that is NOT committed to this repo.

```powershell
cd C:\Users\Nolan\Documents\Codex\wordpress-ai-theme-pipeline-local-only

$env:OLLAMA_MODEL="qwen2.5-coder:32b"
$env:OLLAMA_HTTP_TIMEOUT_MINUTES="360"

powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 (Get-Content -Raw "C:\path\to\your-prompt.txt")
```

## Validate

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1
```

## Publish (Make It Live)

```powershell
git status
git add -A
git commit -m "Add nolan-young-showcase-theme-x01 (Ollama local-only)"
git push origin main
```

## Troubleshooting

- Ollama request logs: `.ai/logs/ollama-workflow.log`
- Keep failed outputs: set `OLLAMA_KEEP_FAILED_OUTPUT=1`
- GitHub Pages can only render `docs/`; it does not run WordPress/PHP

## USE /theme-prompt/

This repo supports committing reusable theme prompt files under `theme-prompt/` and running them locally with Ollama.

### 1. Clone or Pull the Repo

Clone anywhere you like. Example:

```powershell
git clone https://github.com/nolanyoungg/wordpress-ai-theme-pipeline-local-only.git
cd wordpress-ai-theme-pipeline-local-only
```

If you already cloned it, update to the latest `main`:

```powershell
cd C:\path\to\wordpress-ai-theme-pipeline-local-only
git pull origin main
```

### 2. Confirm Ollama + Model

```powershell
ollama list
```

If the model is missing:

```powershell
ollama pull qwen2.5-coder:32b
```

### 3. Run a Committed Theme Prompt (First Theme = x01)

If this repo has no existing themes yet, the first run will generate:
- `wp-content/themes/nolan-young-showcase-theme-x01/`
- `docs/themes/nolan-young-showcase-theme-x01/`

Run the workflow using a committed prompt file (example: `theme-prompt/mny-prompt-v1.txt`):

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
$env:OLLAMA_HTTP_TIMEOUT_MINUTES="360"

powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 (Get-Content -Raw "theme-prompt\\mny-prompt-v1.txt")
```

### 4. Validate + Generate ZIP

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1 -ThemeSlug nolan-young-showcase-theme-x01
```

### 5. Publish the Preview (GitHub Pages)

Commit and push the generated theme, preview, and zip:

```powershell
git status
git add -A
git commit -m "Add nolan-young-showcase-theme-x01 (Ollama local-only)"
git push origin main
```

GitHub Actions will deploy `docs/` to GitHub Pages; the gallery is `docs/index.html`.
