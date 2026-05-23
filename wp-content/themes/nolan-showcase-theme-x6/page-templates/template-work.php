<?php
/**
 * Template Name: Work
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();

$items = array(
	array(
		'title'   => __( 'Wedding, slow cinema', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Glances, movement, and light you can feel.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-wedding-moment.svg',
		'tags'    => 'wedding',
	),
	array(
		'title'   => __( 'Branding with restraint', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Editorial portraits built for premium websites.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-branding-session.svg',
		'tags'    => 'branding',
	),
	array(
		'title'   => __( 'Event coverage, elevated', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Candid moments with intentional framing.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-event-coverage.svg',
		'tags'    => 'event',
	),
	array(
		'title'   => __( 'Black + white editorial', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Shape, shadow, and timeless composition.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-black-white-portrait.svg',
		'tags'    => 'portrait',
	),
	array(
		'title'   => __( 'Commercial campaign', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Clean art direction with cinematic mood.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-commercial-campaign.svg',
		'tags'    => 'branding',
	),
	array(
		'title'   => __( 'Studio session', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Soft shadows and editorial stillness.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-studio-session.svg',
		'tags'    => 'portrait',
	),
);
?>

<main id="main-content" class="site-main">
	<section class="section">
		<div class="container">
			<header class="page-head reveal">
				<p class="kicker"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x6' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'Portfolio highlights', 'nolan-showcase-theme-x6' ); ?></h1>
				<p class="page-lede"><?php esc_html_e( 'Replace these SVG placeholders with real galleries and posts in WordPress.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>

			<div class="filter-bar reveal" role="group" aria-label="<?php echo esc_attr__( 'Work filters', 'nolan-showcase-theme-x6' ); ?>">
				<button type="button" class="filter-pill is-active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', 'nolan-showcase-theme-x6' ); ?></button>
				<button type="button" class="filter-pill" data-filter="wedding" aria-pressed="false"><?php esc_html_e( 'Weddings', 'nolan-showcase-theme-x6' ); ?></button>
				<button type="button" class="filter-pill" data-filter="branding" aria-pressed="false"><?php esc_html_e( 'Branding', 'nolan-showcase-theme-x6' ); ?></button>
				<button type="button" class="filter-pill" data-filter="portrait" aria-pressed="false"><?php esc_html_e( 'Portrait', 'nolan-showcase-theme-x6' ); ?></button>
				<button type="button" class="filter-pill" data-filter="event" aria-pressed="false"><?php esc_html_e( 'Event', 'nolan-showcase-theme-x6' ); ?></button>
			</div>

			<div class="portfolio-grid" data-portfolio-grid>
				<?php foreach ( $items as $item ) : ?>
					<article class="portfolio-card reveal" data-tags="<?php echo esc_attr( $item['tags'] ); ?>">
						<div class="frame">
							<img src="<?php echo esc_url( nolan_showcase_x6_image_url( $item['image'] ) ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
						</div>
						<div class="portfolio-body">
							<h2><?php echo esc_html( $item['title'] ); ?></h2>
							<p><?php echo esc_html( $item['caption'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="center-actions reveal">
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a Session', 'nolan-showcase-theme-x6' ); ?></a>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Explore services', 'nolan-showcase-theme-x6' ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

