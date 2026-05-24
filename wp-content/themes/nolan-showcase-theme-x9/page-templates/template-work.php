<?php
/**
 * Template Name: Work
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();

$contact_url = esc_url( home_url( '/contact/' ) );
?>

<section class="page-hero">
	<div class="container page-hero__grid">
		<div class="page-hero__copy" data-reveal>
			<p class="page-hero__kicker"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="page-hero__title"><?php esc_html_e( 'Curated stories, photographed with warmth and intention.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="page-hero__subtitle"><?php esc_html_e( 'Browse categories, then reach out with your date and your vibe. We’ll recommend the right coverage and pace.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="page-hero__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Book a session', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="#gallery"><?php esc_html_e( 'View gallery', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
		<div class="page-hero__media" data-reveal aria-hidden="true">
			<img src="<?php echo nolan_x9_asset( 'assets/images/portfolio-wedding-01.jpg' ); ?>" width="1200" height="820" alt="" loading="eager" decoding="async">
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

<section id="gallery" class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Gallery', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Twelve sets across portrait, brand, event, and wedding work.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<nav class="filter-nav" aria-label="<?php echo esc_attr_x( 'Work categories', 'aria label', 'nolan-showcase-theme-x9' ); ?>" data-reveal>
			<button class="filter-nav__btn is-active" type="button" data-filter="all"><?php esc_html_e( 'All', 'nolan-showcase-theme-x9' ); ?></button>
			<button class="filter-nav__btn" type="button" data-filter="portrait"><?php esc_html_e( 'Portrait', 'nolan-showcase-theme-x9' ); ?></button>
			<button class="filter-nav__btn" type="button" data-filter="wedding"><?php esc_html_e( 'Wedding', 'nolan-showcase-theme-x9' ); ?></button>
			<button class="filter-nav__btn" type="button" data-filter="brand"><?php esc_html_e( 'Brand', 'nolan-showcase-theme-x9' ); ?></button>
			<button class="filter-nav__btn" type="button" data-filter="event"><?php esc_html_e( 'Event', 'nolan-showcase-theme-x9' ); ?></button>
			<button class="filter-nav__btn" type="button" data-filter="product"><?php esc_html_e( 'Product', 'nolan-showcase-theme-x9' ); ?></button>
		</nav>

		<div class="grid grid--gallery">
			<?php
			$gallery = array(
				array( 'title' => __( 'Morning studio portrait', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-portrait-01.jpg', 'cat' => 'portrait' ),
				array( 'title' => __( 'Street light couple story', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-couple-01.jpg', 'cat' => 'portrait' ),
				array( 'title' => __( 'Black & white editorial', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-bw-01.jpg', 'cat' => 'portrait' ),
				array( 'title' => __( 'Wedding — first look', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-wedding-01.jpg', 'cat' => 'wedding' ),
				array( 'title' => __( 'Wedding — portraits in warm light', 'nolan-showcase-theme-x9' ), 'img' => 'service-wedding-01.jpg', 'cat' => 'wedding' ),
				array( 'title' => __( 'Brand campaign — founder story', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-brand-01.jpg', 'cat' => 'brand' ),
				array( 'title' => __( 'Brand — details + workspace', 'nolan-showcase-theme-x9' ), 'img' => 'hero-brand-01.jpg', 'cat' => 'brand' ),
				array( 'title' => __( 'Event — candid coverage', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-event-01.jpg', 'cat' => 'event' ),
				array( 'title' => __( 'Event — table details', 'nolan-showcase-theme-x9' ), 'img' => 'service-event-01.jpg', 'cat' => 'event' ),
				array( 'title' => __( 'Product — warm still life', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-product-01.jpg', 'cat' => 'product' ),
				array( 'title' => __( 'Product — texture study', 'nolan-showcase-theme-x9' ), 'img' => 'service-product-01.jpg', 'cat' => 'product' ),
				array( 'title' => __( 'Family — natural movement', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-family-01.jpg', 'cat' => 'portrait' ),
			);

			foreach ( $gallery as $item ) :
				?>
				<article class="gallery-card" data-work-card data-cat="<?php echo esc_attr( $item['cat'] ); ?>" data-reveal>
					<img class="gallery-card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $item['img'] ); ?>" width="960" height="640" alt="" loading="lazy" decoding="async">
					<div class="gallery-card__meta">
						<h3 class="gallery-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="gallery-card__cat"><?php echo esc_html( ucfirst( $item['cat'] ) ); ?></p>
					</div>
				</article>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<div class="feature-story" data-reveal>
			<div class="feature-story__media" aria-hidden="true">
				<img src="<?php echo nolan_x9_asset( 'assets/images/feature-story-01.jpg' ); ?>" width="1200" height="860" alt="" loading="lazy" decoding="async">
			</div>
			<div class="feature-story__copy">
				<p class="feature-story__kicker"><?php esc_html_e( 'Featured story', 'nolan-showcase-theme-x9' ); ?></p>
				<h2 class="section-title"><?php esc_html_e( 'A brand launch photographed like a short film.', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'We built a set that moved from product details to portraits and environmental storytelling — all in one smooth flow.', 'nolan-showcase-theme-x9' ); ?></p>
				<ul class="checklist">
					<li><?php esc_html_e( 'Shot flow designed around the light', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Hero images + social-friendly variants', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Clean tones across the entire gallery', 'nolan-showcase-theme-x9' ); ?></li>
				</ul>
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Plan a campaign', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'Want a gallery that feels like a story?', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Send your date/timeframe and your goal — we’ll reply with a plan and availability.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

