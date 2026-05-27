<?php
/**
 * Helper functions for Nolan Young Showcase Theme X01.
 *
 * @package Nolan_Young_Showcase_Theme_X01
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_get_asset_uri' ) ) {
/**
 * Return a theme asset URI.
 *
 * @param string $relative_path Asset path relative to the theme root.
 * @return string
 */
function nolan_young_showcase_theme_x01_get_asset_uri( $relative_path ) {
$relative_path = is_string( $relative_path ) ? ltrim( $relative_path, '/' ) : '';

if ( '' === $relative_path ) {
return trailingslashit( get_template_directory_uri() );
}

return trailingslashit( get_template_directory_uri() ) . $relative_path;
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_get_asset_path' ) ) {
/**
 * Return a theme asset filesystem path.
 *
 * @param string $relative_path Asset path relative to the theme root.
 * @return string
 */
function nolan_young_showcase_theme_x01_get_asset_path( $relative_path ) {
$relative_path = is_string( $relative_path ) ? ltrim( $relative_path, '/\\' ) : '';

if ( '' === $relative_path ) {
return trailingslashit( get_template_directory() );
}

return trailingslashit( get_template_directory() ) . $relative_path;
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_render_button' ) ) {
/**
 * Render a styled link button.
 *
 * @param string $label Button label.
 * @param string $url Button URL.
 * @param string $class Additional button class.
 * @return void
 */
function nolan_young_showcase_theme_x01_render_button( $label, $url, $class = 'btn btn-primary' ) {
$label = is_string( $label ) ? $label : '';
$url   = is_string( $url ) ? $url : '#';
$class = is_string( $class ) ? $class : 'btn btn-primary';

printf(
'<a class="%1$s" href="%2$s">%3$s</a>',
esc_attr( $class ),
esc_url( $url ),
esc_html( $label )
);
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_render_section_label' ) ) {
/**
 * Render a small section label.
 *
 * @param string $label Section label text.
 * @return void
 */
function nolan_young_showcase_theme_x01_render_section_label( $label ) {
$label = is_string( $label ) ? trim( $label ) : '';

if ( '' === $label ) {
return;
}

printf(
'<p class="section-label">%s</p>',
esc_html( $label )
);
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_get_placeholder_image' ) ) {
/**
 * Return a local placeholder image URI.
 *
 * @param string $type Placeholder type.
 * @return string
 */
function nolan_young_showcase_theme_x01_get_placeholder_image( $type = 'hero' ) {
$type = is_string( $type ) ? sanitize_key( $type ) : 'hero';

$map = array(
'hero'      => 'assets/images/hero/',
'portfolio' => 'assets/images/portfolio/',
'texture'   => 'assets/images/texture/',
);

if ( isset( $map[ $type ] ) ) {
return nolan_young_showcase_theme_x01_get_asset_uri( $map[ $type ] );
}

return nolan_young_showcase_theme_x01_get_asset_uri( 'assets/images/' );
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_format_phone' ) ) {
/**
 * Format a phone number for a tel link.
 *
 * @param string $phone Phone number.
 * @return string
 */
function nolan_young_showcase_theme_x01_format_phone( $phone ) {
$phone = is_string( $phone ) ? $phone : '';

return preg_replace( '/[^0-9+]/', '', $phone );
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_get_current_year' ) ) {
/**
 * Return the current year.
 *
 * @return string
 */
function nolan_young_showcase_theme_x01_get_current_year() {
return gmdate( 'Y' );
}
}

if ( ! function_exists( 'nolan_young_showcase_theme_x01_trim_words' ) ) {
/**
 * Trim text to a word count.
 *
 * @param string $text Text to trim.
 * @param int    $word_count Number of words.
 * @return string
 */
function nolan_young_showcase_theme_x01_trim_words( $text, $word_count = 24 ) {
$text       = is_string( $text ) ? wp_strip_all_tags( $text ) : '';
$word_count = max( 1, absint( $word_count ) );

return wp_trim_words( $text, $word_count, '&hellip;' );
}
}
