<?php
/**
 * Portfolio preview section.
 *
 * @package Nolan_Showcase_Theme_X6
 */

$items = (array) get_query_var( 'nolan_showcase_x6_portfolio_items', array() );
?>

<section class="section" id="portfolio">
	<div class="container">
		<header class="section-head reveal">
			<p class="kicker"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x6' ); ?></p>
			<h2><?php esc_html_e( 'A curated mix of moments—wide frames, quiet details, and portraits with presence.', 'nolan-showcase-theme-x6' ); ?></h2>
			<p class="section-lede"><?php esc_html_e( 'These are local SVG placeholders for the theme demo. Replace with real photography in WordPress media.', 'nolan-showcase-theme-x6' ); ?></p>
		</header>

		<div class="filter-bar reveal" role="group" aria-label="<?php echo esc_attr__( 'Portfolio filters', 'nolan-showcase-theme-x6' ); ?>">
			<button type="button" class="filter-pill is-active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', 'nolan-showcase-theme-x6' ); ?></button>
			<button type="button" class="filter-pill" data-filter="wedding" aria-pressed="false"><?php esc_html_e( 'Weddings', 'nolan-showcase-theme-x6' ); ?></button>
			<button type="button" class="filter-pill" data-filter="branding" aria-pressed="false"><?php esc_html_e( 'Branding', 'nolan-showcase-theme-x6' ); ?></button>
			<button type="button" class="filter-pill" data-filter="portrait" aria-pressed="false"><?php esc_html_e( 'Portrait', 'nolan-showcase-theme-x6' ); ?></button>
			<button type="button" class="filter-pill" data-filter="event" aria-pressed="false"><?php esc_html_e( 'Event', 'nolan-showcase-theme-x6' ); ?></button>
		</div>

		<div class="portfolio-grid" data-portfolio-grid>
			<?php foreach ( $items as $item ) : ?>
				<?php
				$title   = (string) ( $item['title'] ?? '' );
				$caption = (string) ( $item['caption'] ?? '' );
				$image   = (string) ( $item['image'] ?? '' );
				$layout  = (string) ( $item['layout'] ?? 'square' );
				$tags    = (array) ( $item['tags'] ?? array() );
				?>
				<article class="portfolio-card portfolio-card--<?php echo esc_attr( $layout ); ?> reveal" data-tags="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_title', $tags ) ) ); ?>">
					<div class="frame">
						<img src="<?php echo esc_url( nolan_showcase_x6_image_url( $image ) ); ?>" alt="<?php echo esc_attr( $title ); ?>">
					</div>
					<div class="portfolio-body">
						<h3><?php echo esc_html( $title ); ?></h3>
						<p><?php echo esc_html( $caption ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="center-actions reveal">
			<a class="button button--secondary" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Explore services', 'nolan-showcase-theme-x6' ); ?></a>
			<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Book a Session', 'nolan-showcase-theme-x6' ); ?></a>
		</div>
	</div>
</section>

