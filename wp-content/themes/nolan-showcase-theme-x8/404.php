<?php
/**
 * 404 template.
 *
 * @package Nolan_Showcase_Theme_X8
 */

get_header();
?>

<section class="section">
	<div class="container content">
		<header class="section-head">
			<p class="eyebrow"><?php echo esc_html__( '404', 'nolan-showcase-theme-x8' ); ?></p>
			<h1><?php echo esc_html__( 'Page not found', 'nolan-showcase-theme-x8' ); ?></h1>
			<p class="section-lead"><?php echo esc_html__( 'That link doesn’t go anywhere. Try searching, or head back to the homepage.', 'nolan-showcase-theme-x8' ); ?></p>
		</header>

		<?php get_search_form(); ?>

		<p class="center-actions">
			<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Go home', 'nolan-showcase-theme-x8' ); ?></a>
		</p>
	</div>
</section>

<?php
get_footer();

