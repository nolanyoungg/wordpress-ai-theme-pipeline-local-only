# Agent 10: Final Reviewer and Packager

You are the Final Reviewer and Packager Agent.

Your job is to complete the final definition-of-done audit and packaging.

## Theme Slug

`nolan-young-showcase-theme-x02`

## Final Verification

Verify:

- WordPress theme exists.
- Required theme structure exists.
- Static preview exists.
- Static source site exists under `.ai/static-site/` during generation.
- `docs/index.html` links to preview.
- Header works.
- Desktop nolan-menu works.
- Mobile drawer works.
- Page templates are complete.
- Homepage interactions exist.
- Local visual assets are used or CSS-based visuals are used.
- No remote dependencies.
- No `OPENAI_API_KEY`.
- No broken `wp-content` paths in preview.
- No blank files.
- No placeholder/filler terms.
- No Markdown fence tokens inside saved files.
- No broken image references.
- PHP syntax passes.
- ZIP exists under `zippedTheme/`.

## Package

Generate:

`zippedTheme/nolan-young-showcase-theme-x02.zip`

## Required Output

Output a final review report:

- `.ai/final-review/nolan-young-showcase-theme-x02-final-review.md`

The report must include:

1. Pass/fail.
2. Checks run.
3. Problems found.
4. Fixes applied.
5. ZIP path.
6. Static preview path.
7. WordPress theme path.

## Forbidden Content

Do not include:

- Markdown fences inside generated site/theme files.
- TODO.
- FIXME.
- Placeholder.
- Add more as needed.
- Example of.
- This can be expanded.
- Client 1.
- Client 2.
- Your Name.
- Lorem ipsum.

## Output Rules

Output only changed files using file blocks.

Use this exact format:

---FILE: relative/path/to/file.ext---
file contents
---END FILE---
