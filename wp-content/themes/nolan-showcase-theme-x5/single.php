<?php
/**
 * Single post template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow">
				<?php
				printf(
					/* translators: 1: date, 2: author */
					esc_html__( '%1$s • by %2$s', 'nolan-showcase-theme-x5' ),
					esc_html( get_the_date() ),
					esc_html( get_the_author() )
				);
				?>
			</p>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="section">
		<div class="container content-grid">
			<div class="content-column">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );

					$categories = get_the_category_list( ', ' );
					$tags       = get_the_tag_list( '', ', ' );
					?>
					<?php if ( $categories || $tags ) : ?>
						<div class="post-taxonomy">
							<?php if ( $categories ) : ?>
								<p><strong><?php esc_html_e( 'Categories:', 'nolan-showcase-theme-x5' ); ?></strong> <?php echo wp_kses_post( $categories ); ?></p>
							<?php endif; ?>
							<?php if ( $tags ) : ?>
								<p><strong><?php esc_html_e( 'Tags:', 'nolan-showcase-theme-x5' ); ?></strong> <?php echo wp_kses_post( $tags ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<nav class="post-nav" aria-label="<?php echo esc_attr__( 'Post navigation', 'nolan-showcase-theme-x5' ); ?>">
						<?php the_post_navigation(); ?>
					</nav>

					<?php
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
				?>
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

