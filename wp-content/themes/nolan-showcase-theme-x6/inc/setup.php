<?php
/**
 * Theme setup.
 *
 * @package Nolan_Showcase_Theme_X6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'nolan_showcase_x6_setup' ) ) {
	/**
	 * Setup theme defaults and register supports.
	 *
	 * @return void
	 */
	function nolan_showcase_x6_setup() {
		load_theme_textdomain( 'nolan-showcase-theme-x6', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
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
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 360,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'nolan-showcase-theme-x6' ),
				'footer'  => __( 'Footer Menu', 'nolan-showcase-theme-x6' ),
			)
		);

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );

		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 920;
		}
	}
}
add_action( 'after_setup_theme', 'nolan_showcase_x6_setup' );

/**
 * Register widget areas.
 *
 * @return void
 */
function nolan_showcase_x6_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'nolan-showcase-theme-x6' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'nolan-showcase-theme-x6' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nolan_showcase_x6_widgets_init' );

