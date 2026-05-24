<?php
/**
 * Single post template.
 *
 * @package Nolan_Showcase_Theme_X8
 */

get_header();
?>

<section class="section">
	<div class="container content">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article <?php post_class(); ?>>
				<header class="content-head">
					<p class="eyebrow"><?php echo esc_html__( 'Article', 'nolan-showcase-theme-x8' ); ?></p>
					<h1><?php echo esc_html( get_the_title() ); ?></h1>
					<p class="post-meta">
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</p>
				</header>

				<div class="prose">
					<?php the_content(); ?>
				</div>

				<footer class="content-foot">
					<?php the_tags( '<p class="tagline">', ' ', '</p>' ); ?>
				</footer>

				<?php comments_template(); ?>
			</article>
		<?php endwhile; ?>
	</div>
</section>

<?php
get_footer();

