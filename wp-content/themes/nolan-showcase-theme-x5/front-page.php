<?php
/**
 * Front page template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

get_header();

$portfolio_items = array(
	array(
		'title'   => __( 'Wedding, slow cinema', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Glances, movement, and light you can feel.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-wedding-moment.svg',
		'tags'    => array( 'wedding' ),
		'layout'  => 'wide',
	),
	array(
		'title'   => __( 'Branding with restraint', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Editorial portraits built for premium websites.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-branding-session.svg',
		'tags'    => array( 'branding' ),
		'layout'  => 'tall',
	),
	array(
		'title'   => __( 'Event coverage, elevated', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Candid moments with intentional framing.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-event-coverage.svg',
		'tags'    => array( 'event' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Product detail, cinematic', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Soft highlights, precise textures, rich contrast.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-product-detail.svg',
		'tags'    => array( 'product' ),
		'layout'  => 'wide',
	),
	array(
		'title'   => __( 'Family lifestyle, quiet', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Warm motion with space to breathe.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-family-lifestyle.svg',
		'tags'    => array( 'family' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Black + white editorial', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Shape, shadow, and timeless composition.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-black-white-portrait.svg',
		'tags'    => array( 'portrait' ),
		'layout'  => 'tall',
	),
	array(
		'title'   => __( 'Couple session, story-led', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'A narrative set—directed, never stiff.', 'nolan-showcase-theme-x5' ),
		'image'   => 'gallery-couple-session.svg',
		'tags'    => array( 'couple' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Signature portrait', 'nolan-showcase-theme-x5' ),
		'caption' => __( 'Clean lines. Soft light. An editorial finish.', 'nolan-showcase-theme-x5' ),
		'image'   => 'hero-editorial-portrait.svg',
		'tags'    => array( 'portrait' ),
		'layout'  => 'wide',
	),
);

$services = array(
	array(
		'title' => __( 'Weddings', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'Cinematic coverage with editorial pacing—built around moments, not a shot list.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Timeline collaboration', 'nolan-showcase-theme-x5' ), __( 'Natural direction', 'nolan-showcase-theme-x5' ), __( 'Gallery delivery', 'nolan-showcase-theme-x5' ) ),
	),
	array(
		'title' => __( 'Brand Sessions', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'Premium portraits and detail frames designed for web, press, and launches.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Moodboard + styling notes', 'nolan-showcase-theme-x5' ), __( 'Location scouting guidance', 'nolan-showcase-theme-x5' ), __( 'Usage-minded framing', 'nolan-showcase-theme-x5' ) ),
	),
	array(
		'title' => __( 'Couples', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'A relaxed, art-directed set with movement prompts and timeless composition.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Editorial prompts', 'nolan-showcase-theme-x5' ), __( 'Golden-hour planning', 'nolan-showcase-theme-x5' ), __( 'Multiple looks', 'nolan-showcase-theme-x5' ) ),
	),
	array(
		'title' => __( 'Families', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'Warm lifestyle photography—quiet, honest, and never overly posed.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Comfort-first direction', 'nolan-showcase-theme-x5' ), __( 'Documentary moments', 'nolan-showcase-theme-x5' ), __( 'Indoor/outdoor flexibility', 'nolan-showcase-theme-x5' ) ),
	),
	array(
		'title' => __( 'Events', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'Brand launches, dinners, and celebrations with discreet coverage and clean frames.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Guest candids', 'nolan-showcase-theme-x5' ), __( 'Speaker + detail coverage', 'nolan-showcase-theme-x5' ), __( 'Fast highlight selects', 'nolan-showcase-theme-x5' ) ),
	),
	array(
		'title' => __( 'Product / Detail', 'nolan-showcase-theme-x5' ),
		'desc'  => __( 'Cinematic product sets with rich texture and controlled highlights.', 'nolan-showcase-theme-x5' ),
		'bul'   => array( __( 'Consistent lighting', 'nolan-showcase-theme-x5' ), __( 'Macro texture frames', 'nolan-showcase-theme-x5' ), __( 'On-brand color finish', 'nolan-showcase-theme-x5' ) ),
	),
);

$process = array(
	array( __( 'Inquiry', 'nolan-showcase-theme-x5' ), __( 'A short note is enough. We’ll align on date, location, and intention.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Creative direction', 'nolan-showcase-theme-x5' ), __( 'We shape the look—wardrobe notes, pacing, and an editorial plan.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Shoot day', 'nolan-showcase-theme-x5' ), __( 'Guided, calm, and efficient. You’ll always know what to do with your hands.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Edit + tone', 'nolan-showcase-theme-x5' ), __( 'Warm-luxury color with cinematic contrast and true skin tones.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Delivery', 'nolan-showcase-theme-x5' ), __( 'A private gallery you can share, archive, and return to.', 'nolan-showcase-theme-x5' ) ),
);

$pillars = array(
	array( __( 'Light-first', 'nolan-showcase-theme-x5' ), __( 'We photograph what the light is already doing—then refine.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Editorial pacing', 'nolan-showcase-theme-x5' ), __( 'Images read like a story: wide, detail, portrait, breath.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Gentle direction', 'nolan-showcase-theme-x5' ), __( 'Clear prompts that keep you present—never posed to exhaustion.', 'nolan-showcase-theme-x5' ) ),
	array( __( 'Warm-luxury finish', 'nolan-showcase-theme-x5' ), __( 'Ivory highlights, soft shadows, and rich midtones.', 'nolan-showcase-theme-x5' ) ),
);

$testimonials = array(
	array(
		'quote' => __( '“Every photo felt like it belonged in a magazine, but we still looked like ourselves.”', 'nolan-showcase-theme-x5' ),
		'name'  => __( 'Camille + Rowan', 'nolan-showcase-theme-x5' ),
	),
	array(
		'quote' => __( '“The direction was so calm. We walked, laughed, and somehow it all looked cinematic.”', 'nolan-showcase-theme-x5' ),
		'name'  => __( 'Sofia M.', 'nolan-showcase-theme-x5' ),
	),
	array(
		'quote' => __( '“Brand photos that actually match the site. Texture, tone, and spacing were perfect.”', 'nolan-showcase-theme-x5' ),
		'name'  => __( 'Studio Founder', 'nolan-showcase-theme-x5' ),
	),
);

$faqs = array(
	array(
		__( 'Do you help with posing?', 'nolan-showcase-theme-x5' ),
		__( 'Yes—through editorial direction. You’ll get simple prompts and adjustments that keep movement natural and expressions real.', 'nolan-showcase-theme-x5' ),
	),
	array(
		__( 'What should we wear?', 'nolan-showcase-theme-x5' ),
		__( 'After booking, you’ll receive a styling guide with color palettes, texture notes, and do/don’t examples for a timeless look.', 'nolan-showcase-theme-x5' ),
	),
	array(
		__( 'How do we choose a location?', 'nolan-showcase-theme-x5' ),
		__( 'We’ll pick based on light, mood, and how you want the images to feel. Indoor options are always on the table.', 'nolan-showcase-theme-x5' ),
	),
	array(
		__( 'Can you travel?', 'nolan-showcase-theme-x5' ),
		__( 'Yes—travel is available by request. Share your city and date, and we’ll confirm feasibility and timing.', 'nolan-showcase-theme-x5' ),
	),
	array(
		__( 'Do you retouch?', 'nolan-showcase-theme-x5' ),
		__( 'Retouching is light and editorial: skin is refined, not blurred; tones stay believable; details remain crisp.', 'nolan-showcase-theme-x5' ),
	),
);

$journal_query = new WP_Query(
	array(
		'posts_per_page'      => 3,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	)
);
?>

<main id="main-content" class="site-main">
	<section class="hero" id="top">
		<div class="container hero-grid">
			<div class="hero-copy reveal">
				<p class="eyebrow"><?php esc_html_e( 'MNY Photo', 'nolan-showcase-theme-x5' ); ?></p>
				<h1><?php esc_html_e( 'Cinematic, editorial photography—crafted with warmth, restraint, and intention.', 'nolan-showcase-theme-x5' ); ?></h1>
				<p class="hero-lead"><?php esc_html_e( 'From weddings to brand sessions, we build images that feel like a film still: quiet luxury, honest emotion, precise light.', 'nolan-showcase-theme-x5' ); ?></p>

				<div class="hero-actions">
					<a class="button button-primary" href="#contact"><?php esc_html_e( 'Start Your Inquiry', 'nolan-showcase-theme-x5' ); ?></a>
					<a class="button button-secondary" href="#portfolio"><?php esc_html_e( 'View Portfolio', 'nolan-showcase-theme-x5' ); ?></a>
				</div>

				<div class="hero-proof" aria-label="<?php echo esc_attr__( 'Service notes', 'nolan-showcase-theme-x5' ); ?>">
					<div class="proof-item">
						<strong><?php esc_html_e( 'Guided direction', 'nolan-showcase-theme-x5' ); ?></strong>
						<span><?php esc_html_e( 'Clear prompts, never stiff posing.', 'nolan-showcase-theme-x5' ); ?></span>
					</div>
					<div class="proof-item">
						<strong><?php esc_html_e( 'Warm-luxury tone', 'nolan-showcase-theme-x5' ); ?></strong>
						<span><?php esc_html_e( 'Ivory highlights + cinematic contrast.', 'nolan-showcase-theme-x5' ); ?></span>
					</div>
					<div class="proof-item">
						<strong><?php esc_html_e( 'Fast replies', 'nolan-showcase-theme-x5' ); ?></strong>
						<span><?php esc_html_e( 'Reply goal: 2 business days.', 'nolan-showcase-theme-x5' ); ?></span>
					</div>
				</div>

				<p class="hero-micro">
					<?php
					printf(
						/* translators: %s: email address */
						wp_kses_post( __( 'Prefer email? Write to <a href="mailto:%s">hello@mnyphoto.example</a>.', 'nolan-showcase-theme-x5' ) ),
						esc_attr( 'hello@mnyphoto.example' )
					);
					?>
				</p>
			</div>

			<div class="hero-visual reveal" aria-label="<?php echo esc_attr__( 'Editorial portrait placeholder', 'nolan-showcase-theme-x5' ); ?>">
				<img src="<?php echo esc_url( nolan_showcase_x5_image_url( 'hero-editorial-portrait.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Abstract editorial portrait illustration', 'nolan-showcase-theme-x5' ); ?>">
				<div class="hero-overlay-card" aria-hidden="true">
					<span><?php esc_html_e( 'editorial set', 'nolan-showcase-theme-x5' ); ?></span>
					<strong><?php esc_html_e( 'light + story', 'nolan-showcase-theme-x5' ); ?></strong>
				</div>
			</div>
		</div>
	</section>

	<section class="statement section section-ink">
		<div class="container statement-grid">
			<div class="reveal">
				<p class="eyebrow"><?php esc_html_e( 'Brand statement', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'An art-directed approach—so the final gallery feels cohesive, elevated, and unmistakably you.', 'nolan-showcase-theme-x5' ); ?></h2>
			</div>
			<div class="statement-card reveal">
				<p><?php esc_html_e( 'MNY Photo works like an editorial team: we shape the mood, simplify the plan, and photograph what matters. The result is timeless imagery with cinematic depth—built for real life, not performance.', 'nolan-showcase-theme-x5' ); ?></p>
				<ul class="rule-list" aria-label="<?php echo esc_attr__( 'Approach', 'nolan-showcase-theme-x5' ); ?>">
					<li><?php esc_html_e( 'Natural direction and clean composition.', 'nolan-showcase-theme-x5' ); ?></li>
					<li><?php esc_html_e( 'Warm color, honest texture, minimal distractions.', 'nolan-showcase-theme-x5' ); ?></li>
					<li><?php esc_html_e( 'A gallery that reads like a story.', 'nolan-showcase-theme-x5' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="portfolio" class="section">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Portfolio', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'A curated mix of moments—wide frames, quiet details, and portraits with presence.', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'These are SVG placeholders for the theme demo. Replace with real photography in WordPress media.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>

			<div class="filter-bar reveal" role="group" aria-label="<?php echo esc_attr__( 'Portfolio filters', 'nolan-showcase-theme-x5' ); ?>">
				<button type="button" class="filter-pill is-active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', 'nolan-showcase-theme-x5' ); ?></button>
				<button type="button" class="filter-pill" data-filter="wedding" aria-pressed="false"><?php esc_html_e( 'Weddings', 'nolan-showcase-theme-x5' ); ?></button>
				<button type="button" class="filter-pill" data-filter="branding" aria-pressed="false"><?php esc_html_e( 'Branding', 'nolan-showcase-theme-x5' ); ?></button>
				<button type="button" class="filter-pill" data-filter="portrait" aria-pressed="false"><?php esc_html_e( 'Portrait', 'nolan-showcase-theme-x5' ); ?></button>
				<button type="button" class="filter-pill" data-filter="event" aria-pressed="false"><?php esc_html_e( 'Event', 'nolan-showcase-theme-x5' ); ?></button>
			</div>

			<div class="portfolio-grid" data-portfolio-grid>
				<?php foreach ( $portfolio_items as $item ) : ?>
					<?php
					$classes = array( 'portfolio-card', 'reveal' );
					if ( ! empty( $item['layout'] ) ) {
						$classes[] = 'portfolio-card--' . sanitize_html_class( $item['layout'] );
					}

					$tags = array();
					if ( ! empty( $item['tags'] ) && is_array( $item['tags'] ) ) {
						foreach ( $item['tags'] as $tag ) {
							$tags[] = sanitize_key( $tag );
						}
					}
					?>
					<article class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-tags="<?php echo esc_attr( implode( ' ', $tags ) ); ?>">
						<div class="frame">
							<img src="<?php echo esc_url( nolan_showcase_x5_image_url( $item['image'] ) ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
						</div>
						<div class="portfolio-body">
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<p><?php echo esc_html( $item['caption'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="center-actions reveal">
				<a class="button button-secondary" href="#services"><?php esc_html_e( 'Explore services', 'nolan-showcase-theme-x5' ); ?></a>
				<a class="button button-primary" href="#contact"><?php esc_html_e( 'Book a Session', 'nolan-showcase-theme-x5' ); ?></a>
			</div>
		</div>
	</section>

	<section id="services" class="section section-ink">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'Photo sessions designed like a set: curated, calm, and art-directed.', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'Choose a starting point—then we tailor the plan around your story and the light.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>

			<div class="service-grid">
				<?php foreach ( $services as $service ) : ?>
					<article class="service-card reveal">
						<h3><?php echo esc_html( $service['title'] ); ?></h3>
						<p><?php echo esc_html( $service['desc'] ); ?></p>
						<ul class="tag-list">
							<?php foreach ( $service['bul'] as $bullet ) : ?>
								<li><?php echo esc_html( $bullet ); ?></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="cta-strip reveal">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Booking', 'nolan-showcase-theme-x5' ); ?></p>
					<h3><?php esc_html_e( 'Tell us the date and the mood. We’ll build the session around it.', 'nolan-showcase-theme-x5' ); ?></h3>
				</div>
				<a class="button button-primary" href="#contact"><?php esc_html_e( 'Start Your Inquiry', 'nolan-showcase-theme-x5' ); ?></a>
			</div>
		</div>
	</section>

	<section id="experience" class="section">
		<div class="container experience-grid">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Experience', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'High-touch process. Minimal friction. Beautiful delivery.', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'We keep planning simple and focused, so you can stay present and the photos can breathe.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>

			<div class="experience-visual reveal">
				<img src="<?php echo esc_url( nolan_showcase_x5_image_url( 'process-contact-sheet.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Contact sheet illustration', 'nolan-showcase-theme-x5' ); ?>">
			</div>

			<ol class="process-rail" aria-label="<?php echo esc_attr__( 'Process steps', 'nolan-showcase-theme-x5' ); ?>">
				<?php foreach ( $process as $step ) : ?>
					<li class="reveal">
						<strong><?php echo esc_html( $step[0] ); ?></strong>
						<span><?php echo esc_html( $step[1] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</section>

	<section class="section section-ink">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Signature style', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'Modern editorial with cinematic restraint.', 'nolan-showcase-theme-x5' ); ?></h2>
			</div>
			<div class="pillar-grid">
				<?php foreach ( $pillars as $pillar ) : ?>
					<article class="pillar-card reveal">
						<h3><?php echo esc_html( $pillar[0] ); ?></h3>
						<p><?php echo esc_html( $pillar[1] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section id="about" class="section">
		<div class="container about-grid">
			<div class="about-visual reveal">
				<img src="<?php echo esc_url( nolan_showcase_x5_image_url( 'about-photographer.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Photographer illustration', 'nolan-showcase-theme-x5' ); ?>">
			</div>
			<div class="about-copy reveal">
				<p class="eyebrow"><?php esc_html_e( 'About', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'Direction that feels natural—so your photos feel like you.', 'nolan-showcase-theme-x5' ); ?></h2>
				<p><?php esc_html_e( 'MNY Photo is built for clients who want images that feel elevated without feeling performed. We work with gentle prompts, clean composition, and an editorial eye for shape and light.', 'nolan-showcase-theme-x5' ); ?></p>
				<p><?php esc_html_e( 'Expect an experience that’s calm and organized: a simple plan, clear next steps, and a gallery that reads like a story—wide frames, details, and portraits with presence.', 'nolan-showcase-theme-x5' ); ?></p>
				<p><?php esc_html_e( 'This theme is a demo template. Replace imagery, text, and booking policies with your real business details.', 'nolan-showcase-theme-x5' ); ?></p>

				<ul class="value-list" aria-label="<?php echo esc_attr__( 'Values', 'nolan-showcase-theme-x5' ); ?>">
					<li><strong><?php esc_html_e( 'Clarity', 'nolan-showcase-theme-x5' ); ?></strong><span><?php esc_html_e( 'Simple timelines and next steps.', 'nolan-showcase-theme-x5' ); ?></span></li>
					<li><strong><?php esc_html_e( 'Presence', 'nolan-showcase-theme-x5' ); ?></strong><span><?php esc_html_e( 'Direction that keeps you in the moment.', 'nolan-showcase-theme-x5' ); ?></span></li>
					<li><strong><?php esc_html_e( 'Craft', 'nolan-showcase-theme-x5' ); ?></strong><span><?php esc_html_e( 'Intentional edit and color finishing.', 'nolan-showcase-theme-x5' ); ?></span></li>
				</ul>

				<div class="about-actions">
					<a class="button button-primary" href="#contact"><?php esc_html_e( 'Book a Session', 'nolan-showcase-theme-x5' ); ?></a>
					<a class="button button-secondary" href="#portfolio"><?php esc_html_e( 'See the work', 'nolan-showcase-theme-x5' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="section proof-band" aria-label="<?php echo esc_attr__( 'Proof points', 'nolan-showcase-theme-x5' ); ?>">
		<div class="container proof-grid">
			<div class="proof-card reveal">
				<p class="eyebrow"><?php esc_html_e( 'Planning', 'nolan-showcase-theme-x5' ); ?></p>
				<h3><?php esc_html_e( 'A clear plan, not a long questionnaire.', 'nolan-showcase-theme-x5' ); ?></h3>
			</div>
			<div class="proof-card reveal">
				<p class="eyebrow"><?php esc_html_e( 'Direction', 'nolan-showcase-theme-x5' ); ?></p>
				<h3><?php esc_html_e( 'Prompts that create movement and emotion.', 'nolan-showcase-theme-x5' ); ?></h3>
			</div>
			<div class="proof-card reveal">
				<p class="eyebrow"><?php esc_html_e( 'Finish', 'nolan-showcase-theme-x5' ); ?></p>
				<h3><?php esc_html_e( 'Warm color and cinematic contrast—kept natural.', 'nolan-showcase-theme-x5' ); ?></h3>
			</div>
			<div class="proof-card reveal">
				<p class="eyebrow"><?php esc_html_e( 'Delivery', 'nolan-showcase-theme-x5' ); ?></p>
				<h3><?php esc_html_e( 'A private gallery built to share and archive.', 'nolan-showcase-theme-x5' ); ?></h3>
			</div>
		</div>
	</section>

	<section class="section section-ink" aria-labelledby="testimonials-heading">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Testimonials', 'nolan-showcase-theme-x5' ); ?></p>
				<h2 id="testimonials-heading"><?php esc_html_e( 'Quiet luxury is a feeling—and the reviews describe it best.', 'nolan-showcase-theme-x5' ); ?></h2>
			</div>
			<div class="testimonial-grid">
				<?php foreach ( $testimonials as $t ) : ?>
					<figure class="testimonial-card reveal">
						<blockquote><p><?php echo esc_html( $t['quote'] ); ?></p></blockquote>
						<figcaption><?php echo esc_html( $t['name'] ); ?></figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section" aria-labelledby="investment-heading">
		<div class="container investment-grid">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Investment', 'nolan-showcase-theme-x5' ); ?></p>
				<h2 id="investment-heading"><?php esc_html_e( 'Collections are tailored—based on timing, coverage, and creative scope.', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'No placeholder pricing here. Share your date, city, and what you’re creating, and we’ll recommend a collection.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>
			<div class="investment-cards">
				<article class="investment-card reveal">
					<h3><?php esc_html_e( 'What to include in your note', 'nolan-showcase-theme-x5' ); ?></h3>
					<ul class="rule-list">
						<li><?php esc_html_e( 'Date + location (or a few options).', 'nolan-showcase-theme-x5' ); ?></li>
						<li><?php esc_html_e( 'Type of session and approximate timing.', 'nolan-showcase-theme-x5' ); ?></li>
						<li><?php esc_html_e( 'Any must-have moments or deliverable needs.', 'nolan-showcase-theme-x5' ); ?></li>
					</ul>
				</article>
				<article class="investment-card reveal">
					<h3><?php esc_html_e( 'What you’ll get back', 'nolan-showcase-theme-x5' ); ?></h3>
					<ul class="rule-list">
						<li><?php esc_html_e( 'A simple plan with next steps.', 'nolan-showcase-theme-x5' ); ?></li>
						<li><?php esc_html_e( 'A recommended collection for your scope.', 'nolan-showcase-theme-x5' ); ?></li>
						<li><?php esc_html_e( 'A calm, art-directed shoot experience.', 'nolan-showcase-theme-x5' ); ?></li>
					</ul>
				</article>
			</div>
		</div>
	</section>

	<section class="section section-ink" aria-labelledby="faq-heading">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'FAQ', 'nolan-showcase-theme-x5' ); ?></p>
				<h2 id="faq-heading"><?php esc_html_e( 'Answers, before you ask.', 'nolan-showcase-theme-x5' ); ?></h2>
			</div>
			<div class="faq-grid">
				<?php foreach ( $faqs as $faq ) : ?>
					<details class="faq-item reveal">
						<summary><?php echo esc_html( $faq[0] ); ?></summary>
						<div class="faq-body">
							<p><?php echo esc_html( $faq[1] ); ?></p>
						</div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section" aria-labelledby="journal-heading">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Journal', 'nolan-showcase-theme-x5' ); ?></p>
				<h2 id="journal-heading"><?php esc_html_e( 'Latest posts', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'In WordPress, publish posts to populate this section automatically.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>

			<div class="post-grid">
				<?php if ( $journal_query->have_posts() ) : ?>
					<?php
					while ( $journal_query->have_posts() ) :
						$journal_query->the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					endwhile;
					?>
				<?php else : ?>
					<article class="post-card reveal">
						<p class="eyebrow"><?php esc_html_e( 'No posts yet', 'nolan-showcase-theme-x5' ); ?></p>
						<h3><?php esc_html_e( 'Publish your first journal entry', 'nolan-showcase-theme-x5' ); ?></h3>
						<p><?php esc_html_e( 'Use posts to share session tips, location notes, and behind-the-scenes stories.', 'nolan-showcase-theme-x5' ); ?></p>
					</article>
					<article class="post-card reveal">
						<p class="eyebrow"><?php esc_html_e( 'Idea', 'nolan-showcase-theme-x5' ); ?></p>
						<h3><?php esc_html_e( 'What to wear for warm-luxury portraits', 'nolan-showcase-theme-x5' ); ?></h3>
						<p><?php esc_html_e( 'Textures, neutrals, and movement—style guidance that photographs timelessly.', 'nolan-showcase-theme-x5' ); ?></p>
					</article>
					<article class="post-card reveal">
						<p class="eyebrow"><?php esc_html_e( 'Idea', 'nolan-showcase-theme-x5' ); ?></p>
						<h3><?php esc_html_e( 'How we plan light for an editorial set', 'nolan-showcase-theme-x5' ); ?></h3>
						<p><?php esc_html_e( 'A simple approach: choose the mood, then let the light lead.', 'nolan-showcase-theme-x5' ); ?></p>
					</article>
				<?php endif; ?>
			</div>

			<?php wp_reset_postdata(); ?>
		</div>
	</section>

	<section id="contact" class="section final-cta">
		<div class="container final-cta-grid">
			<div class="final-cta-copy reveal">
				<p class="eyebrow"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x5' ); ?></p>
				<h2><?php esc_html_e( 'Ready for images that feel like a film still?', 'nolan-showcase-theme-x5' ); ?></h2>
				<p class="section-lead"><?php esc_html_e( 'Send a note with your date and the mood you want. We’ll reply with next steps and a recommended collection.', 'nolan-showcase-theme-x5' ); ?></p>
				<div class="hero-actions">
					<a class="button button-primary" href="<?php echo esc_url( 'mailto:hello@mnyphoto.example' ); ?>"><?php esc_html_e( 'Email hello@mnyphoto.example', 'nolan-showcase-theme-x5' ); ?></a>
					<a class="button button-secondary" href="#portfolio"><?php esc_html_e( 'Review the work', 'nolan-showcase-theme-x5' ); ?></a>
				</div>
				<p class="hero-micro"><?php esc_html_e( 'Demo address used for theme preview. Replace with your real inquiry email.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>

			<div class="final-cta-card reveal">
				<h3><?php esc_html_e( 'Inquiry checklist', 'nolan-showcase-theme-x5' ); ?></h3>
				<ul class="rule-list">
					<li><?php esc_html_e( 'Date + city', 'nolan-showcase-theme-x5' ); ?></li>
					<li><?php esc_html_e( 'Session type (wedding, branding, couple, family, event)', 'nolan-showcase-theme-x5' ); ?></li>
					<li><?php esc_html_e( 'A sentence about the mood (classic, modern, intimate, bold)', 'nolan-showcase-theme-x5' ); ?></li>
					<li><?php esc_html_e( 'Any constraints (timeline, access, privacy)', 'nolan-showcase-theme-x5' ); ?></li>
				</ul>
				<p class="cta-note"><?php esc_html_e( 'If you prefer a form, add a contact form plugin and place it here.', 'nolan-showcase-theme-x5' ); ?></p>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
