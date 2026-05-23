<?php
/**
 * Theme functions.
 *
 * @package Nolan_Showcase_Theme_X2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOLAN_SHOWCASE_X2_VERSION', '1.0.0' );

function nolan_showcase_x2_setup() {
	load_theme_textdomain( 'nolan-showcase-theme-x2', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 260,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'nolan-showcase-theme-x2' ),
			'footer'  => esc_html__( 'Footer Menu', 'nolan-showcase-theme-x2' ),
		)
	);
}
add_action( 'after_setup_theme', 'nolan_showcase_x2_setup' );

function nolan_showcase_x2_enqueue_assets() {
	wp_enqueue_style(
		'nolan-showcase-theme-x2',
		get_template_directory_uri() . '/assets/css/theme.css',
		array(),
		NOLAN_SHOWCASE_X2_VERSION
	);

	wp_enqueue_script(
		'nolan-showcase-theme-x2',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		NOLAN_SHOWCASE_X2_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nolan_showcase_x2_enqueue_assets' );

function nolan_showcase_x2_menu_links() {
	return array(
		'capabilities' => __( 'Capabilities', 'nolan-showcase-theme-x2' ),
		'work'         => __( 'Work', 'nolan-showcase-theme-x2' ),
		'metrics'      => __( 'Metrics', 'nolan-showcase-theme-x2' ),
		'leadership'   => __( 'Leadership', 'nolan-showcase-theme-x2' ),
		'contact'      => __( 'Contact', 'nolan-showcase-theme-x2' ),
	);
}

function nolan_showcase_x2_fallback_menu() {
	echo '<ul id="primary-menu" class="nav-menu">';
	foreach ( nolan_showcase_x2_menu_links() as $target => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/#' . $target ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

function nolan_showcase_x2_footer_fallback_menu() {
	echo '<ul class="footer-menu">';
	foreach ( nolan_showcase_x2_menu_links() as $target => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/#' . $target ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}
