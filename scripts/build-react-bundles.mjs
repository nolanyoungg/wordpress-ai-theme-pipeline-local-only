import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";
import { build } from "esbuild";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const ROOT_DIR = path.resolve(__dirname, "..");

const THEMES_DIR = path.join(ROOT_DIR, "wp-content", "themes");
const DOCS_THEMES_DIR = path.join(ROOT_DIR, "docs", "themes");

const THEME_RE = /^nolan-showcase-theme-x(\d+)$/;
const exts = [".tsx", ".jsx", ".ts", ".js"];

function listThemeSlugs() {
  if (!fs.existsSync(THEMES_DIR)) return [];
  return fs
    .readdirSync(THEMES_DIR, { withFileTypes: true })
    .filter((d) => d.isDirectory() && THEME_RE.test(d.name))
    .map((d) => d.name)
    .sort((a, b) => {
      const am = a.match(THEME_RE);
      const bm = b.match(THEME_RE);
      return Number(am?.[1] ?? 0) - Number(bm?.[1] ?? 0);
    });
}

function findEntry(dir, basename) {
  for (const ext of exts) {
    const candidate = path.join(dir, `${basename}${ext}`);
    if (fs.existsSync(candidate)) return candidate;
  }
  return null;
}

async function maybeBuild({ label, entryFile, outFile }) {
  if (!entryFile) return false;

  console.log(`==> Bundling ${label}`);
  console.log(`    entry: ${path.relative(ROOT_DIR, entryFile)}`);
  console.log(`    out:   ${path.relative(ROOT_DIR, outFile)}`);

  await build({
    entryPoints: [entryFile],
    bundle: true,
    outfile: outFile,
    format: "iife",
    platform: "browser",
    target: ["es2018"],
    jsx: "automatic",
    define: {
      "process.env.NODE_ENV": "\"production\"",
    },
    minify: true,
    sourcemap: false,
    logLevel: "info",
  });

  return true;
}

async function main() {
  const themeSlugs = listThemeSlugs();
  if (themeSlugs.length === 0) {
    console.log("No themes found. Nothing to build.");
    return;
  }

  let builtCount = 0;

  for (const slug of themeSlugs) {
    const themeJsDir = path.join(THEMES_DIR, slug, "assets", "js");
    const themeOut = path.join(themeJsDir, "theme.js");
    const themeEntry = findEntry(themeJsDir, "theme.entry");
    builtCount += (await maybeBuild({ label: `${slug} theme.js`, entryFile: themeEntry, outFile: themeOut })) ? 1 : 0;

    const previewJsDir = path.join(DOCS_THEMES_DIR, slug, "assets", "js");
    const previewOut = path.join(previewJsDir, "preview.js");
    const previewEntry = findEntry(previewJsDir, "preview.entry");
    builtCount += (await maybeBuild({ label: `${slug} preview.js`, entryFile: previewEntry, outFile: previewOut })) ? 1 : 0;
  }

  if (builtCount === 0) {
    console.log("No React entrypoints found (theme.entry.* / preview.entry.*). Nothing to build.");
  } else {
    console.log(`Built ${builtCount} bundle(s).`);
  }
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});

