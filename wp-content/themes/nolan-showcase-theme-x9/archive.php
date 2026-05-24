<?php
/**
 * Archive template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container">
		<header class="section-head">
			<h1 class="section-title"><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<p class="section-subtitle">', '</p>' ); ?>
		</header>

		<div class="grid grid--posts">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
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

