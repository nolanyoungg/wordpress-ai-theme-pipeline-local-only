<?php
/**
 * Page template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();

