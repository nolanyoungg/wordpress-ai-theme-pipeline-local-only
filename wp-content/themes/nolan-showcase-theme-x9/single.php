<?php
/**
 * Single post template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container container--narrow">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation(
				array(
					'prev_text' => __( 'Previous: %title', 'nolan-showcase-theme-x9' ),
					'next_text' => __( 'Next: %title', 'nolan-showcase-theme-x9' ),
				)
			);

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();

