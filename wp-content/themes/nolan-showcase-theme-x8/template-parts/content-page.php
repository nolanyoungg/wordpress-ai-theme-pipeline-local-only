<?php
/**
 * Template part for displaying pages.
 *
 * @package Nolan_Showcase_Theme_X8
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-entry' ); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nolan-showcase-theme-x8' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>

