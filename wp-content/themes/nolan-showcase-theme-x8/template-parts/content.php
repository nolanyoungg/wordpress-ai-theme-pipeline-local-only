<?php
/**
 * Template part for displaying posts.
 *
 * @package Nolan_Showcase_Theme_X8
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<p class="eyebrow"><?php echo esc_html( get_the_date() ); ?></p>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="entry-content">
		<?php the_excerpt(); ?>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nolan-showcase-theme-x8' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>

