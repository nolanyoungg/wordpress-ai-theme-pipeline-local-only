<?php
/**
 * Archive template.
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="section section--tight">
		<div class="container">
			<header class="page-head">
				<p class="kicker"><?php esc_html_e( 'Archive', 'nolan-showcase-theme-x6' ); ?></p>
				<h1 class="page-title"><?php the_archive_title(); ?></h1>
				<div class="page-lede"><?php the_archive_description(); ?></div>
			</header>

			<?php if ( have_posts() ) : ?>
				<div class="card-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				</div>

				<nav class="pagination" aria-label="<?php echo esc_attr__( 'Archive navigation', 'nolan-showcase-theme-x6' ); ?>">
					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 1,
							'prev_text' => esc_html__( 'Previous', 'nolan-showcase-theme-x6' ),
							'next_text' => esc_html__( 'Next', 'nolan-showcase-theme-x6' ),
						)
					);
					?>
				</nav>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();

