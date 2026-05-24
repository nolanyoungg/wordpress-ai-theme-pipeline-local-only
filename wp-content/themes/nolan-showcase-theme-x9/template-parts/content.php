<?php
/**
 * Default content template.
 *
 * @package Nolan_Showcase_Theme_X9
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?> data-reveal>
	<header class="post-card__head">
		<h2 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="post-card__meta">
			<span><?php echo esc_html( get_the_date() ); ?></span>
			<span aria-hidden="true">•</span>
			<span><?php the_category( ', ' ); ?></span>
		</p>
	</header>

	<div class="post-card__excerpt">
		<?php the_excerpt(); ?>
	</div>

	<a class="btn btn-text" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more →', 'nolan-showcase-theme-x9' ); ?></a>
</article>

