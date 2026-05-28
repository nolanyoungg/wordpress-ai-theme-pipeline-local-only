# WordPress AI Theme Pipeline Local-Only

A local-only WordPress classic theme generation pipeline powered by Ollama.

This repository is designed to generate versioned WordPress themes, matching static previews, and installable ZIP packages without OpenAI API keys, hosted agents, cloud model calls, or remote AI APIs.

The repo is being refactored from a file-structure-first workflow into a static-first, quality-gated workflow.

The goal is not just to create every required file. The goal is to generate a complete, coherent, visually polished WordPress theme that passes structural validation and finished-theme quality validation.

---

## Current Repository State

- Theme nolan-young-showcase-theme-x01 has been generated, committed, and merged.
- Theme x01 is a pipeline milestone, not the final quality standard.
- Theme x01 proved that the repo can create the required file structure, static preview, ZIP package, and GitHub PR flow.
- Theme x01 also exposed quality problems that the new workflow must reject.
- The next quality target is nolan-young-showcase-theme-x02.
- The repo now includes static-first agent prompts under agents/.
- The repo now includes finished-theme quality validation through scripts/validate-finished-theme.ps1.
- The grouped workflow now runs both structural validation and finished-theme validation.

---

## Local-Only Rules

This repository must remain local-only.

The workflow must not require:

- OpenAI API keys
- Cloud model APIs
- Hosted AI agents
- Remote runtime AI services
- Secrets committed to the repository
- Generated code that depends on external AI services

Ollama should run locally at:

    http://localhost:11434

Recommended local model:

    qwen2.5-coder:14b

---

## What This Repository Produces

Each successful generated theme should include:

- A classic WordPress theme folder under wp-content/themes/
- A static GitHub Pages preview under docs/themes/
- A ZIP package under zippedTheme/
- A preview gallery entry in docs/index.html
- Local validation through PowerShell scripts
- GitHub Actions validation after push
- GitHub Pages publishing after merge

Example target output for theme x02:

    wp-content/themes/nolan-young-showcase-theme-x02/
    docs/themes/nolan-young-showcase-theme-x02/
    zippedTheme/nolan-young-showcase-theme-x02.zip

---

## Static-First Workflow

The intended workflow is now:

1. Architect Planner
2. Static Site Builder
3. Static Site Reviewer
4. WordPress Converter
5. Header Navigation Specialist
6. Page Experience Builder
7. Static Preview Builder
8. JavaScript and Accessibility QA
9. WordPress PHP QA
10. Final Reviewer and Packager

The static website should be created first under:

    .ai/static-site/

The static website is the visual source of truth.

The WordPress theme should only be generated after the static site exists and is reviewed.

The GitHub Pages preview must mirror the approved static site.

---

## Active Agent Files

The active static-first agent prompts are:

    agents/01-architect-planner.md
    agents/02-static-site-builder.md
    agents/03-static-site-reviewer.md
    agents/04-wordpress-converter.md
    agents/05-header-navigation-specialist.md
    agents/06-page-experience-builder.md
    agents/07-static-preview-builder.md
    agents/08-js-accessibility-qa.md
    agents/09-wordpress-php-qa.md
    agents/10-final-review-packager.md

The old four-agent setup was removed to avoid confusion.

Removed legacy files:

    agents/planner-agent.md
    agents/builder-agent.md
    agents/reviewer-agent.md
    agents/fixer-agent.md

---

## Required Theme Direction

Generated themes must be classic WordPress themes, not block themes.

Required navigation:

- What We Do
- Who We Are
- Work
- Resources
- Contact

Required CTA text:

- Contact Us

Required navigation behavior:

- What We Do opens a desktop nolan-menu panel.
- Who We Are opens a desktop nolan-menu panel.
- Resources opens a desktop nolan-menu panel.
- Work links directly to /work/.
- Contact links directly to /contact/.
- Mobile uses a dedicated drawer, not a stacked desktop menu.

Required pages:

- Home
- What We Do
- Who We Are
- Work
- Resources
- Contact

Required page templates:

    page-templates/template-who-we-are.php
    page-templates/template-what-we-do.php
    page-templates/template-work.php
    page-templates/template-resources.php
    page-templates/template-contact.php

---

## Validation

There are two validation layers.

### Structural Validation

Run:

    .\scripts\validate-themes.ps1 -ThemeSlug "nolan-young-showcase-theme-x02"

This checks required files, required folders, basic theme structure, static preview structure, and ZIP presence.

### Finished-Theme Quality Validation

Run:

    .\scripts\validate-finished-theme.ps1 -ThemeSlug "nolan-young-showcase-theme-x02"

This rejects common bad model output, including:

- Markdown fence tokens inside saved files
- TODO
- FIXME
- Placeholder content
- Add more as needed
- Example of
- This can be expanded
- Client 1
- Client 2
- Your Name
- Lorem ipsum
- Coming soon
- Broken static preview asset references
- Missing required navigation terms
- Missing required CSS selector coverage
- Missing required JavaScript functions
- PHP syntax errors

Theme x01 is expected to fail this finished-theme validator. That is intentional.

---

## Local Setup

### Windows

    New-Item -ItemType Directory -Force "C:\Users\Nolan\Documents\Codex\repos" | Out-Null
    cd "C:\Users\Nolan\Documents\Codex\repos"
    git clone https://github.com/nolanyoungg/wordpress-ai-theme-pipeline-local-only.git
    cd "C:\Users\Nolan\Documents\Codex\repos\wordpress-ai-theme-pipeline-local-only"
    git checkout main
    git pull origin main
    git status

### macOS

    mkdir -p "C:\Users\Nolan/Documents/Codex/repos"
    cd "C:\Users\Nolan/Documents/Codex/repos"
    git clone https://github.com/nolanyoungg/wordpress-ai-theme-pipeline-local-only.git
    cd "C:\Users\Nolan/Documents/Codex/repos/wordpress-ai-theme-pipeline-local-only"
    git checkout main
    git pull origin main
    git status

---

## Required Local Tools

Required:

- Git
- PowerShell
- Ollama
- A local Ollama model such as qwen2.5-coder:14b

Recommended:

- GitHub CLI
- PHP CLI
- Node.js and npm
- VS Code

Check Ollama:

    ollama ps
    ollama run qwen2.5-coder:14b "Reply with READY only."

Check PHP:

    php -v

Check GitHub CLI:

    gh auth status

---

## Branch Workflow

Always start from clean main:

    git checkout main
    git pull origin main
    git status

Create a refactor branch:

    git checkout -b refactor/agent-based-static-first-workflow

Create a generated theme branch:

    git checkout -b local-only-theme-02

Do not generate directly on main.

---

## Current Refactor Goal

The current refactor branch is:

    refactor/agent-based-static-first-workflow

Already completed in this refactor:

- Added static-first agent files
- Removed legacy agent files
- Added finished-theme validator
- Wired finished-theme validation into the grouped workflow

Still needed before generating theme x02:

- Add or update a static-first runner script
- Make the workflow actually use the new static-first agents
- Preserve deterministic scaffold behavior
- Confirm validation rejects bad output and accepts good output
- Open and merge the refactor PR
- Generate x02 only after the refactor lands

---

## Existing Grouped Workflow

The grouped workflow still exists, but the project direction is static-first.

Current grouped workflow command pattern:

    $env:OLLAMA_MODEL="qwen2.5-coder:14b"
    $env:OLLAMA_CONTEXT_LENGTH="8192"
    $env:OLLAMA_NUM_PREDICT="4096"
    $env:OLLAMA_REQUEST_TIMEOUT_SECONDS="1200"
    $env:OLLAMA_KEEP_FAILED_OUTPUT="1"
    Remove-Item Env:\OLLAMA_NO_GPU -ErrorAction SilentlyContinue
    $themePrompt = Get-Content -LiteralPath "C:\path\to\prompt.txt" -Raw
    .\scripts\run-local-ollama-workflow-grouped.ps1 -UserTask $themePrompt

Do not use the old grouped workflow to generate x02 until the static-first workflow is fully implemented.

---

## Quality Standard

A generated theme is not successful just because files exist.

A successful theme must:

- Look like a finished website
- Have a complete homepage
- Have complete internal page templates
- Have a working static preview
- Have working desktop navigation
- Have a working mobile drawer
- Avoid missing images
- Avoid filler content
- Avoid Markdown fence pollution
- Pass structural validation
- Pass finished-theme validation
- Produce a valid ZIP package

---

## GitHub Actions

Before merging a generated theme PR, run:

    gh pr checks PR_NUMBER --watch

Only merge after checks pass:

    gh pr merge PR_NUMBER --merge --delete-branch

---

## Safety Rules

Do not commit:

- OPENAI_API_KEY
- API keys
- Secret keys
- .env files
- Credentials
- Vendor credentials
- Remote AI service configuration

Do not generate themes that depend on external AI services.

Do not accept generated files that contain placeholder instructions or broken references.

---

## Project Direction

The repo is moving toward this model:

- Static-first
- Visual-first
- Local-only
- Deterministic scaffold
- Strict quality gate
- WordPress conversion after static approval

The repo should not ask the model to be disciplined and then hope for the best.

The repo should reject undisciplined output automatically.
