# AGENTS.md

## Project purpose

This repository is used to build, review, and publish WordPress theme work through a controlled AI-assisted workflow that runs locally with Codex and publishes a static preview through GitHub Pages.

## Repository layout

- WordPress themes belong in `wp-content/themes/`.
- Each build should create a new numbered theme directory such as:
  `wp-content/themes/nolan-showcase-theme/`
  `wp-content/themes/nolan-showcase-theme-x2/`
  `wp-content/themes/nolan-showcase-theme-x3/`
- Treat `nolan-showcase-theme` as the base build and increment the suffix for later runs.
- A static GitHub Pages preview should be created at:
  `preview/`
- Each theme build should also create a zip archive beside the theme directory.
- Do not modify WordPress core files.
- Do not commit uploads, cache files, backups, or environment files.
- Local Codex prompts live in `.github/codex/prompts/`.

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
- Also build a static visual preview in `preview/` so GitHub Pages can show a sneak peek of the theme.
- The preview should mirror the homepage design and interactions as closely as possible using static HTML, CSS, and vanilla JavaScript.
- The preview must not require build tools, remote CDNs, API keys, SSH, SFTP, or external services.
- Required preview entry file: `preview/index.html`.

## Local Codex workflow rules

- Use Codex signed into the ChatGPT account to run the planner, builder, and reviewer steps locally.
- Do not assume or require an OpenAI API key.
- GitHub Actions are for validation and Pages deployment only.
- Keep AI-generated artifacts in `.ai/` until you are ready to commit them.
- The local workflow script should push the feature branch after a successful build so GitHub Pages can update from the preview.

## AI workflow rules

- Make the smallest safe change that satisfies the task.
- Avoid unrelated refactors.
- Do not push directly to `main`.
- All work must go through a pull request.
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
- A static GitHub Pages preview exists at `preview/index.html`.
- A theme zip archive exists beside the numbered theme folder.
- PHP files pass syntax checks.
- Obvious broken links, missing assets, and invalid paths are avoided.
- The PR summary explains what changed.
