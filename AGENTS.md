# AGENTS.md

## Project purpose

This repository builds, reviews, validates, packages, and publishes **versioned classic WordPress themes** through a controlled AI-assisted workflow run **locally** with Ollama, plus optional GitHub Actions for validation/packaging and GitHub Pages for static previews.

## Repository layout

- WordPress themes belong in `wp-content/themes/` and must be versioned folders:
  - `wp-content/themes/nolan-young-showcase-theme-x01/`
  - `wp-content/themes/nolan-young-showcase-theme-x02/`
  - `wp-content/themes/nolan-young-showcase-theme-x03/`
- Never overwrite an older theme version.
- Static GitHub Pages previews belong in `docs/`:
  - Gallery: `docs/index.html`
  - Per-theme preview: `docs/themes/<theme-slug>/index.html`
- ZIP outputs belong in `zippedTheme/` (build output):
  - Never put ZIPs under `wp-content/themes/`.
  - ZIPs are committed in this repo so they can be downloaded directly from GitHub.
  - If you change `wp-content/themes/<theme-slug>/`, you must regenerate and commit `zippedTheme/<theme-slug>.zip`.
  - CI will fail if committed zips are stale compared to the theme source.
- GitHub Actions also uploads freshly-built zip artifacts for each theme as `theme-zips`.
- Do not modify WordPress core files.
- Do not commit uploads, cache files, backups, or environment files.
- Local Ollama prompt templates live in `prompts/`.

## WordPress theme rules

- Build a production-quality WordPress theme.
- Use safe WordPress escaping functions where applicable:
  - `esc_html()`
  - `esc_attr()`
  - `esc_url()`
  - `wp_kses_post()`
- Use proper enqueueing through `functions.php`.
- Do not hardcode production secrets, tokens, API keys, or private URLs.
- Do not rely on remote CDNs unless explicitly requested.
- Prefer local assets inside the theme.
- Keep templates readable and maintainable.

## GitHub Pages preview rules

- GitHub Pages cannot execute WordPress PHP templates.
- Build the full WordPress theme in a numbered folder under `wp-content/themes/`.
- Also build a static visual preview in `docs/themes/<theme-slug>/` so GitHub Pages can show a sneak peek of the theme.
- The preview should mirror the homepage design and interactions as closely as possible using static HTML, CSS, and vanilla JavaScript.
- The preview must not require remote CDNs, API keys, SSH, SFTP, or paid external services at runtime.
- Required gallery entry file: `docs/index.html`.
- Required per-theme preview entry file: `docs/themes/<theme-slug>/index.html`.

## Local Ollama workflow rules

- Use Ollama locally for the planner, builder, reviewer, and optional fixer steps.
- The only allowed AI endpoint is `http://localhost:11434`.
- Do not assume or require `OPENAI_API_KEY` or any cloud AI provider credentials.
- Free build tooling such as `npm` is allowed; do not introduce paid AI API requirements.
- Keep the npm dependency surface tiny; the current allowlist is `esbuild`, `react`, and `react-dom`.
- CI runs `npm audit --audit-level=high`; fix or remove dependencies that trip it.
- GitHub Actions are for validation, zip packaging, and Pages deployment only.
- Keep AI-generated artifacts in `.ai/` until you are ready to commit them.
- Branching/PRs are optional; use your preferred git workflow.

## AI workflow rules

- Make the smallest safe change that satisfies the task.
- Avoid unrelated refactors.
- Explain changed files clearly.
- Include verification steps performed.
- Flag any work that could not be completed.
- No repository secret is required for the AI workflow in this repository.

## Review priorities

Review in this order:

1. Correctness
2. Security
3. WordPress compatibility
4. Accessibility
5. Performance
6. Maintainability
7. Visual polish

## Definition of done

A task is done only when:

- The requested files are created or updated.
- The theme has a valid WordPress theme header.
- A static GitHub Pages gallery exists at `docs/index.html`.
- A static per-theme preview exists at `docs/themes/<theme-slug>/index.html`.
- PHP files pass syntax checks (`php -l`).
- Generated zips exist under `zippedTheme/` and contain key files (style.css, functions.php, assets/css/theme.css, assets/js/theme.js).
- If React entrypoints are used (`theme.entry.*` / `preview.entry.*`), `npm run build:react-bundles` has been run and the generated outputs are committed.
- Obvious broken links, missing assets, and invalid paths are avoided.
- The PR summary explains what changed.
