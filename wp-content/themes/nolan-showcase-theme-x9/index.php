<?php
/**
 * Main template file.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container">
		<header class="section-head">
			<h1 class="section-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
			<p class="section-subtitle"><?php echo esc_html__( 'Latest posts and updates.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--posts">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				}

				the_posts_navigation(
					array(
						'prev_text' => __( 'Newer posts', 'nolan-showcase-theme-x9' ),
						'next_text' => __( 'Older posts', 'nolan-showcase-theme-x9' ),
					)
				);
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>
		</div>
	</div>
</section>

<?php
get_footer();

