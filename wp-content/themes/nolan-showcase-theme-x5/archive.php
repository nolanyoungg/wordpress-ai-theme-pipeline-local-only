<?php
/**
 * Archive template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow"><?php esc_html_e( 'Archive', 'nolan-showcase-theme-x5' ); ?></p>
			<h1 class="page-title"><?php the_archive_title(); ?></h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="archive-description"><?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?></div>
			<?php endif; ?>
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
				<?php endif; ?>
			</aside>
		</div>
	</section>
</main>
<?php
get_footer();

