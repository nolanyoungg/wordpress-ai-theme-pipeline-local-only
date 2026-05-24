#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEMES_DIR="$ROOT_DIR/wp-content/themes"
DOCS_DIR="$ROOT_DIR/docs"

needs_node_build=0
if find "$THEMES_DIR" -type f \( -name "theme.entry.js" -o -name "theme.entry.jsx" -o -name "theme.entry.ts" -o -name "theme.entry.tsx" \) -print -quit | grep -q .; then
  needs_node_build=1
fi
if find "$DOCS_DIR/themes" -type f \( -name "preview.entry.js" -o -name "preview.entry.jsx" -o -name "preview.entry.ts" -o -name "preview.entry.tsx" \) -print -quit 2>/dev/null | grep -q .; then
  needs_node_build=1
fi

if [ "$needs_node_build" -eq 1 ]; then
  if ! command -v node >/dev/null 2>&1; then
    echo "node is required on PATH when using React entrypoints (theme.entry.* / preview.entry.*)." >&2
    exit 1
  fi
  if ! command -v npm >/dev/null 2>&1; then
    echo "npm is required on PATH when using React entrypoints (theme.entry.* / preview.entry.*)." >&2
    exit 1
  fi
  if [ -f "$ROOT_DIR/package.json" ]; then
    (cd "$ROOT_DIR" && npm run check:npm-allowlist)
    echo "Building React bundles (entrypoints detected)..."
    (cd "$ROOT_DIR" && npm run build:react-bundles)
  fi
fi

if ! command -v php >/dev/null 2>&1; then
  echo "php is required on PATH for validation." >&2
  exit 1
fi

if ! command -v zip >/dev/null 2>&1; then
  echo "zip is required on PATH for packaging." >&2
  exit 1
fi

themes=()
while IFS= read -r t; do
  themes+=("$t")
done < <("$ROOT_DIR/scripts/list-theme-versions.sh")

if [ "${#themes[@]}" -eq 0 ]; then
  echo "No themes found matching nolan-showcase-theme-x* under $THEMES_DIR" >&2
  exit 1
fi

required_files=(
  "style.css"
  "functions.php"
  "index.php"
  "header.php"
  "footer.php"
  "front-page.php"
  "page.php"
  "single.php"
  "archive.php"
  "search.php"
  "404.php"
  "comments.php"
  "template-parts/content.php"
  "template-parts/content-page.php"
  "template-parts/content-none.php"
  "assets/css/theme.css"
  "assets/js/theme.js"
  "README.md"
)

if [ ! -f "$DOCS_DIR/index.html" ]; then
  echo "Missing docs/index.html" >&2
  exit 1
fi

echo "Validating themes:"
printf '  - %s\n' "${themes[@]}"

for theme_slug in "${themes[@]}"; do
  theme_dir="$THEMES_DIR/$theme_slug"
  preview_dir="$DOCS_DIR/themes/$theme_slug"

  echo "==> $theme_slug"

  for rel in "${required_files[@]}"; do
    if [ ! -f "$theme_dir/$rel" ]; then
      echo "Missing required file: $theme_dir/$rel" >&2
      exit 1
    fi
  done

  if ! grep -q "^Theme Name:" "$theme_dir/style.css"; then
    echo "Missing Theme Name header: $theme_dir/style.css" >&2
    exit 1
  fi

  css_bytes="$(wc -c < "$theme_dir/assets/css/theme.css" | tr -d ' ')"
  if [ "$css_bytes" -lt 800 ]; then
    echo "Theme stylesheet too small ($css_bytes bytes): $theme_dir/assets/css/theme.css" >&2
    exit 1
  fi

  if ! grep -R -q "assets/css/theme.css" "$theme_dir"; then
    echo "Theme does not reference assets/css/theme.css: $theme_dir" >&2
    exit 1
  fi

  if ! grep -R -q "wp_enqueue_style" "$theme_dir"; then
    echo "Theme does not call wp_enqueue_style: $theme_dir" >&2
    exit 1
  fi

  while IFS= read -r -d '' php_file; do
    php -l "$php_file" >/dev/null
  done < <(find "$theme_dir" -name "*.php" -type f -print0)

  for f in \
    "$preview_dir/index.html" \
    "$preview_dir/assets/css/preview.css" \
    "$preview_dir/assets/js/preview.js"
  do
    if [ ! -f "$f" ]; then
      echo "Missing preview file: $f" >&2
      exit 1
    fi
  done

  if ! grep -q "assets/css/preview.css" "$preview_dir/index.html"; then
    echo "Preview HTML does not link preview.css: $preview_dir/index.html" >&2
    exit 1
  fi

  preview_css_bytes="$(wc -c < "$preview_dir/assets/css/preview.css" | tr -d ' ')"
  if [ "$preview_css_bytes" -lt 800 ]; then
    echo "Preview stylesheet too small ($preview_css_bytes bytes): $preview_dir/assets/css/preview.css" >&2
    exit 1
  fi
done

zip_dir="$ROOT_DIR/zippedTheme"
mkdir -p "$zip_dir"
rm -f "$zip_dir"/*.zip

zip_has_member() {
  local zip_path="$1"
  local member="$2"
  unzip -Z1 "$zip_path" | awk -v target="$member" '$0 == target { found = 1 } END { exit(found ? 0 : 1) }'
}

echo "Packaging zips into $zip_dir/"
(
  cd "$THEMES_DIR"
  for theme_slug in "${themes[@]}"; do
    zip -qr "$zip_dir/$theme_slug.zip" "$theme_slug"
  done
)

for theme_slug in "${themes[@]}"; do
  zip_path="$zip_dir/$theme_slug.zip"
  zip_has_member "$zip_path" "${theme_slug}/style.css" || { echo "Zip missing style.css: $zip_path" >&2; exit 1; }
  zip_has_member "$zip_path" "${theme_slug}/functions.php" || { echo "Zip missing functions.php: $zip_path" >&2; exit 1; }
  zip_has_member "$zip_path" "${theme_slug}/assets/css/theme.css" || { echo "Zip missing theme.css: $zip_path" >&2; exit 1; }
  zip_has_member "$zip_path" "${theme_slug}/assets/js/theme.js" || { echo "Zip missing theme.js: $zip_path" >&2; exit 1; }
done

echo "OK"
