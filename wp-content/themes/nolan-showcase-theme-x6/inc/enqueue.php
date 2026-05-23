<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Nolan_Showcase_Theme_X6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme assets.
 *
 * @return void
 */
function nolan_showcase_x6_enqueue_assets() {
	$css_rel_path = 'assets/dist/css/theme.min.css';
	$js_rel_path  = 'assets/dist/js/theme.min.js';

	$css_path = get_template_directory() . '/' . $css_rel_path;
	$js_path  = get_template_directory() . '/' . $js_rel_path;

	$css_ver = file_exists( $css_path ) ? (string) filemtime( $css_path ) : NOLAN_SHOWCASE_X6_VERSION;
	$js_ver  = file_exists( $js_path ) ? (string) filemtime( $js_path ) : NOLAN_SHOWCASE_X6_VERSION;

	wp_enqueue_style(
		'nolan-showcase-x6-theme',
		get_template_directory_uri() . '/' . $css_rel_path,
		array(),
		$css_ver
	);

	wp_enqueue_script(
		'nolan-showcase-x6-theme',
		get_template_directory_uri() . '/' . $js_rel_path,
		array(),
		$js_ver,
		array(
			'in_footer' => true,
		)
	);

	wp_localize_script(
		'nolan-showcase-x6-theme',
		'nolanShowcaseX6',
		array(
			'homeUrl' => esc_url_raw( home_url( '/' ) ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'nolan_showcase_x6_enqueue_assets' );

