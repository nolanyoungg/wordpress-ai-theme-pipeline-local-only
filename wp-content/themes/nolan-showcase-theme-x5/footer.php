<?php
/**
 * Footer template.
 *
 * @package Nolan_Showcase_Theme_X5
 */
?>
<footer class="site-footer">
	<div class="container footer-grid">
		<a class="brand brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="brand-mark" src="<?php echo esc_url( nolan_showcase_x5_image_url( 'logo-mark.svg' ) ); ?>" alt="" aria-hidden="true">
			<span class="brand-text">
				<strong><?php esc_html_e( 'MNY Photo', 'nolan-showcase-theme-x5' ); ?></strong>
				<em><?php esc_html_e( 'Editorial, cinematic, warm-luxury imagery.', 'nolan-showcase-theme-x5' ); ?></em>
			</span>
		</a>

		<nav aria-label="<?php echo esc_attr__( 'Footer navigation', 'nolan-showcase-theme-x5' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'container'      => false,
					'fallback_cb'    => 'nolan_showcase_x5_footer_fallback_menu',
				)
			);
			?>
		</nav>

		<div class="footer-note">
			<p><?php echo esc_html( sprintf( __( 'Built for %s • No external assets', 'nolan-showcase-theme-x5' ), wp_date( 'Y' ) ) ); ?></p>
			<p><a href="<?php echo esc_url( 'mailto:hello@mnyphoto.example' ); ?>"><?php echo esc_html( 'hello@mnyphoto.example' ); ?></a></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

