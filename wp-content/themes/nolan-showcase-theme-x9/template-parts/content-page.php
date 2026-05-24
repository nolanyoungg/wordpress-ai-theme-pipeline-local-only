<?php
/**
 * Page content template.
 *
 * @package Nolan_Showcase_Theme_X9
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>
	<header class="page-content__head">
		<h1 class="page-content__title"><?php the_title(); ?></h1>
	</header>

	<div class="page-content__body entry-content">
		<?php
		the_content();
		wp_link_pages();
		?>
	</div>
</article>

