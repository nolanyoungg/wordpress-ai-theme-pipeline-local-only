<?php
/**
 * Sidebar template.
 *
 * @package Nolan_Showcase_Theme_X9
 */
?>

<aside class="sidebar" aria-label="<?php echo esc_attr_x( 'Sidebar', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	} else {
		?>
		<section class="widget">
			<h2 class="widget__title"><?php esc_html_e( 'Explore', 'nolan-showcase-theme-x9' ); ?></h2>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View the portfolio', 'nolan-showcase-theme-x9' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x9' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x9' ); ?></a></li>
			</ul>
		</section>
		<?php
	}
	?>
</aside>

