#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEMES_DIR="$ROOT_DIR/wp-content/themes"

if [ ! -d "$THEMES_DIR" ]; then
  echo "Missing themes directory: $THEMES_DIR" >&2
  exit 1
fi

find "$THEMES_DIR" -maxdepth 1 -type d -name 'nolan-young-showcase-theme-x*' -print0 \
  | while IFS= read -r -d '' theme_path; do
      theme_slug="$(basename "$theme_path")"
      version="${theme_slug##*-x}"
      if [[ "$version" =~ ^[0-9]+$ ]]; then
        printf '%06d %s\n' "$version" "$theme_slug"
      fi
    done \
  | sort -n \
  | awk '{print $2}'
