<?php
/**
 * Main index template.
 *
 * @package Nolan_Showcase_Theme_X2
 */

get_header();
?>
<main id="primary" class="site-main section">
	<div class="container content-list">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card reveal' ); ?>>
					<h1><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h1>
					<div class="entry-summary"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<article class="post-card">
				<h1><?php esc_html_e( 'Nothing found', 'nolan-showcase-theme-x2' ); ?></h1>
				<p><?php esc_html_e( 'Add portfolio content in WordPress or assign a static front page to use the showcase homepage.', 'nolan-showcase-theme-x2' ); ?></p>
			</article>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
