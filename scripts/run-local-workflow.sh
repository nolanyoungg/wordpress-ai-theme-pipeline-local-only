#!/usr/bin/env bash
set -euo pipefail

if [ "$#" -lt 1 ]; then
  echo "Usage: $0 <task>"
  exit 1
fi

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
TASK="$*"
export TASK

mkdir -p "$ROOT_DIR/.ai"

BASE_THEME_SLUG="nolan-showcase-theme"
THEME_VERSION=1
while IFS= read -r THEME_PATH; do
  [ -n "$THEME_PATH" ] || continue
  THEME_BASE="$(basename "$THEME_PATH")"
  if [ "$THEME_BASE" = "$BASE_THEME_SLUG" ]; then
    CURRENT_VERSION=1
  elif [[ "$THEME_BASE" =~ ^${BASE_THEME_SLUG}-x([0-9]+)$ ]]; then
    CURRENT_VERSION="${BASH_REMATCH[1]}"
  else
    continue
  fi

  if [ "$CURRENT_VERSION" -ge "$THEME_VERSION" ]; then
    THEME_VERSION=$((CURRENT_VERSION + 1))
  fi
done < <(find "$ROOT_DIR/wp-content/themes" -maxdepth 1 -type d -name "${BASE_THEME_SLUG}*")

if [ "$THEME_VERSION" -eq 1 ]; then
  THEME_SLUG="$BASE_THEME_SLUG"
  THEME_DISPLAY_NAME="Nolan Showcase Theme"
else
  THEME_SLUG="${BASE_THEME_SLUG}-x${THEME_VERSION}"
  THEME_DISPLAY_NAME="Nolan Showcase Theme X${THEME_VERSION}"
fi

THEME_DIR="wp-content/themes/${THEME_SLUG}"
THEME_ZIP="wp-content/themes/${THEME_SLUG}.zip"
export THEME_SLUG THEME_DISPLAY_NAME THEME_DIR THEME_ZIP THEME_VERSION

CURRENT_BRANCH="$(git -C "$ROOT_DIR" branch --show-current)"
if [ "$CURRENT_BRANCH" = "main" ]; then
  FEATURE_BRANCH="ai/$(date +%Y%m%d-%H%M%S)-nolan-showcase-theme"
  git -C "$ROOT_DIR" checkout -b "$FEATURE_BRANCH"
  echo "Switched to feature branch: $FEATURE_BRANCH"
fi

perl -0pe '
  s/\{\{TASK\}\}/$ENV{TASK}/g;
  s/\{\{THEME_DIR\}\}/$ENV{THEME_DIR}/g;
  s/\{\{THEME_ZIP\}\}/$ENV{THEME_ZIP}/g;
  s/\{\{THEME_DISPLAY_NAME\}\}/$ENV{THEME_DISPLAY_NAME}/g;
' "$ROOT_DIR/.github/codex/prompts/planner.md" > "$ROOT_DIR/.ai/planner-run.md"
codex exec --cd "$ROOT_DIR" --output-last-message .ai/builder-prompt.md < "$ROOT_DIR/.ai/planner-run.md"

codex exec --cd "$ROOT_DIR" --sandbox workspace-write --output-last-message .ai/implementation-summary.md < "$ROOT_DIR/.ai/builder-prompt.md"

perl -0pe '
  s/\{\{TASK\}\}/$ENV{TASK}/g;
  s/\{\{THEME_DIR\}\}/$ENV{THEME_DIR}/g;
  s/\{\{THEME_ZIP\}\}/$ENV{THEME_ZIP}/g;
  s/\{\{THEME_DISPLAY_NAME\}\}/$ENV{THEME_DISPLAY_NAME}/g;
' "$ROOT_DIR/.github/codex/prompts/reviewer.md" > "$ROOT_DIR/.ai/reviewer-run.md"
codex exec --cd "$ROOT_DIR" --sandbox read-only --output-last-message .ai/reviewer-report.md < "$ROOT_DIR/.ai/reviewer-run.md"

THEME_FS_DIR="$ROOT_DIR/$THEME_DIR"
THEME_FS_ZIP="$ROOT_DIR/$THEME_ZIP"
if [ -d "$THEME_FS_DIR" ]; then
  rm -f "$THEME_FS_ZIP"
  (
    cd "$ROOT_DIR/wp-content/themes"
    zip -qr "$THEME_SLUG.zip" "$THEME_SLUG"
  )
fi

if [ -n "$(git -C "$ROOT_DIR" status --porcelain)" ]; then
  git -C "$ROOT_DIR" add -A
  git -C "$ROOT_DIR" commit -m "Build ${THEME_DISPLAY_NAME}"
  git -C "$ROOT_DIR" push -u origin "$(git -C "$ROOT_DIR" branch --show-current)"
fi

printf '%s\n' "Local Codex workflow complete."
