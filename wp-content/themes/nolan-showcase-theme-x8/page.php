<?php
/**
 * Page template.
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
					<h1><?php echo esc_html( get_the_title() ); ?></h1>
				</header>

				<div class="prose">
					<?php the_content(); ?>
				</div>

				<?php comments_template(); ?>
			</article>
		<?php endwhile; ?>
	</div>
</section>

<?php
get_footer();

