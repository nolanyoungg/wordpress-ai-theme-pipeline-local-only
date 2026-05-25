# WordPress AI Theme Pipeline - Local Only

This repo is the local-only Ollama version of the WordPress theme pipeline. The repo is intentionally clean right now: no generated theme folders, no generated preview folders, and no committed ZIPs. The first run should create `nolan-young-showcase-theme-x01`.

## Prerequisites

- Git
- Node
- npm
- PHP
- Ollama
- `qwen2.5-coder:32b`

Known installed versions on this machine:
- Git 2.54.0.windows.1
- Node v22.15.0
- npm 10.9.2
- PHP 8.5.6
- Ollama 0.24.0

## Setup

```powershell
ollama list
ollama pull qwen2.5-coder:32b
```

## Run (create next versioned theme + preview)

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 "Create the next versioned WordPress theme for a premium AI automation and web development company. Make it visually impressive, highly interactive, mobile-first, accessible, and include the matching static preview."
```

## Run (create next versioned theme + preview + skip planner)

`builder-only` skips the planner step and runs the builder/reviewer workflow directly.

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
$env:OLLAMA_WORKFLOW_MODE="builder-only"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 "Create the next versioned WordPress theme for a premium AI automation and web development company. Make it visually impressive, highly interactive, mobile-first, accessible, and include the matching static preview."
```

For longer prompts, save the prompt text to a `.txt` file and pass it with `Get-Content -Raw`:

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 (Get-Content -Raw "C:\Users\Nolan\Documents\Codex\.Prompts\mny-photo-theme-spec-local-ollama.txt")
```

## Validate

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1
```

## Keep Failed Outputs

By default, failed runs remove the partially created theme and preview folders.

```powershell
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
```

## PR Workflow

1. Create a branch:

```powershell
git checkout -b feature/theme-x01
```

2. Run the workflow.
3. Validate.
4. Commit and push:

```powershell
git status
git add -A
git commit -m "Add nolan-young-showcase-theme-x01"
git push -u origin HEAD
```

5. Open a Pull Request from your branch into `main`.

## Workflow Notes

`scripts/run-local-ollama-workflow.ps1`:

1. Detects the next available `nolan-young-showcase-theme-xNN`.
2. Creates theme and preview folders.
3. Runs the Planner Agent unless `OLLAMA_WORKFLOW_MODE=builder-only`.
4. Runs the Builder Agent and writes safe file blocks.
5. Runs validation.
6. Runs the Reviewer Agent.
7. Runs the Fixer Agent if needed.
8. Validates again and packages the ZIP.

The workflow uses:
- `scripts/invoke-ollama.ps1`
- `scripts/ollama-agent.ps1`
- `scripts/validate-themes.ps1`

The only allowed AI endpoint is `http://localhost:11434`.
No cloud AI providers are part of the active workflow.
