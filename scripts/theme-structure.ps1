function Get-RequiredThemeFiles {
param(
[Parameter(Mandatory = $true)]
[string]$ThemeSlug
)

return @(
"style.css",
"functions.php",
"theme.json",
"screenshot.png",
"README.md",
".editorconfig",
".gitignore",

"header.php",
"footer.php",
"front-page.php",
"index.php",
"page.php",
"single.php",
"archive.php",
"search.php",
"404.php",
"comments.php",

"inc/setup.php",
"inc/enqueue.php",
"inc/template-tags.php",
"inc/helpers.php",
"inc/custom-post-types.php",
"inc/customizer.php",

"assets/css/main.css",
"assets/js/bundle.js",
"assets/icons/README.md",

"src/js/main.js",
"src/scss/main.scss",
"src/scss/abstracts/_variables.scss",
"src/scss/abstracts/_mixins.scss",
"src/scss/abstracts/_functions.scss",
"src/scss/base/_reset.scss",
"src/scss/base/_typography.scss",
"src/scss/base/_accessibility.scss",
"src/scss/base/_forms.scss",
"src/scss/components/_buttons.scss",
"src/scss/components/_cards.scss",
"src/scss/components/_forms.scss",
"src/scss/components/_badges.scss",
"src/scss/components/_accordion.scss",
"src/scss/components/_carousel.scss",
"src/scss/components/_portfolio-filter.scss",
"src/scss/components/_before-after.scss",
"src/scss/layout/_container.scss",
"src/scss/layout/_header.scss",
"src/scss/layout/_footer.scss",
"src/scss/layout/_grid.scss",
"src/scss/layout/_sections.scss",
"src/scss/pages/_home.scss",
"src/scss/pages/_contact.scss",
"src/scss/pages/_services.scss",
"src/scss/pages/_work.scss",
"src/scss/pages/_resources.scss",
"src/scss/pages/_who-we-are.scss",

"template-parts/content-hero.php",
"template-parts/content-brand-statement.php",
"template-parts/content-featured-work.php",
"template-parts/content-services.php",
"template-parts/content-process.php",
"template-parts/content-style-pillars.php",
"template-parts/content-testimonials.php",
"template-parts/content-resources-preview.php",
"template-parts/content-final-cta.php",
"template-parts/content-footer-widgets.php",
"template-parts/content-none.php",
"template-parts/content-page.php",
"template-parts/content-single.php",

"page-templates/template-who-we-are.php",
"page-templates/template-what-we-do.php",
"page-templates/template-our-work.php",
"page-templates/template-resources.php",
"page-templates/template-contact.php",

"blocks/README.md",

"build/webpack.config.js",

"package.json",
"package-lock.json"
)
}

function Get-RequiredThemeDirectories {
return @(
"inc",
"assets",
"assets/css",
"assets/js",
"assets/icons",
"assets/images",
"assets/images/hero",
"assets/images/portfolio",
"assets/images/texture",
"src",
"src/js",
"src/scss",
"src/scss/abstracts",
"src/scss/base",
"src/scss/components",
"src/scss/layout",
"src/scss/pages",
"template-parts",
"page-templates",
"blocks",
"build"
)
}

function Ensure-Directory {
param(
[Parameter(Mandatory = $true)]
[string]$Path
)

if (-not (Test-Path -LiteralPath $Path)) {
New-Item -ItemType Directory -Force -Path $Path | Out-Null
}
}

function Set-FileIfMissing {
param(
[Parameter(Mandatory = $true)]
[string]$Path,

[Parameter(Mandatory = $true)]
[AllowEmptyString()]
[string]$Content
)

if (-not (Test-Path -LiteralPath $Path)) {
$parent = Split-Path -Parent $Path
if ($parent) {
Ensure-Directory -Path $parent
}

Set-Content -LiteralPath $Path -Value $Content -Encoding UTF8
}
}

function Set-BinaryFileIfMissing {
param(
[Parameter(Mandatory = $true)]
[string]$Path,

[Parameter(Mandatory = $true)]
[string]$Base64
)

if (-not (Test-Path -LiteralPath $Path)) {
$parent = Split-Path -Parent $Path
if ($parent) {
Ensure-Directory -Path $parent
}

[System.IO.File]::WriteAllBytes($Path, [Convert]::FromBase64String($Base64))
}
}

function Get-MinimalPhpTemplate {
param(
[Parameter(Mandatory = $true)]
[string]$Label
)

return @"
<?php
/**
 * $Label
 *
 * @package Nolan_Young_Showcase
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}
?>
<main class="site-main">
<section class="section">
<div class="container">
<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
<p><?php esc_html_e( 'This template is ready for theme-specific content.', 'nolan-young-showcase' ); ?></p>
</div>
</section>
</main>
"@
}

function Ensure-ThemeStructure {
param(
[Parameter(Mandatory = $true)]
[string]$Root,

[Parameter(Mandatory = $true)]
[string]$ThemeDir,

[Parameter(Mandatory = $true)]
[string]$ThemeSlug,

[Parameter(Mandatory = $true)]
[string]$ThemeDisplayName,

[Parameter(Mandatory = $true)]
[string]$PreviewDir,

[Parameter(Mandatory = $true)]
[string]$ThemeZip
)

$themePath = Join-Path $Root $ThemeDir

Ensure-Directory -Path $themePath

Set-FileIfMissing -Path (Join-Path $themePath "style.css") -Content @"
/*
Theme Name: $ThemeDisplayName
Theme URI: https://example.com/
Author: Nolan Young
Author URI: https://example.com/
Description: A generated local-only classic WordPress theme produced by the Nolan Young showcase theme pipeline.
Version: 1.0.0
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: nolan-young-showcase
Tags: custom-theme, portfolio, responsive, classic-theme
*/
"@


foreach ($dir in Get-RequiredThemeDirectories) {
Ensure-Directory -Path (Join-Path $themePath $dir)
}

foreach ($assetDir in @("assets/images/hero", "assets/images/portfolio", "assets/images/texture")) {
Set-FileIfMissing -Path (Join-Path $themePath (Join-Path $assetDir ".gitkeep")) -Content ""
}

Set-FileIfMissing -Path (Join-Path $themePath ".editorconfig") -Content @"
root = true

[*]
charset = utf-8
end_of_line = lf
insert_final_newline = true
indent_style = tab
indent_size = 4

[*.{json,js,scss,css,md}]
indent_style = space
indent_size = 2
"@

Set-FileIfMissing -Path (Join-Path $themePath ".gitignore") -Content @"
node_modules/
dist/
.cache/
.DS_Store
*.log
"@

Set-FileIfMissing -Path (Join-Path $themePath "theme.json") -Content @"
{
  "`$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "appearanceTools": true,
    "layout": {
      "contentSize": "760px",
      "wideSize": "1180px"
    }
  }
}
"@

Set-FileIfMissing -Path (Join-Path $themePath "README.md") -Content @"
# $ThemeDisplayName

Generated by the local-only Ollama WordPress theme pipeline.

## Theme Slug

$ThemeSlug

## Required Structure

This theme includes the standard Nolan Young showcase theme structure: classic WordPress templates, `inc/` files, source SCSS/JS, compiled assets, page templates, template parts, build files, and a static GitHub Pages preview.

## Generated Paths

- WordPress theme: `$ThemeDir`
- Static preview: `$PreviewDir`
- ZIP package: `$ThemeZip`
"@

Set-FileIfMissing -Path (Join-Path $themePath "assets/icons/README.md") -Content "# Icons`r`n`r`nPlace local SVG icons in this directory."
Set-FileIfMissing -Path (Join-Path $themePath "blocks/README.md") -Content "# Blocks`r`n`r`nOptional custom block documentation lives here."

Set-FileIfMissing -Path (Join-Path $themePath "assets/css/main.css") -Content @"
:root {
  --theme-bg: #ffffff;
  --theme-text: #111827;
  --theme-accent: #2563eb;
}

body {
  margin: 0;
  color: var(--theme-text);
  background: var(--theme-bg);
}

.container {
  width: min(1120px, calc(100% - 32px));
  margin-inline: auto;
}

.section {
  padding-block: clamp(48px, 8vw, 96px);
}
"@

Set-FileIfMissing -Path (Join-Path $themePath "assets/js/bundle.js") -Content @"
(function () {
  'use strict';

  document.documentElement.classList.add('js-enabled');
})();
"@

Set-FileIfMissing -Path (Join-Path $themePath "src/js/main.js") -Content @"
import '../scss/main.scss';

document.documentElement.classList.add('theme-source-loaded');
"@

Set-FileIfMissing -Path (Join-Path $themePath "src/scss/main.scss") -Content @"
@use 'abstracts/variables';
@use 'abstracts/mixins';
@use 'abstracts/functions';
@use 'base/reset';
@use 'base/typography';
@use 'base/accessibility';
@use 'base/forms';
@use 'components/buttons';
@use 'components/cards';
@use 'components/forms';
@use 'components/badges';
@use 'components/accordion';
@use 'components/carousel';
@use 'components/portfolio-filter';
@use 'components/before-after';
@use 'layout/container';
@use 'layout/header';
@use 'layout/footer';
@use 'layout/grid';
@use 'layout/sections';
@use 'pages/home';
@use 'pages/contact';
@use 'pages/services';
@use 'pages/work';
@use 'pages/resources';
@use 'pages/who-we-are';
"@

foreach ($scss in @(
"src/scss/abstracts/_variables.scss",
"src/scss/abstracts/_mixins.scss",
"src/scss/abstracts/_functions.scss",
"src/scss/base/_reset.scss",
"src/scss/base/_typography.scss",
"src/scss/base/_accessibility.scss",
"src/scss/base/_forms.scss",
"src/scss/components/_buttons.scss",
"src/scss/components/_cards.scss",
"src/scss/components/_forms.scss",
"src/scss/components/_badges.scss",
"src/scss/components/_accordion.scss",
"src/scss/components/_carousel.scss",
"src/scss/components/_portfolio-filter.scss",
"src/scss/components/_before-after.scss",
"src/scss/layout/_container.scss",
"src/scss/layout/_header.scss",
"src/scss/layout/_footer.scss",
"src/scss/layout/_grid.scss",
"src/scss/layout/_sections.scss",
"src/scss/pages/_home.scss",
"src/scss/pages/_contact.scss",
"src/scss/pages/_services.scss",
"src/scss/pages/_work.scss",
"src/scss/pages/_resources.scss",
"src/scss/pages/_who-we-are.scss"
)) {
Set-FileIfMissing -Path (Join-Path $themePath $scss) -Content "/* $scss */"
}

Set-FileIfMissing -Path (Join-Path $themePath "inc/setup.php") -Content @"
<?php
/**
 * Theme setup.
 *
 * @package Nolan_Young_Showcase
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function nolan_young_showcase_setup() {
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

register_nav_menus(
array(
'primary' => esc_html__( 'Primary Menu', 'nolan-young-showcase' ),
'footer'  => esc_html__( 'Footer Menu', 'nolan-young-showcase' ),
)
);
}
add_action( 'after_setup_theme', 'nolan_young_showcase_setup' );
"@

Set-FileIfMissing -Path (Join-Path $themePath "inc/enqueue.php") -Content @"
<?php
/**
 * Asset loading.
 *
 * @package Nolan_Young_Showcase
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

function nolan_young_showcase_enqueue_assets() {
wp_enqueue_style(
'nolan-young-showcase-main',
get_template_directory_uri() . '/assets/css/main.css',
array(),
wp_get_theme()->get( 'Version' )
);

wp_enqueue_script(
'nolan-young-showcase-bundle',
get_template_directory_uri() . '/assets/js/bundle.js',
array(),
wp_get_theme()->get( 'Version' ),
true
);
}
add_action( 'wp_enqueue_scripts', 'nolan_young_showcase_enqueue_assets' );
"@

Set-FileIfMissing -Path (Join-Path $themePath "inc/template-tags.php") -Content "<?php`r`nif ( ! defined( 'ABSPATH' ) ) { exit; }`r`n"
Set-FileIfMissing -Path (Join-Path $themePath "inc/helpers.php") -Content "<?php`r`nif ( ! defined( 'ABSPATH' ) ) { exit; }`r`n"
Set-FileIfMissing -Path (Join-Path $themePath "inc/custom-post-types.php") -Content "<?php`r`nif ( ! defined( 'ABSPATH' ) ) { exit; }`r`n"
Set-FileIfMissing -Path (Join-Path $themePath "inc/customizer.php") -Content "<?php`r`nif ( ! defined( 'ABSPATH' ) ) { exit; }`r`n"

$functionsPath = Join-Path $themePath "functions.php"
if (Test-Path -LiteralPath $functionsPath) {
$functions = Get-Content -LiteralPath $functionsPath -Raw
} else {
$functions = "<?php`r`n"
}

$requiredIncludes = @(
"inc/setup.php",
"inc/enqueue.php",
"inc/template-tags.php",
"inc/helpers.php",
"inc/custom-post-types.php",
"inc/customizer.php"
)

foreach ($include in $requiredIncludes) {
if ($functions -notmatch [regex]::Escape($include)) {
$functions += "`r`nrequire_once get_template_directory() . '/$include';"
}
}

Set-Content -LiteralPath $functionsPath -Value $functions -Encoding UTF8

foreach ($template in @(
"header.php",
"footer.php",
"front-page.php",
"index.php",
"page.php",
"single.php",
"archive.php",
"search.php",
"404.php",
"comments.php"
)) {
Set-FileIfMissing -Path (Join-Path $themePath $template) -Content (Get-MinimalPhpTemplate -Label $template)
}

foreach ($part in @(
"content-hero.php",
"content-brand-statement.php",
"content-featured-work.php",
"content-services.php",
"content-process.php",
"content-style-pillars.php",
"content-testimonials.php",
"content-resources-preview.php",
"content-final-cta.php",
"content-footer-widgets.php",
"content-none.php",
"content-page.php",
"content-single.php"
)) {
Set-FileIfMissing -Path (Join-Path $themePath (Join-Path "template-parts" $part)) -Content (Get-MinimalPhpTemplate -Label $part)
}

foreach ($pageTemplate in @(
"template-who-we-are.php",
"template-what-we-do.php",
"template-our-work.php",
"template-resources.php",
"template-contact.php"
)) {
$templateName = ($pageTemplate -replace '^template-', '' -replace '\.php$', '' -replace '-', ' ')
$templateTitle = (Get-Culture).TextInfo.ToTitleCase($templateName)

$content = @"
<?php
/**
 * Template Name: $templateTitle
 *
 * @package Nolan_Young_Showcase
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

get_header();
?>
<main class="site-main">
<section class="section">
<div class="container">
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>
</div>
</section>
</main>
<?php
get_footer();
"@

Set-FileIfMissing -Path (Join-Path $themePath (Join-Path "page-templates" $pageTemplate)) -Content $content
}

Set-FileIfMissing -Path (Join-Path $themePath "build/webpack.config.js") -Content @"
const path = require('path');

module.exports = {
  mode: 'production',
  entry: './src/js/main.js',
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, '../assets/js')
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ['style-loader', 'css-loader', 'sass-loader']
      }
    ]
  }
};
"@

Set-FileIfMissing -Path (Join-Path $themePath "package.json") -Content @"
{
  "name": "$ThemeSlug",
  "version": "1.0.0",
  "private": true,
  "scripts": {
    "build": "webpack --config build/webpack.config.js"
  },
  "devDependencies": {
    "css-loader": "^7.1.2",
    "sass": "^1.77.8",
    "sass-loader": "^14.2.1",
    "style-loader": "^4.0.0",
    "webpack": "^5.93.0",
    "webpack-cli": "^5.1.4"
  }
}
"@

Set-FileIfMissing -Path (Join-Path $themePath "package-lock.json") -Content @"
{
  "name": "$ThemeSlug",
  "version": "1.0.0",
  "lockfileVersion": 3,
  "requires": true,
  "packages": {
    "": {
      "name": "$ThemeSlug",
      "version": "1.0.0",
      "devDependencies": {}
    }
  }
}
"@

# Valid 1x1 PNG placeholder.
Set-BinaryFileIfMissing -Path (Join-Path $themePath "screenshot.png") -Base64 "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII="

# Final runtime asset guarantees.
# These files must exist in the installable theme even before Webpack is run.
Set-FileIfMissing -Path (Join-Path $themePath "assets/css/main.css") -Content @"
:root {
  --theme-bg: #ffffff;
  --theme-text: #111827;
  --theme-accent: #2563eb;
}

body {
  margin: 0;
  color: var(--theme-text);
  background: var(--theme-bg);
}

.container {
  width: min(1120px, calc(100% - 32px));
  margin-inline: auto;
}

.section {
  padding-block: clamp(48px, 8vw, 96px);
}
"@

Set-FileIfMissing -Path (Join-Path $themePath "assets/js/bundle.js") -Content @"
(function () {
  'use strict';

  document.documentElement.classList.add('js-enabled');
})();
"@

# Final required-file backfill.
# This guarantees the standard theme structure exists even if Ollama skips files.
foreach ($requiredFile in Get-RequiredThemeFiles -ThemeSlug $ThemeSlug) {
$requiredPath = Join-Path $themePath $requiredFile

if (Test-Path -LiteralPath $requiredPath) {
continue
}

$requiredParent = Split-Path -Parent $requiredPath
if ($requiredParent) {
Ensure-Directory -Path $requiredParent
}

switch -Regex ($requiredFile) {
'^screenshot\.png$' {
Set-BinaryFileIfMissing -Path $requiredPath -Base64 "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII="
continue
}

'\.php$' {
Set-FileIfMissing -Path $requiredPath -Content (Get-MinimalPhpTemplate -Label $requiredFile)
continue
}

'\.scss$' {
Set-FileIfMissing -Path $requiredPath -Content "/* $requiredFile */"
continue
}

'\.css$' {
Set-FileIfMissing -Path $requiredPath -Content @"
:root {
  --theme-bg: #ffffff;
  --theme-text: #111827;
  --theme-accent: #2563eb;
}

body {
  margin: 0;
  color: var(--theme-text);
  background: var(--theme-bg);
}
"@
continue
}

'\.js$' {
Set-FileIfMissing -Path $requiredPath -Content @"
(function () {
  'use strict';

  document.documentElement.classList.add('js-enabled');
})();
"@
continue
}

'\.json$' {
Set-FileIfMissing -Path $requiredPath -Content "{}"
continue
}

'\.md$' {
Set-FileIfMissing -Path $requiredPath -Content "# $requiredFile`r`n`r`nGenerated placeholder file for the standard theme structure."
continue
}

default {
Set-FileIfMissing -Path $requiredPath -Content ""
}
}
}
}






function Ensure-PreviewStructure {
param(
[Parameter(Mandatory = $true)]
[string]$Root,

[Parameter(Mandatory = $true)]
[string]$PreviewDir,

[Parameter(Mandatory = $true)]
[string]$ThemeSlug,

[Parameter(Mandatory = $true)]
[string]$ThemeDisplayName
)

$previewPath = Join-Path $Root $PreviewDir

Ensure-Directory -Path $previewPath
Ensure-Directory -Path (Join-Path $previewPath "assets")
Ensure-Directory -Path (Join-Path $previewPath "assets/css")
Ensure-Directory -Path (Join-Path $previewPath "assets/js")

Set-FileIfMissing -Path (Join-Path $previewPath "index.html") -Content @"
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>$ThemeDisplayName</title>
<link rel="stylesheet" href="assets/css/preview.css">
</head>
<body>
<header class="preview-hero">
<div class="preview-container">
<p class="preview-eyebrow">Local-only generated WordPress theme</p>
<h1>$ThemeDisplayName</h1>
<p>A static GitHub Pages preview for $ThemeSlug.</p>
</div>
</header>

<main>
<section class="preview-section">
<div class="preview-container">
<h2>Theme Preview</h2>
<p>This preview confirms the generated theme has a working static presentation page.</p>
</div>
</section>
</main>

<script src="assets/js/preview.js"></script>
</body>
</html>
"@

Set-FileIfMissing -Path (Join-Path $previewPath "assets/css/preview.css") -Content @"
:root {
  --preview-bg: #0f172a;
  --preview-surface: #111827;
  --preview-text: #f8fafc;
  --preview-muted: #cbd5e1;
  --preview-accent: #60a5fa;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
  color: var(--preview-text);
  background: var(--preview-bg);
}

.preview-container {
  width: min(1120px, calc(100% - 32px));
  margin-inline: auto;
}

.preview-hero {
  padding: clamp(72px, 12vw, 140px) 0;
  background: linear-gradient(135deg, var(--preview-surface), var(--preview-bg));
}

.preview-eyebrow {
  color: var(--preview-accent);
  text-transform: uppercase;
  letter-spacing: 0.12em;
}

.preview-section {
  padding: clamp(48px, 8vw, 96px) 0;
}
"@

Set-FileIfMissing -Path (Join-Path $previewPath "assets/js/preview.js") -Content @"
(function () {
  'use strict';

  document.documentElement.classList.add('preview-js-enabled');
})();
"@
}

