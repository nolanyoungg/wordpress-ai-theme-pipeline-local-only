<?php
/**
 * Main template file.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow"><?php esc_html_e( 'Journal', 'nolan-showcase-theme-x5' ); ?></p>
			<h1 class="page-title"><?php bloginfo( 'name' ); ?></h1>
			<p class="page-lead"><?php esc_html_e( 'Notes on light, locations, and the stories we photograph.', 'nolan-showcase-theme-x5' ); ?></p>
		</div>
	</section>

	<section class="section">
		<div class="container content-grid">
			<div class="content-column">
				<?php if ( have_posts() ) : ?>
					<div class="post-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;
						?>
					</div>

					<div class="pagination">
						<?php the_posts_pagination(); ?>
					</div>
				<?php else : ?>
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				<?php endif; ?>
			</div>

			<aside class="sidebar-column" aria-label="<?php echo esc_attr__( 'Sidebar', 'nolan-showcase-theme-x5' ); ?>">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php else : ?>
					<section class="widget">
						<h2 class="widget-title"><?php esc_html_e( 'Search', 'nolan-showcase-theme-x5' ); ?></h2>
						<?php get_search_form(); ?>
					</section>
				<?php endif; ?>
			</aside>
		</div>
	</section>
</main>
<?php
get_footer();

