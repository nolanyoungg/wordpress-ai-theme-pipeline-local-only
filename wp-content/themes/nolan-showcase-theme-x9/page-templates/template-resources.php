<?php
/**
 * Template Name: Resources
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();

$contact_url = esc_url( home_url( '/contact/' ) );
?>

<section class="page-hero">
	<div class="container page-hero__grid">
		<div class="page-hero__copy" data-reveal>
			<p class="page-hero__kicker"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="page-hero__title"><?php esc_html_e( 'Planning, styling, and gallery tips — kept simple.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="page-hero__subtitle"><?php esc_html_e( 'Guides we share with clients to make sessions feel easy and images feel consistent.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="page-hero__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Ask a question', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="#latest"><?php esc_html_e( 'Latest posts', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
		<div class="page-hero__media" data-reveal aria-hidden="true">
			<img src="<?php echo nolan_x9_asset( 'assets/images/resource-location-01.jpg' ); ?>" width="1200" height="820" alt="" loading="eager" decoding="async">
		</div>
	</div>
</section>

<section class="section section--tight">
	<div class="container container--narrow">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<div class="entry-content" data-reveal>
				<?php the_content(); ?>
			</div>
			<?php
		endwhile;
		?>
	</div>
</section>

<section id="latest" class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Latest posts', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Short reads designed to help you plan quickly and confidently.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--posts">
			<?php
			$loop = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 6,
					'ignore_sticky_posts' => true,
				)
			);
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) {
					$loop->the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				}
				wp_reset_postdata();
			} else {
				$fallback = array(
					array( 'title' => __( 'How to pick a location (light-first)', 'nolan-showcase-theme-x9' ), 'img' => 'resource-location-01.jpg', 'kicker' => __( 'Locations', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Wardrobe that photographs like a campaign', 'nolan-showcase-theme-x9' ), 'img' => 'resource-wardrobe-01.jpg', 'kicker' => __( 'Planning', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Gallery delivery: downloads + print prep', 'nolan-showcase-theme-x9' ), 'img' => 'resource-print-01.jpg', 'kicker' => __( 'Delivery', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Session day tips for feeling natural', 'nolan-showcase-theme-x9' ), 'img' => 'resource-sessionday-01.jpg', 'kicker' => __( 'Session Day', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'How we build a shot flow (so it feels easy)', 'nolan-showcase-theme-x9' ), 'img' => 'feature-story-01.jpg', 'kicker' => __( 'Process', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Black & white: when it strengthens the story', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-bw-01.jpg', 'kicker' => __( 'Editing', 'nolan-showcase-theme-x9' ) ),
				);
				foreach ( $fallback as $item ) :
					?>
					<article class="resource-card resource-card--image" data-reveal>
						<img class="resource-card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $item['img'] ); ?>" width="720" height="520" alt="" loading="lazy" decoding="async">
						<p class="resource-card__kicker"><?php echo esc_html( $item['kicker'] ); ?></p>
						<h3 class="resource-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<a class="btn btn-text" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Add blog posts to replace these →', 'nolan-showcase-theme-x9' ); ?></a>
					</article>
					<?php
				endforeach;
			}
			?>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Topics', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Jump to a category when you’re planning fast.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--topics">
			<div class="topic" data-reveal>
				<h3 class="topic__title"><?php esc_html_e( 'Wardrobe + styling', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="topic__copy"><?php esc_html_e( 'Color palettes, fabrics, and options for every season.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="topic" data-reveal>
				<h3 class="topic__title"><?php esc_html_e( 'Locations', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="topic__copy"><?php esc_html_e( 'Light-first picks for city streets, parks, and interiors.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="topic" data-reveal>
				<h3 class="topic__title"><?php esc_html_e( 'Session day', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="topic__copy"><?php esc_html_e( 'Prompts, pacing, and small changes that feel natural.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="topic" data-reveal>
				<h3 class="topic__title"><?php esc_html_e( 'Gallery delivery', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="topic__copy"><?php esc_html_e( 'Downloads, prints, and how to pick favorites quickly.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'Want a personalized plan?', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Tell us what you’re planning. We’ll reply with timing, location ideas, and a simple session structure.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

