<?php
/**
 * The header for the theme.
 *
 * @package Nolan_Showcase_Theme_X8
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php echo esc_html__( 'Skip to content', 'nolan-showcase-theme-x8' ); ?></a>

<header class="site-header" data-site-header>
	<div class="container header-inner">
		<div class="brand">
			<a class="brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brand-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<?php if ( get_bloginfo( 'description' ) ) : ?>
					<span class="brand-tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
				<?php endif; ?>
			</a>
		</div>

		<button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="primary-menu">
			<span class="nav-toggle-label"><?php echo esc_html__( 'Menu', 'nolan-showcase-theme-x8' ); ?></span>
		</button>

		<nav class="primary-nav" aria-label="<?php echo esc_attr__( 'Primary navigation', 'nolan-showcase-theme-x8' ); ?>" data-primary-nav>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'nav-menu',
					'container'      => false,
					'fallback_cb'    => 'nolan_showcase_x8_primary_menu_fallback',
				)
			);
			?>
		</nav>
	</div>
</header>

<main id="content" class="site-main">

