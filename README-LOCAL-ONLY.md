# WordPress AI Theme Pipeline (Local-Only, Ollama)

This repository is a local-only WordPress theme pipeline that preserves the versioned theme architecture and GitHub Pages preview structure, but replaces Codex/OpenAI with local Ollama-powered agents.

Key points:
- Codex is not part of the active workflow.
- OpenAI is not part of the active workflow.
- All agent steps use local Ollama at `http://localhost:11434`.
- Default model: `qwen2.5-coder:32b` (override via `$env:OLLAMA_MODEL`).
- GitHub Actions (if enabled) are validation/packaging/pages only and must not call any AI provider.

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

### Skip the Planner (optional)

The default workflow runs Planner -> Builder -> Validate -> Reviewer -> (optional) Fixer -> Validate.

To skip the Planner and go straight to Builder:

```powershell
$env:OLLAMA_WORKFLOW_MODE="builder-only"
```

### Keep failed outputs (optional)

By default, if the workflow fails mid-run, it deletes the newly created theme/preview folders to avoid leaving half-finished versions around.

To keep partial outputs for debugging:

```powershell
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
```

## Validate (themes + previews + zip)

```powershell
powershell -ExecutionPolicy Bypass -File scripts/validate-themes.ps1
```

## Manual git commands

```powershell
git status
git add .
git commit -m "Add local Ollama-built theme version"
```

Optional push command:

```powershell
git push
```

## PR workflow (recommended)

1. Create a branch:

```powershell
git checkout -b feature/theme-xN
```

2. Run the workflow to generate the next versioned theme:

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
git commit -m "Add Nolan Showcase Theme XN (Ollama local-only)"
git push -u origin HEAD
```

5. Open a Pull Request on GitHub from your pushed branch into `main`.

## How the Ollama agent flow works

The local workflow entrypoint is `scripts/run-local-ollama-workflow.ps1`:

1. Detects the next available `nolan-showcase-theme-xN` version.
2. Copies the latest existing theme + preview as a starter for the new version.
3. Runs the Planner Agent (Ollama) to create a plan (no file writes).
4. Runs the Builder Agent (Ollama) which outputs file blocks; the workflow parses and writes those files safely.
5. Runs `scripts/validate-themes.ps1` for required files, PHP lint (when available), preview checks, and ZIP packaging.
6. Runs the Reviewer Agent (Ollama) to spot issues.
7. If needed, runs the Fixer Agent (Ollama) to make targeted repairs via file blocks.
8. Validates again and rebuilds the theme ZIP.
