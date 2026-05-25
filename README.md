# WordPress AI Theme Pipeline (Local-Only, Ollama)

This repository is a pipeline for generating **versioned classic WordPress themes** with **static GitHub Pages previews** and **downloadable ZIP artifacts**.

This local-only version replaces Codex/OpenAI with **local Ollama agents** (default model: `qwen2.5-coder:32b`) and **PowerShell orchestration**.

## Hard constraints (by design)

- No cloud AI providers.
- No `OPENAI_API_KEY` requirements.
- No paid AI API keys required; free build tooling (`npm`) is allowed.
- GitHub Actions are used only for validation, packaging ZIP files, and publishing GitHub Pages previews.
- GitHub Pages does not run PHP/WordPress; previews are static HTML under `docs/`.

## Repo structure

- WordPress themes: `wp-content/themes/nolan-showcase-theme-x1/`, `...-x2/`, `...-x3/`, etc.
- Generated theme zip output folder: `zippedTheme/` (committed so you can download directly from the repo)
- GitHub Pages gallery and previews: `docs/`
  - Gallery: `docs/index.html`
  - Per-theme previews: `docs/themes/<theme-slug>/index.html`
- Workflows: `.github/workflows/validate-package-preview.yml`
- Local helpers:
  - `scripts/list-theme-versions.sh` (CI helper)
  - `scripts/validate-themes.sh` (CI helper)
  - Windows/Ollama workflow: `scripts/run-local-ollama-workflow.ps1`
  - Windows validator: `scripts/validate-themes.ps1`

## Theme versioning

Themes must always be created as a new folder:

- `wp-content/themes/nolan-showcase-theme-x1`
- `wp-content/themes/nolan-showcase-theme-x2`
- `wp-content/themes/nolan-showcase-theme-x3`

Never overwrite older versions.

## Create the next theme version (Windows + Ollama)

See [README-LOCAL-ONLY.md](README-LOCAL-ONLY.md) for prerequisites, setup commands, and the exact PowerShell command to run the workflow.

## Optional: React components (build step)

This repo supports optional React bundling using `esbuild` (no CDN runtime required). To opt into React for a theme or preview, create an entry file:

- Theme bundle: `wp-content/themes/<theme-slug>/assets/js/theme.entry.jsx` (outputs `assets/js/theme.js`)
- Preview bundle: `docs/themes/<theme-slug>/assets/js/preview.entry.jsx` (outputs `assets/js/preview.js`)

Then run:

```bash
npm install
npm run build:react-bundles
```

CI will fail if bundling produces changes that aren't committed.

## GitHub Actions: validation + ZIP artifacts

The workflow `.github/workflows/validate-package-preview.yml`:

- Detects all `wp-content/themes/nolan-showcase-theme-x*` folders
- Validates required theme files and `style.css` theme header
- Runs `php -l` over all PHP files in each theme
- Verifies a committed zip exists for every detected theme: `zippedTheme/nolan-showcase-theme-xN.zip`
- Builds fresh zips in CI (into `tmpZips/`) and verifies they match the committed zip for any theme versions changed in the run
- Uploads the freshly-built zips as the `theme-zips` workflow artifact

Important: when you add a new theme version (or edit an existing theme version), you must regenerate and commit the matching zip(s) in `zippedTheme/`.

## GitHub Pages: static previews

This repo can deploy `docs/` to GitHub Pages through GitHub Actions.

To enable Pages:

1. Repo Settings -> Pages
2. Source: GitHub Actions

## Notes

- The active local-only workflow is PowerShell + Ollama (`scripts/run-local-ollama-workflow.ps1`).
- The legacy Codex helper (`scripts/run-local-workflow.sh`) and `.github/codex/` prompts may exist for historical reference, but are not used by the local-only workflow.

