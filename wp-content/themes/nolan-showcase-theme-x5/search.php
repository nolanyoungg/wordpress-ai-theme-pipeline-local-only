<?php
/**
 * Search results template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow"><?php esc_html_e( 'Search', 'nolan-showcase-theme-x5' ); ?></p>
			<h1 class="page-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Results for “%s”', 'nolan-showcase-theme-x5' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
			<div class="search-inline"><?php get_search_form(); ?></div>
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
					<section class="empty-state reveal">
						<h2><?php esc_html_e( 'No results', 'nolan-showcase-theme-x5' ); ?></h2>
						<p><?php esc_html_e( 'Try a different keyword, or browse the latest posts.', 'nolan-showcase-theme-x5' ); ?></p>
						<?php get_search_form(); ?>
					</section>
				<?php endif; ?>
			</div>

			<aside class="sidebar-column" aria-label="<?php echo esc_attr__( 'Sidebar', 'nolan-showcase-theme-x5' ); ?>">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php endif; ?>
			</aside>
		</div>
	</section>
</main>
<?php
get_footer();

