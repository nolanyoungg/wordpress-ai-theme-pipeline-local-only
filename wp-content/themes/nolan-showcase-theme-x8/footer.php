<?php
/**
 * The footer for the theme.
 *
 * @package Nolan_Showcase_Theme_X8
 */
?>

</main>

<footer class="site-footer">
	<div class="container footer-inner">
		<p class="footer-meta">
			<?php
			printf(
				/* translators: 1: year, 2: site name */
				esc_html__( '© %1$s %2$s', 'nolan-showcase-theme-x8' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>
		<p class="footer-meta">
			<a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>">
				<?php echo esc_html__( 'Proudly powered by WordPress', 'nolan-showcase-theme-x8' ); ?>
			</a>
		</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
