<?php
/**
 * Template part for displaying pages.
 *
 * @package Nolan_Showcase_Theme_X5
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-card reveal' ); ?>>
	<header class="page-header">
		<h2 class="post-title"><?php the_title(); ?></h2>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumb frame">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nolan-showcase-theme-x5' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>

