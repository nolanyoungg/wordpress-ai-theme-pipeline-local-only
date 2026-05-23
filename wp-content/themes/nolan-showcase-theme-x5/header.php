<?php
/**
 * Header template.
 *
 * @package Nolan_Showcase_Theme_X5
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
<a class="skip-link" href="#main-content"><?php esc_html_e( 'Skip to content', 'nolan-showcase-theme-x5' ); ?></a>

<header class="site-header" data-site-header>
	<div class="container header-shell">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr__( 'MNY Photo home', 'nolan-showcase-theme-x5' ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img class="brand-mark" src="<?php echo esc_url( nolan_showcase_x5_image_url( 'logo-mark.svg' ) ); ?>" alt="" aria-hidden="true">
				<span class="brand-text">
					<strong><?php esc_html_e( 'MNY Photo', 'nolan-showcase-theme-x5' ); ?></strong>
					<em><?php esc_html_e( 'Cinematic editorial photography', 'nolan-showcase-theme-x5' ); ?></em>
				</span>
			<?php endif; ?>
		</a>

		<button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="primary-menu">
			<span><?php esc_html_e( 'Menu', 'nolan-showcase-theme-x5' ); ?></span>
		</button>

		<nav class="primary-nav" aria-label="<?php echo esc_attr__( 'Primary navigation', 'nolan-showcase-theme-x5' ); ?>" data-primary-nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
					'container'      => false,
					'fallback_cb'    => 'nolan_showcase_x5_fallback_menu',
				)
			);
			?>
			<a class="nav-cta" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Book a Session', 'nolan-showcase-theme-x5' ); ?></a>
		</nav>
	</div>
</header>

