<?php
/**
 * Content template for posts.
 *
 * @package Nolan_Showcase_Theme_X6
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card card--post' ); ?>>
	<a class="card__link" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="card__media">
				<?php the_post_thumbnail( 'medium_large' ); ?>
			</div>
		<?php endif; ?>
		<div class="card__body">
			<p class="kicker"><?php echo esc_html( get_the_date() ); ?></p>
			<h2 class="card__title"><?php the_title(); ?></h2>
			<p class="card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
			<span class="card__meta"><?php esc_html_e( 'Read story', 'nolan-showcase-theme-x6' ); ?></span>
		</div>
	</a>
</article>

