<?php
/**
 * Search results template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container">
		<header class="section-head">
			<h1 class="section-title">
				<?php
				printf(
					/* translators: %s is query. */
					esc_html__( 'Search: %s', 'nolan-showcase-theme-x9' ),
					'<span>' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>
		</header>

		<?php get_search_form(); ?>

		<div class="grid grid--posts">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'search' );
				}
				the_posts_navigation();
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();

