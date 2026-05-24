<?php
/**
 * Nolan Showcase Theme X9 functions and definitions.
 *
 * @package Nolan_Showcase_Theme_X9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOLAN_X9_THEME_VERSION', '1.0.0' );

function nolan_x9_asset( $relative_path ) {
	return esc_url( get_theme_file_uri( ltrim( (string) $relative_path, '/' ) ) );
}

function nolan_x9_file_version( $relative_path ) {
	$path = get_theme_file_path( ltrim( (string) $relative_path, '/' ) );
	if ( $path && file_exists( $path ) ) {
		return (string) filemtime( $path );
	}
	return NOLAN_X9_THEME_VERSION;
}

function nolan_x9_setup() {
	load_theme_textdomain( 'nolan-showcase-theme-x9', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 56, 'width' => 220, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'search-form',
			'style',
			'script',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'nolan-showcase-theme-x9' ),
			'footer'  => __( 'Footer menu', 'nolan-showcase-theme-x9' ),
		)
	);
}
add_action( 'after_setup_theme', 'nolan_x9_setup' );

function nolan_x9_content_width() {
	$GLOBALS['content_width'] = isset( $GLOBALS['content_width'] ) ? (int) $GLOBALS['content_width'] : 1200;
}
add_action( 'after_setup_theme', 'nolan_x9_content_width', 0 );

function nolan_x9_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'nolan-showcase-theme-x9' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'nolan-showcase-theme-x9' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nolan_x9_widgets_init' );

function nolan_x9_enqueue_assets() {
	$style_rel = 'assets/css/theme.css';
	$js_rel    = 'assets/js/theme.js';

	wp_enqueue_style(
		'nolan-x9-theme',
		nolan_x9_asset( $style_rel ),
		array(),
		nolan_x9_file_version( $style_rel )
	);

	wp_enqueue_script(
		'nolan-x9-theme',
		nolan_x9_asset( $js_rel ),
		array(),
		nolan_x9_file_version( $js_rel ),
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nolan_x9_enqueue_assets' );

function nolan_x9_get_brand_name() {
	return __( 'MNY Photo', 'nolan-showcase-theme-x9' );
}

function nolan_x9_site_logo_markup() {
	$home = esc_url( home_url( '/' ) );

	if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
		echo '<div class="nolan-menu__brand nolan-menu__brand--custom-logo">';
		the_custom_logo();
		echo '</div>';
		return;
	}

	echo '<a class="nolan-menu__brand" href="' . $home . '">';
	$mark = nolan_x9_asset( 'assets/images/logo-mark.svg' );
	echo '<span class="nolan-menu__brand-mark" aria-hidden="true"><img src="' . esc_url( $mark ) . '" width="28" height="28" alt="" decoding="async" loading="eager"></span>';
	echo '<span class="nolan-menu__brand-text">' . esc_html( nolan_x9_get_brand_name() ) . '</span>';
	echo '</a>';
}
