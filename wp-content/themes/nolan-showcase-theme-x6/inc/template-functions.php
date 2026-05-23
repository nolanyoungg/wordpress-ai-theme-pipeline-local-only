<?php
/**
 * Template helpers.
 *
 * @package Nolan_Showcase_Theme_X6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a URL to an image in assets/images.
 *
 * @param string $filename Image filename (SVG/PNG/etc).
 * @return string
 */
function nolan_showcase_x6_image_url( $filename ) {
	$filename = ltrim( (string) $filename, '/' );
	return trailingslashit( get_template_directory_uri() ) . 'assets/images/' . $filename;
}

/**
 * Estimate read time string for a post.
 *
 * @param string $content Post content.
 * @return string
 */
function nolan_showcase_x6_estimated_read_time( $content ) {
	$words = str_word_count( wp_strip_all_tags( (string) $content ) );
	$minutes = (int) ceil( max( 1, $words / 220 ) );

	return sprintf(
		/* translators: %d: minutes. */
		esc_html__( '%d min read', 'nolan-showcase-theme-x6' ),
		$minutes
	);
}

/**
 * Fallback primary navigation items (when no menu is assigned).
 *
 * @return array<int, array{label:string,url:string,slug:string}>
 */
function nolan_showcase_x6_fallback_nav_items() {
	$items = array(
		array(
			'label' => __( 'Who We Are', 'nolan-showcase-theme-x6' ),
			'url'   => home_url( '/who-we-are/' ),
			'slug'  => 'who-we-are',
		),
		array(
			'label' => __( 'What We Do', 'nolan-showcase-theme-x6' ),
			'url'   => home_url( '/what-we-do/' ),
			'slug'  => 'what-we-do',
		),
		array(
			'label' => __( 'Work', 'nolan-showcase-theme-x6' ),
			'url'   => home_url( '/work/' ),
			'slug'  => 'work',
		),
		array(
			'label' => __( 'Resources', 'nolan-showcase-theme-x6' ),
			'url'   => home_url( '/resources/' ),
			'slug'  => 'resources',
		),
	);

	return $items;
}

/**
 * wp_nav_menu() fallback callback for the primary menu.
 *
 * @param array $args Menu args.
 * @return void
 */
function nolan_showcase_x6_primary_menu_fallback( $args ) {
	$items = nolan_showcase_x6_fallback_nav_items();

	echo '<ul class="' . esc_attr( $args['menu_class'] ?? 'menu' ) . '">';
	foreach ( $items as $item ) {
		$request = '';
		if ( isset( $GLOBALS['wp'] ) && is_object( $GLOBALS['wp'] ) && isset( $GLOBALS['wp']->request ) ) {
			$request = (string) $GLOBALS['wp']->request;
		}
		$current  = untrailingslashit( (string) home_url( add_query_arg( array(), $request ) ) );
		$item_url = untrailingslashit( (string) $item['url'] );
		$is_current = ( $current === $item_url );
		echo '<li class="menu-item' . ( $is_current ? ' is-current' : '' ) . '">';
		echo '<a href="' . esc_url( $item['url'] ) . '"' . ( $is_current ? ' aria-current="page"' : '' ) . '>' . esc_html( $item['label'] ) . '</a>';
		echo '</li>';
	}
	echo '</ul>';
}

/**
 * Output the theme brand mark image (inline <img>).
 *
 * @param string $class Optional class.
 * @return void
 */
function nolan_showcase_x6_brand_mark( $class = '' ) {
	$class_attr = trim( (string) $class );
	echo '<img src="' . esc_url( nolan_showcase_x6_image_url( 'logo-mark.svg' ) ) . '" alt="" aria-hidden="true"' . ( $class_attr ? ' class="' . esc_attr( $class_attr ) . '"' : '' ) . '>';
}
