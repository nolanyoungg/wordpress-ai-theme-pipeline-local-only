<?php
/**
 * Content template for pages.
 *
 * @package Nolan_Showcase_Theme_X6
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>
	<header class="page-head">
		<p class="kicker"><?php echo esc_html( get_the_date() ); ?></p>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div class="prose">
		<?php the_content(); ?>
	</div>
</article>

