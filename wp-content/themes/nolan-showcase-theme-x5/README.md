# Nolan Showcase Theme X5 (MNY Photo)

Classic WordPress theme for a premium photography brand demo (“MNY Photo”). Dark, warm-luxury editorial styling with a cinematic homepage and polished inner templates.

## What’s included

- `front-page.php` homepage with sections for portfolio, services, experience/process, signature style, about, proof, testimonials, investment guidance, FAQ, journal preview, and final CTA.
- Templates: `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`, `comments.php`.
- Reusable parts in `template-parts/`.
- Local-only assets:
  - CSS: `assets/css/theme.css`
  - JS: `assets/js/theme.js` (mobile menu, sticky header, scroll reveal, optional portfolio filters)
  - SVG placeholders in `assets/images/` (no external images/fonts/CDNs)

## Setup notes

- To use the homepage as shown, set **Settings → Reading → Your homepage displays → A static page**, then choose a page for “Homepage”.
- Replace SVG placeholders with real photography via the WordPress Media Library and featured images.

## Accessibility

- Skip link to `#main-content`
- Keyboard-usable mobile navigation with `aria-expanded`, Escape-to-close, and outside-click close.
- Visible `:focus-visible` states
- Respects `prefers-reduced-motion`

