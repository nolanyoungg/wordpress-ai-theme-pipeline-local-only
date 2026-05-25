# WordPress AI Theme Pipeline (Local-Only, Ollama)

This repository is now at a clean starting point. There are no generated theme folders or ZIPs checked in. The first local Ollama run is expected to create `nolan-young-showcase-theme-x01` and its matching static preview.

The active workflow is local-only:
- Ollama at `http://localhost:11434`
- Default model: `qwen2.5-coder:32b`
- PowerShell orchestration
- GitHub Actions only for validation, packaging, and GitHub Pages publishing

Codex/OpenAI are not part of the active workflow.

## Current State

- No generated theme folders are committed right now.
- No generated preview folders are committed right now.
- `docs/index.html` is an empty-state gallery page so GitHub Pages does not point at removed previews.
- `docs/.nojekyll` is present so Pages can serve the repo cleanly.

## Run Examples

### a) Run (create next versioned theme + preview)

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 "Create the next versioned WordPress theme for a premium AI automation and web development company. Make it visually impressive, highly interactive, mobile-first, accessible, and include the matching static preview."
```

### b) Run (create next versioned theme + preview + skip planner)

`builder-only` skips the planner step and runs the builder/reviewer workflow directly.

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
$env:OLLAMA_WORKFLOW_MODE="builder-only"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 "Create the next versioned WordPress theme for a premium AI automation and web development company. Make it visually impressive, highly interactive, mobile-first, accessible, and include the matching static preview."
```

For longer prompts, put the prompt text in a `.txt` file and pass it with `Get-Content -Raw` so PowerShell does not misread multiline input:

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 (Get-Content -Raw "C:\Users\Nolan\Documents\Codex\.Prompts\mny-photo-theme-spec-local-ollama.txt")
```

The first theme created from this clean state will be `nolan-young-showcase-theme-x01`.

## Validation

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1
```

## PR Workflow

1. Create a branch:

```powershell
git checkout -b feature/theme-x01
```

2. Run the workflow:

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:32b"
powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 "YOUR THEME TASK HERE"
```

3. Validate:

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1
```

4. Commit and push:

```powershell
git status
git add -A
git commit -m "Add nolan-young-showcase-theme-x01"
git push -u origin HEAD
```

5. Open a Pull Request on GitHub from your branch into `main`.

## Local Agent Flow

`scripts/run-local-ollama-workflow.ps1` does the following:

1. Detects the next available `nolan-young-showcase-theme-xNN` version.
2. Creates the target theme and preview folders.
3. Runs the Planner Agent unless `OLLAMA_WORKFLOW_MODE=builder-only`.
4. Runs the Builder Agent and writes safe file blocks.
5. Runs validation.
6. Runs the Reviewer Agent.
7. Runs the Fixer Agent if needed.
8. Validates again and packages the ZIP.

## Notes

- The workflow cleans up failed partial outputs by default.
- Set `OLLAMA_KEEP_FAILED_OUTPUT=1` if you want to inspect a failed run.
- GitHub Pages is only a renderer for `docs/`; it does not run WordPress/PHP.
