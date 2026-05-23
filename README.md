# WordPress AI Theme Pipeline

This repository now uses a local Codex workflow with ChatGPT Pro or another eligible ChatGPT plan. There is no OpenAI API key in this setup.

The flow is:

1. You sign into Codex with your ChatGPT account.
2. Codex runs locally against this repo.
3. Codex writes the WordPress theme into a new numbered folder under `wp-content/themes/`, such as `nolan-showcase-theme-x2/`.
4. Codex writes a static sneak peek into `preview/`.
5. Codex creates a zip archive beside that folder for quick WordPress upload.
6. The script commits and pushes the branch.
7. GitHub Actions validate PHP and required files.
8. GitHub Pages publishes the static preview.
9. You review the PR and merge it.

## What you need

Only these are required:

- ChatGPT Pro plan
- Codex
- GitHub

No OpenAI API key is required.
No SSH, SFTP, or deployment credentials are required.

## Repo Layout

- `wp-content/themes/nolan-showcase-theme/` is the base classic WordPress theme build.
- The next build can add numbered folders such as `wp-content/themes/nolan-showcase-theme-x2/` and `wp-content/themes/nolan-showcase-theme-x3/`.
- `preview/` holds the static GitHub Pages sneak peek.
- `.github/codex/prompts/` holds the local planner, builder, and reviewer prompts.

## GitHub Setup

1. In the repository settings, turn on GitHub Pages with `Source: GitHub Actions`.
2. Do not add any repository secrets for this workflow.
3. Use the Actions tab only for validation and preview publishing.

After the first successful merge to `main`, the preview should be available at:

```text
https://nolanyoungg.github.io/wordpress-ai-theme-pipeline/
```

## Local Codex Workflow

Run Codex from your terminal in this order:

### 1. Planner

Run the local workflow script with your task. It will call Planner, Builder, and Reviewer in sequence.
If you are on `main`, it will automatically create a feature branch first.
It also writes a zip archive next to the numbered theme folder and pushes the branch when the build succeeds.

```text
bash scripts/run-local-workflow.sh "Build a new production-quality WordPress theme named Nolan Showcase Theme..."
```

### 2. Verification

Run the checks locally before pushing.

```text
find wp-content/themes/nolan-showcase-theme -name "*.php" -type f -print0 | xargs -0 -n 1 php -l
```

### 3. Commit and push

Create a branch, commit the generated files, and push to GitHub. Open a PR and review it there.

## First Task

The first build task should create a premium WordPress portfolio theme named `Nolan Showcase Theme` and a matching static preview. The theme should emphasize software development, WordPress work, AI automation, analytics, and technical leadership.

The required output is listed in `.github/codex/prompts/builder.md`.

## Manual Review Checklist

Before merging, check:

1. The AI only changed the theme and preview files.
2. The WordPress theme header in `style.css` is valid.
3. The PHP files pass syntax checks.
4. The preview files exist and look coherent.
5. The mobile navigation and skip link are present.
6. Asset paths are local and correct.
7. The reviewer report does not flag blocking issues.

## After Merge

When the PR is merged into `main`:

1. `theme-checks.yml` runs validation on the theme and preview.
2. `deploy.yml` publishes the static preview to GitHub Pages.
3. You review the preview in the browser.

No production WordPress deployment is part of this version.
