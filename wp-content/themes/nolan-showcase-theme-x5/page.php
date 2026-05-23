<?php
/**
 * Page template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();
?>
<main id="main-content" class="site-main">
	<section class="page-hero">
		<div class="container">
			<p class="eyebrow"><?php esc_html_e( 'Page', 'nolan-showcase-theme-x5' ); ?></p>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</div>
	</section>

	<section class="section">
		<div class="container content-grid">
			<div class="content-column">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile;
				?>
			</div>

			<aside class="sidebar-column" aria-label="<?php echo esc_attr__( 'Sidebar', 'nolan-showcase-theme-x5' ); ?>">
				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php endif; ?>
			</aside>
		</div>
	</section>
</main>
<?php
get_footer();

