# WordPress AI Theme Pipeline Local-Only

A local-only WordPress theme generation pipeline powered by Ollama.

This repository generates versioned classic WordPress themes, matching static GitHub Pages previews, and installable ZIP packages without using OpenAI API keys, remote AI APIs, hosted agents, or cloud model calls.

The current pipeline is built for local development, local model execution, Git-based review, GitHub Actions validation, and GitHub Pages preview publishing.

---

## Current Repository State

This repository is currently configured as a clean local-only theme generation pipeline.

At the time of this README update:

- No generated production theme is committed yet.
- The first real generated theme should be `nolan-young-showcase-theme-x01`.
- Theme generation happens locally through Ollama.
- The default local model is `qwen2.5-coder:14b`.
- The grouped workflow is the recommended workflow for large prompts.
- GitHub Actions validates committed themes.
- GitHub Pages publishes the static preview gallery from `docs/`.

The repository intentionally separates pipeline code from generated theme output. Generated themes should be created on their own feature branches, reviewed, validated, then merged into `main`.

---

## What This Repository Does

This repo helps generate complete, versioned, classic WordPress themes.

Each generated theme gets:

- A WordPress theme folder under `wp-content/themes/`
- A static preview folder under `docs/themes/`
- A ZIP package under `zippedTheme/`
- A gallery entry in `docs/index.html`
- Validation through PowerShell and GitHub Actions
- Optional GitHub Pages publishing after merge

Example generated output:

```text
wp-content/themes/nolan-young-showcase-theme-x01/
docs/themes/nolan-young-showcase-theme-x01/
zippedTheme/nolan-young-showcase-theme-x01.zip
docs/index.html
```

The next theme version is detected automatically from existing theme folders.

If no theme folders exist, the first generated theme is:

```text
nolan-young-showcase-theme-x01
```

If `x01` already exists, the next generated theme is:

```text
nolan-young-showcase-theme-x02
```

---

## What This Repository Is For

Use this repo when you want to:

- Generate full classic WordPress themes locally
- Build theme versions without cloud AI services
- Use a local coding model through Ollama
- Produce a WordPress-installable ZIP package
- Maintain static GitHub Pages previews for each theme
- Keep each theme version separate and reviewable
- Experiment with AI-assisted WordPress theme generation safely
- Build a portfolio of versioned WordPress themes
- Keep generated output auditable through Git commits and pull requests

This repo is especially useful for:

- WordPress theme prototyping
- Portfolio theme generation
- Local AI coding workflows
- Theme design experiments
- Repeatable prompt-based theme builds
- Offline or privacy-sensitive AI-assisted development

---

## Local-Only Rules

This repository is intentionally local-only.

The generation workflow should not require:

- OpenAI API keys
- Cloud model APIs
- Hosted AI agents
- Remote runtime AI services
- Secrets committed to the repository
- Generated code that depends on external AI services

Ollama runs on your machine at:

```text
http://localhost:11434
```

The recommended model is:

```text
qwen2.5-coder:14b
```

---

## How the Pipeline Works

The recommended workflow is:

```text
Prompt file
  ↓
Grouped local Ollama workflow
  ↓
Builder Agent stages
  ↓
Deterministic theme scaffold
  ↓
Deterministic preview scaffold
  ↓
Validation
  ↓
ZIP package
  ↓
Git commit and PR
  ↓
GitHub Actions validation
  ↓
GitHub Pages preview
```

### Main Workflow Script

Use this script for large prompts:

```text
scripts/run-local-ollama-workflow-grouped.ps1
```

This is the recommended workflow because it splits generation into grouped stages instead of forcing one large model response.

The grouped stages include:

```text
1. WordPress core PHP files
2. WordPress theme CSS and JavaScript assets
3. Static preview files
4. Docs gallery index
```

### Supporting Scripts

```text
scripts/ollama-agent.ps1
```

Runs a specific agent against Ollama and writes generated file blocks into the repository.

```text
scripts/theme-structure.ps1
```

Defines and enforces the required generated theme structure. This script backfills required files if the local model skips small but required files.

```text
scripts/validate-themes.ps1
```

Validates generated themes, required files, PHP syntax, asset references, preview files, and ZIP output.

```text
scripts/check-npm-allowlist.mjs
```

Checks allowed npm dependencies.

```text
scripts/build-react-bundles.mjs
```

Builds optional React bundles when relevant.

---

## Required Generated Theme Structure

Every generated theme is expected to follow this structure.

```text
wp-content/themes/THEMENAME/
  style.css
  functions.php
  theme.json
  screenshot.png
  README.md
  .editorconfig
  .gitignore

  header.php
  footer.php
  front-page.php
  index.php
  page.php
  single.php
  archive.php
  search.php
  404.php
  comments.php

  inc/
    setup.php
    enqueue.php
    template-tags.php
    helpers.php
    custom-post-types.php
    customizer.php

  assets/
    css/
      main.css
    js/
      bundle.js
    icons/
      README.md
    images/
      hero/
      portfolio/
      texture/

  src/
    js/
      main.js
    scss/
      main.scss
      abstracts/
        _variables.scss
        _mixins.scss
        _functions.scss
      base/
        _reset.scss
        _typography.scss
        _accessibility.scss
        _forms.scss
      components/
        _buttons.scss
        _cards.scss
        _forms.scss
        _badges.scss
        _accordion.scss
        _carousel.scss
        _portfolio-filter.scss
        _before-after.scss
      layout/
        _container.scss
        _header.scss
        _footer.scss
        _grid.scss
        _sections.scss
      pages/
        _home.scss
        _contact.scss
        _services.scss
        _work.scss
        _resources.scss
        _who-we-are.scss

  template-parts/
    content-hero.php
    content-brand-statement.php
    content-featured-work.php
    content-services.php
    content-process.php
    content-style-pillars.php
    content-testimonials.php
    content-resources-preview.php
    content-final-cta.php
    content-footer-widgets.php
    content-none.php
    content-page.php
    content-single.php

  page-templates/
    template-who-we-are.php
    template-what-we-do.php
    template-our-work.php
    template-resources.php
    template-contact.php

  blocks/
    README.md

  build/
    webpack.config.js

  package.json
  package-lock.json
```

The model may create richer content, but the pipeline guarantees the required structure exists before validation.

---

## Runtime Assets vs Source Assets

Generated themes include both source files and runtime files.

### Runtime files

WordPress loads these files directly:

```text
assets/css/main.css
assets/js/bundle.js
```

These files must exist in the committed theme so the theme can run without requiring a build step.

### Source files

Developers can edit these files for future build workflows:

```text
src/js/main.js
src/scss/main.scss
src/scss/**/*
```

### Build files

Each theme may include:

```text
build/webpack.config.js
package.json
package-lock.json
```

These are included so a theme can evolve into a traditional build-based workflow later.

---

## Static Preview Structure

Each generated theme also gets a static preview under `docs/themes/`.

Example:

```text
docs/themes/nolan-young-showcase-theme-x01/
  index.html
  assets/
    css/
      preview.css
    js/
      preview.js
```

GitHub Pages serves the `docs/` directory, not WordPress.

That means preview pages are static HTML/CSS/JS representations of the theme. They do not execute PHP and they do not behave like a real WordPress install.

---

## ZIP Package Output

Generated ZIPs are written to:

```text
zippedTheme/
```

Example:

```text
zippedTheme/nolan-young-showcase-theme-x01.zip
```

These ZIPs are intended to be installable through the WordPress admin theme uploader.

---

## GitHub Actions

The repo currently uses two workflows.

### Validate Themes

```text
.github/workflows/validate-themes.yml
```

Runs on:

- Pull requests to `main`
- Pushes to `main`
- Manual workflow dispatch

It validates generated themes by running:

```powershell
./scripts/validate-themes.ps1
```

It also uploads ZIP artifacts if ZIPs exist. Missing ZIPs are treated as a warning so tooling-only PRs do not fail.

### Deploy GitHub Pages

```text
.github/workflows/pages.yml
```

Runs on pushes to `main` when these paths change:

```text
docs/**
zippedTheme/**
.github/workflows/pages.yml
```

It publishes the `docs/` directory as the GitHub Pages site.

Before publishing, it copies `zippedTheme/` into:

```text
docs/zippedTheme/
```

This makes ZIP files available from the published preview site when ZIPs are committed.

---

## Required Local Tools

Install these tools before running the pipeline locally.

### Required on Windows and macOS

- Git
- GitHub CLI
- Node.js 20 or newer
- npm
- PHP 8.2 or newer
- Ollama
- PowerShell 7 or newer
- A local Ollama coding model

Recommended model:

```text
qwen2.5-coder:14b
```

Optional larger model:

```text
qwen2.5-coder:32b
```

The 14B model is the default because it is more practical for local machines and faster for iterative grouped generation.

---

## Windows Setup

### 1. Install Git

Download and install Git for Windows:

```text
https://git-scm.com/download/win
```

Verify:

```powershell
git --version
```

### 2. Install GitHub CLI

Install GitHub CLI:

```powershell
winget install --id GitHub.cli
```

Verify:

```powershell
gh --version
```

Login:

```powershell
gh auth login
```

### 3. Install Node.js

Install Node.js LTS:

```powershell
winget install OpenJS.NodeJS.LTS
```

Verify:

```powershell
node --version
npm --version
```

### 4. Install PHP

Install PHP 8.2 or newer.

Verify:

```powershell
php -v
```

### 5. Install PowerShell 7

Windows PowerShell 5 can run many commands, but PowerShell 7 is recommended.

```powershell
winget install --id Microsoft.PowerShell
```

Verify:

```powershell
pwsh --version
```

### 6. Install Ollama

Download Ollama for Windows:

```text
https://ollama.com/download
```

Start Ollama, then verify:

```powershell
ollama --version
ollama list
```

### 7. Pull the recommended model

```powershell
ollama pull qwen2.5-coder:14b
```

Test it:

```powershell
ollama run qwen2.5-coder:14b "Reply with READY only."
```

Expected:

```text
READY
```

---

## macOS Setup

### 1. Install Homebrew

Homebrew is optional, but it is the easiest way to install the required local tools on macOS.

```zsh
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### 2. Install Git, GitHub CLI, Node, PHP, and PowerShell

```zsh
brew install git gh node php powershell
```

Verify:

```zsh
git --version
gh --version
node --version
npm --version
php -v
pwsh --version
```

### 3. Install Ollama

```zsh
brew install --cask ollama
```

Start Ollama from Applications or run:

```zsh
open -a Ollama
```

Verify:

```zsh
ollama --version
ollama list
```

### 4. Pull the recommended model

```zsh
ollama pull qwen2.5-coder:14b
```

Test it:

```zsh
ollama run qwen2.5-coder:14b "Reply with READY only."
```

Expected:

```text
READY
```

---

## Clone the Repository

### Windows Clone

Choose a parent folder, then clone:

```powershell
cd "C:\Users\YOURNAME\codex-nolan-local\repos"

git clone https://github.com/nolanyoungg/wordpress-ai-theme-pipeline-local-only.git

cd "C:\Users\YOURNAME\codex-nolan-local\repos\wordpress-ai-theme-pipeline-local-only"
```

Install Node dependencies:

```powershell
npm ci
```

Confirm clean state:

```powershell
git status
```

### macOS Clone

Choose a parent folder, then clone:

```zsh
mkdir -p "$HOME/codex-nolan-local/repos"
cd "$HOME/codex-nolan-local/repos"

git clone https://github.com/nolanyoungg/wordpress-ai-theme-pipeline-local-only.git

cd "$HOME/codex-nolan-local/repos/wordpress-ai-theme-pipeline-local-only"
```

Install Node dependencies:

```zsh
npm ci
```

Confirm clean state:

```zsh
git status
```

---

## Update an Existing Local Clone

### Windows

```powershell
cd "C:\Users\YOURNAME\codex-nolan-local\repos\wordpress-ai-theme-pipeline-local-only"

git checkout main
git pull origin main
git status
```

### macOS

```zsh
cd "$HOME/codex-nolan-local/repos/wordpress-ai-theme-pipeline-local-only"

git checkout main
git pull origin main
git status
```

---

## Recommended Branch Workflow

Never generate a real theme directly on `main`.

Use a dedicated branch per theme:

```powershell
git checkout main
git pull origin main
git checkout -b local-only-theme-01
```

After generating and validating the theme, commit the generated files and open a pull request.

Example branch naming:

```text
local-only-theme-01
local-only-theme-02
local-only-theme-03
```

---

## Generate a Theme From a Prompt File

The recommended workflow is the grouped workflow:

```text
scripts/run-local-ollama-workflow-grouped.ps1
```

### Windows

```powershell
cd "C:\Users\YOURNAME\codex-nolan-local\repos\wordpress-ai-theme-pipeline-local-only"

$env:OLLAMA_MODEL="qwen2.5-coder:14b"
$env:OLLAMA_CONTEXT_LENGTH="8192"
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
Remove-Item Env:\OLLAMA_NO_GPU -ErrorAction SilentlyContinue

$promptPath = "C:\Users\YOURNAME\codex-nolan-local\Codex-Prompts\your-theme-prompt.txt"

if (-not (Test-Path -LiteralPath $promptPath)) {
  throw "Prompt file not found: $promptPath"
}

$themePrompt = Get-Content -LiteralPath $promptPath -Raw

Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass -Force

& .\scripts\run-local-ollama-workflow-grouped.ps1 -UserTask $themePrompt
```

### macOS

Use `pwsh` because the workflow scripts are PowerShell scripts.

```zsh
cd "$HOME/codex-nolan-local/repos/wordpress-ai-theme-pipeline-local-only"

pwsh
```

Then inside PowerShell:

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:14b"
$env:OLLAMA_CONTEXT_LENGTH="8192"
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
Remove-Item Env:\OLLAMA_NO_GPU -ErrorAction SilentlyContinue

$promptPath = "$HOME/codex-nolan-local/Codex-Prompts/your-theme-prompt.txt"

if (-not (Test-Path -LiteralPath $promptPath)) {
  throw "Prompt file not found: $promptPath"
}

$themePrompt = Get-Content -LiteralPath $promptPath -Raw

& ./scripts/run-local-ollama-workflow-grouped.ps1 -UserTask $themePrompt
```

---

## Validate a Generated Theme

Validate all generated themes:

```powershell
& .\scripts\validate-themes.ps1
```

Validate one generated theme:

```powershell
& .\scripts\validate-themes.ps1 -ThemeSlug "nolan-young-showcase-theme-x01"
```

A successful validation ends with:

```text
OK
```

---

## Verify Generated Required Structure

Use this after generation if you want to confirm the standard file contract:

```powershell
$themeRoot = ".\wp-content\themes\nolan-young-showcase-theme-x01"

. ".\scripts\theme-structure.ps1"

$requiredFiles = Get-RequiredThemeFiles -ThemeSlug "nolan-young-showcase-theme-x01"

$missing = foreach ($file in $requiredFiles) {
  if (-not (Test-Path -LiteralPath (Join-Path $themeRoot $file))) {
    $file
  }
}

if ($missing) {
  "Missing files:"
  $missing
} else {
  "All required files exist."
}
```

Expected:

```text
All required files exist.
```

---

## Commit a Generated Theme

After generation, inspect the changes:

```powershell
git status
```

Add the generated theme, preview, ZIP, and gallery index:

```powershell
git add -f wp-content/themes/nolan-young-showcase-theme-x01
git add -f docs/themes/nolan-young-showcase-theme-x01
git add -f zippedTheme/nolan-young-showcase-theme-x01.zip
git add docs/index.html
```

Commit:

```powershell
git commit -m "Add nolan-young-showcase-theme-x01"
```

Push:

```powershell
git push -u origin local-only-theme-01
```

Create a pull request:

```powershell
gh pr create `
  --base main `
  --head local-only-theme-01 `
  --title "Add nolan-young-showcase-theme-x01" `
  --body "Adds the first generated local-only WordPress theme, its static GitHub Pages preview, gallery entry, and ZIP package."
```

---

## Publish Preview to GitHub Pages

After the PR is merged into `main`, GitHub Actions deploys the `docs/` folder to GitHub Pages.

The static gallery lives at:

```text
docs/index.html
```

Theme previews live under:

```text
docs/themes/
```

ZIP files are copied into:

```text
docs/zippedTheme/
```

---

## Working With Large Prompts

Large prompts should be stored outside the repo unless they are intentionally reusable.

Good local prompt folder example:

```text
C:\Users\YOURNAME\codex-nolan-local\Codex-Prompts\
```

Example prompt file:

```text
C:\Users\YOURNAME\codex-nolan-local\Codex-Prompts\mny-prompt-v2-GREAT.txt
```

The grouped workflow is designed for large prompts because it breaks the generation into smaller stages.

Recommended environment:

```powershell
$env:OLLAMA_MODEL="qwen2.5-coder:14b"
$env:OLLAMA_CONTEXT_LENGTH="8192"
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
```

For some machines, very high context values can cause CUDA or runner instability. If Ollama fails with CUDA initialization errors, use a lower context value such as `8192` or `16384`.

---

## Troubleshooting

### Ollama is not reachable

Error:

```text
Ollama is not reachable at http://localhost:11434
```

Fix:

```powershell
Start-Process "$env:LOCALAPPDATA\Programs\Ollama\ollama app.exe"
Start-Sleep -Seconds 10
ollama run qwen2.5-coder:14b "Reply with READY only."
```

On macOS:

```zsh
open -a Ollama
ollama run qwen2.5-coder:14b "Reply with READY only."
```

### Model is not installed

Error:

```text
Required Ollama model 'qwen2.5-coder:14b' is not installed.
```

Fix:

```powershell
ollama pull qwen2.5-coder:14b
```

### CUDA or GPU errors

If Ollama fails with a CUDA error, restart Ollama and lower the context length:

```powershell
Get-Process | Where-Object { $_.ProcessName -like "*ollama*" } | Stop-Process -Force
Start-Process "$env:LOCALAPPDATA\Programs\Ollama\ollama app.exe"
Start-Sleep -Seconds 10

$env:OLLAMA_CONTEXT_LENGTH="8192"
ollama run qwen2.5-coder:14b "Reply with READY only."
```

### Failed outputs are being deleted

Set this before running generation:

```powershell
$env:OLLAMA_KEEP_FAILED_OUTPUT="1"
```

This keeps partial files for debugging.

### PowerShell script execution is blocked

Use process-scoped bypass:

```powershell
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass -Force
```

### GitHub Actions says no ZIPs were found

Tooling-only PRs may not have ZIPs. The current workflow treats missing ZIPs as a warning, not a failure.

Theme PRs should still commit the generated ZIP.

### GitHub Pages does not show PHP output

Expected. GitHub Pages only serves static files. It cannot run WordPress or PHP.

Static previews live under:

```text
docs/themes/
```

The actual WordPress theme lives under:

```text
wp-content/themes/
```

---

## Security Notes

Do not commit:

- API keys
- `.env` files
- Credentials
- Private prompt files with sensitive information
- Generated code that embeds secrets
- Cloud AI service tokens

This repo should stay local-only and safe to publish.

---

## Recommended First Real Theme Flow

From a clean `main`:

```powershell
git checkout main
git pull origin main
git status

git checkout -b local-only-theme-01
```

Run the grouped workflow using your optimized prompt file.

The first real theme should generate:

```text
nolan-young-showcase-theme-x01
```

Then validate, commit, push, and open a PR.

---

## Repository Philosophy

This repo is designed around a simple rule:

Generate locally, validate deterministically, review through Git, publish static previews through GitHub Pages.

The local model can be creative. The repository scripts must be strict.

That split is intentional:

- Ollama handles creative theme generation.
- The grouped workflow makes large prompts manageable.
- The structure scaffold guarantees required files.
- The validator catches broken output.
- GitHub Actions verifies the repo after push.
- GitHub Pages publishes the static preview.
