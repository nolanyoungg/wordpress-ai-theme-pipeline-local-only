<?php
/**
 * Footer template.
 *
 * @package Nolan_Showcase_Theme_X2
 */
?>
<footer class="site-footer">
	<div class="container footer-grid">
		<div>
			<a class="brand brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brand__mark" aria-hidden="true">NX</span>
				<span class="brand__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</a>
			<p><?php esc_html_e( 'Software development, WordPress systems, automation, AI integration, analytics, and technical leadership for teams that need dependable delivery.', 'nolan-showcase-theme-x2' ); ?></p>
		</div>
		<nav class="footer-links" aria-label="<?php esc_attr_e( 'Footer navigation', 'nolan-showcase-theme-x2' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'nolan_showcase_x2_footer_fallback_menu',
				)
			);
			?>
		</nav>
	</div>
	<div class="footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
