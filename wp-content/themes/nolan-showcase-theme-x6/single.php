<?php
/**
 * Single post template.
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="section section--tight">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single' ); ?>>
					<header class="single-header">
						<p class="kicker"><?php echo esc_html( get_the_date() ); ?></p>
						<h1 class="single-title"><?php the_title(); ?></h1>
						<div class="single-meta">
							<span class="single-author"><?php echo esc_html( get_the_author() ); ?></span>
							<span class="dot" aria-hidden="true">•</span>
							<span class="single-reading"><?php echo esc_html( nolan_showcase_x6_estimated_read_time( get_the_content() ) ); ?></span>
						</div>
					</header>

					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="single-featured">
							<?php the_post_thumbnail( 'large' ); ?>
						</figure>
					<?php endif; ?>

					<div class="single-content prose">
						<?php the_content(); ?>
					</div>

					<footer class="single-footer">
						<div class="single-taxonomy">
							<?php the_category( ' ' ); ?>
							<?php the_tags( '<span class="tag-list">', '', '</span>' ); ?>
						</div>

						<nav class="post-nav" aria-label="<?php echo esc_attr__( 'Post navigation', 'nolan-showcase-theme-x6' ); ?>">
							<?php the_post_navigation(); ?>
						</nav>
					</footer>
				</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
			?>
		</div>
	</section>
</main>

<?php
get_footer();

