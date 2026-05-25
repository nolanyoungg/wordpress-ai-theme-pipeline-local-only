#!/usr/bin/env bash
set -euo pipefail

echo "Deprecated in this local-only repo: this repository no longer uses Codex/OpenAI."
echo "Use PowerShell + Ollama instead:"
echo "  powershell -ExecutionPolicy Bypass -File scripts/run-local-ollama-workflow.ps1 \"<task>\""
exit 1

if [ "$#" -lt 1 ]; then
  echo "Usage: $0 <task>"
  exit 1
fi

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
TASK="$*"
export TASK
WORKFLOW_MODE="${CODEX_WORKFLOW_MODE:-planner}"
export WORKFLOW_MODE

mkdir -p "$ROOT_DIR/.ai"

CODEX_ARGS=()
if [ -n "${CODEX_RUN_MODEL:-}" ]; then
  CODEX_ARGS+=(-m "$CODEX_RUN_MODEL")
fi
if [ -n "${CODEX_RUN_REASONING_EFFORT:-}" ]; then
  CODEX_ARGS+=(-c "model_reasoning_effort=\"${CODEX_RUN_REASONING_EFFORT}\"")
fi

BASE_THEME_SLUG="nolan-young-showcase-theme"
THEME_VERSION=1
while IFS= read -r THEME_BASE; do
  if [[ "$THEME_BASE" =~ ^${BASE_THEME_SLUG}-x([0-9]+)$ ]]; then
    CURRENT_VERSION="${BASH_REMATCH[1]}"
    if [ "$CURRENT_VERSION" -ge "$THEME_VERSION" ]; then
      THEME_VERSION=$((CURRENT_VERSION + 1))
    fi
  fi
done < <(find "$ROOT_DIR/wp-content/themes" -maxdepth 1 -type d -name "${BASE_THEME_SLUG}-x*" -print0 | xargs -0 -n 1 basename)

THEME_SLUG="${BASE_THEME_SLUG}-x${THEME_VERSION}"
THEME_DISPLAY_NAME="Nolan Showcase Theme X${THEME_VERSION}"

THEME_DIR="wp-content/themes/${THEME_SLUG}"
THEME_ZIP="zippedTheme/${THEME_SLUG}.zip"
export THEME_SLUG THEME_DISPLAY_NAME THEME_DIR THEME_ZIP THEME_VERSION

CURRENT_BRANCH="$(git -C "$ROOT_DIR" branch --show-current)"
if [ "$CURRENT_BRANCH" = "main" ]; then
  FEATURE_BRANCH="ai/$(date +%Y%m%d-%H%M%S)-nolan-young-showcase-theme"
  git -C "$ROOT_DIR" checkout -b "$FEATURE_BRANCH"
  echo "Switched to feature branch: $FEATURE_BRANCH"
fi

case "$WORKFLOW_MODE" in
  planner)
    perl -0pe '
      s/\{\{TASK\}\}/$ENV{TASK}/g;
      s/\{\{THEME_DIR\}\}/$ENV{THEME_DIR}/g;
      s/\{\{THEME_ZIP\}\}/$ENV{THEME_ZIP}/g;
      s/\{\{THEME_DISPLAY_NAME\}\}/$ENV{THEME_DISPLAY_NAME}/g;
      s/\{\{THEME_SLUG\}\}/$ENV{THEME_SLUG}/g;
    ' "$ROOT_DIR/.github/codex/prompts/planner.md" > "$ROOT_DIR/.ai/planner-run.md"
    codex exec --cd "$ROOT_DIR" "${CODEX_ARGS[@]}" --output-last-message .ai/builder-prompt.md < "$ROOT_DIR/.ai/planner-run.md"
    ;;
  passthrough)
    cat > "$ROOT_DIR/.ai/builder-prompt.md" <<EOF
You are the BUILDER AGENT.

Implement the user's request directly and preserve the original intent as closely as possible. Do not run the planner step.

Repository instructions:
- Read AGENTS.md.
- The target theme directory is $THEME_DIR.
- The theme should also be zipped to $THEME_ZIP.
- The display name for this build is $THEME_DISPLAY_NAME.
- Also create a matching static GitHub Pages preview in \`docs/themes/$THEME_SLUG/\` and update \`docs/index.html\`.
- The result should be suitable for a WordPress theme pull request.
- Do not edit unrelated files.
- Do not add API keys, SSH, SFTP, production secrets, or deployment credentials.

Original user task:
$TASK

Implement the task directly with the smallest necessary amount of interpretation.
EOF
    ;;
  raw)
    printf '%s\n' "$TASK" > "$ROOT_DIR/.ai/builder-prompt.md"
    ;;
  *)
    echo "Unknown CODEX_WORKFLOW_MODE: $WORKFLOW_MODE (expected planner, passthrough, or raw)" >&2
    exit 1
    ;;
esac

codex exec --cd "$ROOT_DIR" "${CODEX_ARGS[@]}" --sandbox workspace-write --output-last-message .ai/implementation-summary.md < "$ROOT_DIR/.ai/builder-prompt.md"

THEME_FS_DIR="$ROOT_DIR/$THEME_DIR"
THEME_FS_ZIP="$ROOT_DIR/$THEME_ZIP"
if [ -d "$THEME_FS_DIR" ]; then
  # Optional: if the generated theme/preview includes React entrypoints, build bundles before packaging.
  if [ -f "$ROOT_DIR/package.json" ]; then
    if find "$THEME_FS_DIR/assets/js" -maxdepth 1 -type f -name "theme.entry.*" -print -quit 2>/dev/null | grep -q .; then
      (cd "$ROOT_DIR" && npm run build:react-bundles)
    fi
    if find "$ROOT_DIR/docs/themes/$THEME_SLUG/assets/js" -maxdepth 1 -type f -name "preview.entry.*" -print -quit 2>/dev/null | grep -q .; then
      (cd "$ROOT_DIR" && npm run build:react-bundles)
    fi
  fi

  rm -f "$THEME_FS_ZIP"
  mkdir -p "$ROOT_DIR/zippedTheme"
  (
    cd "$ROOT_DIR/wp-content/themes"
    zip -qr "$ROOT_DIR/zippedTheme/$THEME_SLUG.zip" "$THEME_SLUG"
  )
fi

perl -0pe '
  s/\{\{TASK\}\}/$ENV{TASK}/g;
  s/\{\{THEME_DIR\}\}/$ENV{THEME_DIR}/g;
  s/\{\{THEME_ZIP\}\}/$ENV{THEME_ZIP}/g;
  s/\{\{THEME_DISPLAY_NAME\}\}/$ENV{THEME_DISPLAY_NAME}/g;
  s/\{\{THEME_SLUG\}\}/$ENV{THEME_SLUG}/g;
' "$ROOT_DIR/.github/codex/prompts/reviewer.md" > "$ROOT_DIR/.ai/reviewer-run.md"
codex exec --cd "$ROOT_DIR" "${CODEX_ARGS[@]}" --sandbox read-only --output-last-message .ai/reviewer-report.md < "$ROOT_DIR/.ai/reviewer-run.md"

printf '%s\n' "Local Codex workflow complete."
printf '%s\n' "Next: run scripts/validate-themes.sh, then review and commit changes manually."
