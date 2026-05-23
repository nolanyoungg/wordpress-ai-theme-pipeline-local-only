<?php
/**
 * Header template.
 *
 * @package Nolan_Showcase_Theme_X2
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'nolan-showcase-theme-x2' ); ?></a>
<header class="site-header" data-site-header>
	<div class="site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="brand__mark" aria-hidden="true">NX</span>
				<span class="brand__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			<?php endif; ?>
		</a>
		<button class="nav-toggle" type="button" aria-controls="primary-menu" aria-expanded="false" data-nav-toggle>
			<span></span><span></span><span></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'nolan-showcase-theme-x2' ); ?></span>
		</button>
		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'nolan-showcase-theme-x2' ); ?>" data-primary-nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
					'container'      => false,
					'fallback_cb'    => 'nolan_showcase_x2_fallback_menu',
				)
			);
			?>
		</nav>
	</div>
</header>
