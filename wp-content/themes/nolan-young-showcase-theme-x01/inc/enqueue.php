







<?php








/**








 * Enqueue scripts and styles.








 *








 * @package Nolan_Young_Showcase_Theme_X01








 */

















function nolan_young_enqueue_scripts() {








	// Enqueue main stylesheet.








	wp_enqueue_style( 'nolan-young-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), wp_get_theme()->get('Version') );

















	// Enqueue main JavaScript bundle.








	if ( file_exists( get_template_directory() . '/assets/js/bundle.js' ) ) {








		wp_enqueue_script( 'nolan-young-main-script', get_template_directory_uri() . '/assets/js/bundle.js', array(), wp_get_theme()->get('Version'), true );








	}

















	// Add custom JavaScript for header menu interactions.








	wp_add_inline_script( 'nolan-young-main-script', '








		document.addEventListener("DOMContentLoaded", function() {








			initHeaderMenu();








			initMobileDrawer();








			initRailPanels();








			initPortfolioFilter();








			initCarousel();








			initBeforeAfter();








			initTestimonials();








			initScrollReveal();








		});








	', 'after' );








}








add_action( 'wp_enqueue_scripts', 'nolan_young_enqueue_scripts' );








