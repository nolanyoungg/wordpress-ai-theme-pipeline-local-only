<?php
/**
 * 404 template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow"><?php esc_html_e( '404', 'nolan-showcase-theme-x5' ); ?></p>
			<h1 class="page-title"><?php esc_html_e( 'Looks like this frame is missing.', 'nolan-showcase-theme-x5' ); ?></h1>
			<p class="page-lead"><?php esc_html_e( 'Try a search, return home, or explore the latest posts.', 'nolan-showcase-theme-x5' ); ?></p>
			<div class="hero-actions">
				<a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'nolan-showcase-theme-x5' ); ?></a>
				<a class="button button-secondary" href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>"><?php esc_html_e( 'View portfolio section', 'nolan-showcase-theme-x5' ); ?></a>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container content-grid">
			<div class="content-column">
				<section class="empty-state reveal">
					<h2><?php esc_html_e( 'Search the site', 'nolan-showcase-theme-x5' ); ?></h2>
					<?php get_search_form(); ?>
				</section>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();

