<?php
/**
 * Theme functions.
 *
 * @package Nolan_Showcase_Theme_X5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Shim for wp_body_open() for WordPress < 5.2.
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * @return void
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * @return void
 */
function nolan_showcase_x5_setup() {
	load_theme_textdomain( 'nolan-showcase-theme-x5', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'automatic-feed-links' );
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
		)
	);

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'nolan-showcase-theme-x5' ),
			'footer'  => esc_html__( 'Footer Menu', 'nolan-showcase-theme-x5' ),
		)
	);
}
add_action( 'after_setup_theme', 'nolan_showcase_x5_setup' );

/**
 * Register widget areas.
 *
 * @return void
 */
function nolan_showcase_x5_register_sidebars() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nolan-showcase-theme-x5' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'nolan-showcase-theme-x5' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nolan_showcase_x5_register_sidebars' );

/**
 * Get a filemtime-based version for a theme asset.
 *
 * @param string $relative_path Relative path from theme root.
 * @return string|null Version string or null when not found.
 */
function nolan_showcase_x5_asset_version( $relative_path ) {
	$filepath = trailingslashit( get_template_directory() ) . ltrim( $relative_path, '/' );
	if ( ! file_exists( $filepath ) ) {
		return null;
	}

	$mtime = filemtime( $filepath );
	return $mtime ? (string) $mtime : null;
}

/**
 * Enqueue theme assets.
 *
 * @return void
 */
function nolan_showcase_x5_enqueue_assets() {
	wp_enqueue_style(
		'nolan-showcase-theme-x5',
		trailingslashit( get_template_directory_uri() ) . 'assets/css/theme.css',
		array(),
		nolan_showcase_x5_asset_version( 'assets/css/theme.css' )
	);

	wp_enqueue_script(
		'nolan-showcase-theme-x5',
		trailingslashit( get_template_directory_uri() ) . 'assets/js/theme.js',
		array(),
		nolan_showcase_x5_asset_version( 'assets/js/theme.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nolan_showcase_x5_enqueue_assets' );

/**
 * Internal helper for theme image URLs.
 *
 * @param string $filename SVG filename in /assets/images/.
 * @return string
 */
function nolan_showcase_x5_image_url( $filename ) {
	return trailingslashit( get_template_directory_uri() ) . 'assets/images/' . ltrim( $filename, '/' );
}

/**
 * Anchor-style menu links for homepage sections (fallback).
 *
 * @return array<string,string>
 */
function nolan_showcase_x5_menu_links() {
	return array(
		'portfolio'  => __( 'Portfolio', 'nolan-showcase-theme-x5' ),
		'services'   => __( 'Services', 'nolan-showcase-theme-x5' ),
		'experience' => __( 'Experience', 'nolan-showcase-theme-x5' ),
		'about'      => __( 'About', 'nolan-showcase-theme-x5' ),
		'contact'    => __( 'Contact', 'nolan-showcase-theme-x5' ),
	);
}

/**
 * Primary menu fallback.
 *
 * @return void
 */
function nolan_showcase_x5_fallback_menu() {
	echo '<ul id="primary-menu" class="nav-menu">';
	foreach ( nolan_showcase_x5_menu_links() as $target => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/#' . $target ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

/**
 * Footer menu fallback.
 *
 * @return void
 */
function nolan_showcase_x5_footer_fallback_menu() {
	echo '<ul class="footer-menu">';
	foreach ( nolan_showcase_x5_menu_links() as $target => $label ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/#' . $target ) ),
			esc_html( $label )
		);
	}
	echo '</ul>';
}

