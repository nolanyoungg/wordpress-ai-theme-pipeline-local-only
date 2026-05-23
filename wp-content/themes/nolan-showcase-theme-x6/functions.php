<?php
/**
 * Theme functions and definitions.
 *
 * @package Nolan_Showcase_Theme_X6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NOLAN_SHOWCASE_X6_VERSION', '1.0.0' );
define( 'NOLAN_SHOWCASE_X6_DIR', trailingslashit( get_template_directory() ) );
define( 'NOLAN_SHOWCASE_X6_URI', trailingslashit( get_template_directory_uri() ) );

require_once NOLAN_SHOWCASE_X6_DIR . 'inc/setup.php';
require_once NOLAN_SHOWCASE_X6_DIR . 'inc/enqueue.php';
require_once NOLAN_SHOWCASE_X6_DIR . 'inc/template-functions.php';

