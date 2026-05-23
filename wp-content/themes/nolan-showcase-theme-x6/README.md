# Nolan Showcase Theme X6

Classic WordPress theme for **MNY Photo** — premium, editorial, cinematic, warm-luxury styling.

## Structure

- `inc/` theme setup + enqueue + helpers
- `template-parts/` reusable homepage sections
- `page-templates/` multi-page brand templates
- `assets/src/` SCSS + JS sources
- `assets/dist/` compiled assets enqueued by the theme
- `assets/images/` local SVG placeholders (no remote assets)

## Development

This theme ships with compiled assets so it works immediately. To rebuild locally:

1. `cd wp-content/themes/nolan-showcase-theme-x6`
2. `npm install`
3. `npm run build`

Watch during development:

- `npm run watch`

## Notes

- Enqueued assets:
  - `assets/dist/css/theme.min.css`
  - `assets/dist/js/theme.min.js`
- No external CDNs, fonts, or runtime assets are used.

