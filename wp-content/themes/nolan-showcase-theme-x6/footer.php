<?php
/**
 * Footer template.
 *
 * @package Nolan_Showcase_Theme_X6
 */

?>
	<footer class="site-footer">
		<div class="container footer-grid">
			<div class="footer-brand">
				<a class="footer-brand__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span class="footer-brand__mark" aria-hidden="true"><?php nolan_showcase_x6_brand_mark(); ?></span>
					<span class="footer-brand__text">
						<strong><?php esc_html_e( 'MNY Photo', 'nolan-showcase-theme-x6' ); ?></strong>
						<em><?php esc_html_e( 'Warm luxury. Cinematic restraint.', 'nolan-showcase-theme-x6' ); ?></em>
					</span>
				</a>
				<p class="footer-note"><?php esc_html_e( 'Based in New York. Available worldwide by request.', 'nolan-showcase-theme-x6' ); ?></p>
			</div>

			<div class="footer-widgets">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php else : ?>
					<section class="widget widget_text">
						<h2 class="widget-title"><?php esc_html_e( 'Inquiries', 'nolan-showcase-theme-x6' ); ?></h2>
						<p><?php esc_html_e( 'For availability and collections, send a note with the date + location and we’ll reply within 2 business days.', 'nolan-showcase-theme-x6' ); ?></p>
						<p><a class="button button--secondary button--small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start an inquiry', 'nolan-showcase-theme-x6' ); ?></a></p>
					</section>
				<?php endif; ?>
			</div>

			<div class="footer-nav">
				<h2 class="footer-heading"><?php esc_html_e( 'Explore', 'nolan-showcase-theme-x6' ); ?></h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
				<?php if ( ! has_nav_menu( 'footer' ) ) : ?>
					<ul class="footer-menu footer-menu--fallback">
						<li><a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x6' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x6' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x6' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x6' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x6' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<div class="container footer-bottom">
			<p class="footer-legal">
				<?php
				printf(
					/* translators: %s: current year */
					esc_html__( '© %s MNY Photo. All rights reserved.', 'nolan-showcase-theme-x6' ),
					esc_html( wp_date( 'Y' ) )
				);
				?>
			</p>
		</div>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>
