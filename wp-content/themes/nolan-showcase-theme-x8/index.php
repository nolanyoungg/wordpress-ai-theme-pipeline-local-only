<?php
/**
 * Main template file.
 *
 * @package Nolan_Showcase_Theme_X8
 */

get_header();
?>

<section class="section">
	<div class="container">
		<header class="section-head">
			<p class="eyebrow"><?php echo esc_html__( 'Latest', 'nolan-showcase-theme-x8' ); ?></p>
			<h1><?php echo esc_html__( 'Posts', 'nolan-showcase-theme-x8' ); ?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="stack">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<article <?php post_class( 'post-card reveal' ); ?>>
						<h2 class="post-title">
							<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
						</h2>
						<p class="post-meta">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						</p>
						<div class="post-excerpt">
							<?php echo wp_kses_post( wpautop( nolan_showcase_x8_get_post_excerpt( (int) get_the_ID(), 40 ) ) ); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<nav class="pagination" aria-label="<?php echo esc_attr__( 'Posts navigation', 'nolan-showcase-theme-x8' ); ?>">
				<?php the_posts_pagination(); ?>
			</nav>
		<?php else : ?>
			<p><?php echo esc_html__( 'No posts found.', 'nolan-showcase-theme-x8' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();

