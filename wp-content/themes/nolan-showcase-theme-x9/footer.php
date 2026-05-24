<?php
/**
 * Footer template.
 *
 * @package Nolan_Showcase_Theme_X9
 */
?>
</main>

<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-brand">
			<p class="footer-brand__name"><?php echo esc_html( nolan_x9_get_brand_name() ); ?></p>
			<p class="footer-brand__tagline"><?php echo esc_html__( 'Bright, cinematic photography — made to be printed, shared, and remembered.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="footer-brand__meta">
				<span><?php echo esc_html__( 'NYC + travel', 'nolan-showcase-theme-x9' ); ?></span>
				<span aria-hidden="true">•</span>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php echo esc_html__( 'Start an inquiry', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>

		<nav class="footer-nav" aria-label="<?php echo esc_attr_x( 'Footer', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-nav__list',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul class="footer-nav__list">
					<li><a href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x9' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x9' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x9' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x9' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</nav>

		<div class="footer-contact">
			<p class="footer-contact__title"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x9' ); ?></p>
			<ul class="footer-contact__list">
				<li><?php echo esc_html__( 'Email: hello@mnyphoto.example', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php echo esc_html__( 'Studio: Manhattan, New York', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php echo esc_html__( 'Hours: Mon–Fri, sessions by appointment', 'nolan-showcase-theme-x9' ); ?></li>
			</ul>
		</div>
	</div>

	<div class="container footer-bottom">
		<p class="footer-bottom__copy">
			<?php
			echo esc_html(
				sprintf(
					/* translators: %s is year. */
					__( '© %s MNY Photo. All rights reserved.', 'nolan-showcase-theme-x9' ),
					gmdate( 'Y' )
				)
			);
			?>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

