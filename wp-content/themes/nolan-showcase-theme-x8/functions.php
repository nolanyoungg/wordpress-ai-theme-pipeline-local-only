<?php
/**
 * Theme functions and definitions.
 *
 * @package Nolan_Showcase_Theme_X8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOLAN_SHOWCASE_X8_VERSION', '1.0.0' );

function nolan_showcase_x8_setup() {
	load_theme_textdomain( 'nolan-showcase-theme-x8', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
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
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'nolan-showcase-theme-x8' ),
		)
	);
}
add_action( 'after_setup_theme', 'nolan_showcase_x8_setup' );

function nolan_showcase_x8_enqueue_assets() {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style(
		'nolan-showcase-x8',
		$theme_uri . '/assets/css/theme.css',
		array(),
		NOLAN_SHOWCASE_X8_VERSION
	);

	wp_enqueue_script(
		'nolan-showcase-x8',
		$theme_uri . '/assets/js/theme.js',
		array(),
		NOLAN_SHOWCASE_X8_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nolan_showcase_x8_enqueue_assets' );

function nolan_showcase_x8_primary_menu_fallback() {
	$home = trailingslashit( home_url( '/' ) );
	$items = array(
		array(
			'label' => esc_html__( 'Home', 'nolan-showcase-theme-x8' ),
			'href'  => $home,
		),
		array(
			'label' => esc_html__( 'Work', 'nolan-showcase-theme-x8' ),
			'href'  => $home . '#work',
		),
		array(
			'label' => esc_html__( 'About', 'nolan-showcase-theme-x8' ),
			'href'  => $home . '#about',
		),
		array(
			'label' => esc_html__( 'Contact', 'nolan-showcase-theme-x8' ),
			'href'  => $home . '#contact',
		),
	);

	echo '<ul id="primary-menu" class="nav-menu">';
	foreach ( $items as $item ) {
		printf(
			'<li><a href="%1$s">%2$s</a></li>',
			esc_url( $item['href'] ),
			esc_html( $item['label'] )
		);
	}
	echo '</ul>';
}

function nolan_showcase_x8_get_post_excerpt( $post_id, $words = 26 ) {
	$post_id = (int) $post_id;
	$words   = (int) $words;

	$raw_excerpt = get_the_excerpt( $post_id );
	if ( '' === trim( (string) $raw_excerpt ) ) {
		$raw_excerpt = wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) );
	}

	$trimmed = wp_trim_words( (string) $raw_excerpt, $words, '…' );

	return wp_kses_post( $trimmed );
}
