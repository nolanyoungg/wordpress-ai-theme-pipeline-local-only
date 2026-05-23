<?php
/**
 * Front page template.
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();

$portfolio_items = array(
	array(
		'title'   => __( 'Wedding, slow cinema', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Glances, movement, and light you can feel.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-wedding-moment.svg',
		'tags'    => array( 'wedding' ),
		'layout'  => 'wide',
	),
	array(
		'title'   => __( 'Branding with restraint', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Editorial portraits built for premium websites.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-branding-session.svg',
		'tags'    => array( 'branding' ),
		'layout'  => 'tall',
	),
	array(
		'title'   => __( 'Event coverage, elevated', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Candid moments with intentional framing.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-event-coverage.svg',
		'tags'    => array( 'event' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Product detail, cinematic', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Soft highlights, precise textures, rich contrast.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-product-detail.svg',
		'tags'    => array( 'product' ),
		'layout'  => 'wide',
	),
	array(
		'title'   => __( 'Family lifestyle, quiet', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Warm motion with space to breathe.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-family-lifestyle.svg',
		'tags'    => array( 'family' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Black + white editorial', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Shape, shadow, and timeless composition.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-black-white-portrait.svg',
		'tags'    => array( 'portrait' ),
		'layout'  => 'tall',
	),
	array(
		'title'   => __( 'Couple session, story-led', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'A narrative set—directed, never stiff.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-couple-session.svg',
		'tags'    => array( 'couple' ),
		'layout'  => 'square',
	),
	array(
		'title'   => __( 'Commercial campaign', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Clean art direction with cinematic mood.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-commercial-campaign.svg',
		'tags'    => array( 'branding' ),
		'layout'  => 'wide',
	),
	array(
		'title'   => __( 'Studio session', 'nolan-showcase-theme-x6' ),
		'caption' => __( 'Soft shadows and editorial stillness.', 'nolan-showcase-theme-x6' ),
		'image'   => 'gallery-studio-session.svg',
		'tags'    => array( 'portrait' ),
		'layout'  => 'tall',
	),
);

$services = array(
	array(
		'title' => __( 'Weddings', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Cinematic coverage with editorial pacing—built around moments, not a shot list.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Timeline collaboration', 'nolan-showcase-theme-x6' ), __( 'Natural direction', 'nolan-showcase-theme-x6' ), __( 'Gallery delivery', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Brand Sessions', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Premium portraits and detail frames designed for web, press, and launches.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Moodboard + styling notes', 'nolan-showcase-theme-x6' ), __( 'Usage-minded framing', 'nolan-showcase-theme-x6' ), __( 'On-brand delivery', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Couples', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'A relaxed, art-directed set with movement prompts and timeless composition.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Editorial prompts', 'nolan-showcase-theme-x6' ), __( 'Golden-hour planning', 'nolan-showcase-theme-x6' ), __( 'Multiple looks', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Events', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Brand launches, dinners, and celebrations with discreet coverage and clean frames.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Guest candids', 'nolan-showcase-theme-x6' ), __( 'Speaker + detail coverage', 'nolan-showcase-theme-x6' ), __( 'Fast highlight selects', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Product / Detail', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Cinematic product sets with rich texture and controlled highlights.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Consistent lighting', 'nolan-showcase-theme-x6' ), __( 'Macro texture frames', 'nolan-showcase-theme-x6' ), __( 'Usage-aware crops', 'nolan-showcase-theme-x6' ) ),
	),
);

$process_steps = array(
	array( __( 'Inquiry', 'nolan-showcase-theme-x6' ), __( 'Send a note with date + location. We’ll confirm availability and align on intention.', 'nolan-showcase-theme-x6' ) ),
	array( __( 'Creative direction', 'nolan-showcase-theme-x6' ), __( 'A simple plan: wardrobe guidance, pacing, and a calm shot framework.', 'nolan-showcase-theme-x6' ) ),
	array( __( 'Shoot day', 'nolan-showcase-theme-x6' ), __( 'Guided direction—never stiff. Clean frames with space to breathe.', 'nolan-showcase-theme-x6' ) ),
	array( __( 'Edit + tone', 'nolan-showcase-theme-x6' ), __( 'Warm ivory highlights and cinematic contrast with true skin tones.', 'nolan-showcase-theme-x6' ) ),
	array( __( 'Delivery', 'nolan-showcase-theme-x6' ), __( 'A private gallery designed for sharing, archiving, and revisiting.', 'nolan-showcase-theme-x6' ) ),
);

$testimonials = array(
	array(
		'quote' => __( '“The session felt effortless. The images are editorial but still us—warm, honest, and elevated.”', 'nolan-showcase-theme-x6' ),
		'name'  => __( 'Client, Couples Session', 'nolan-showcase-theme-x6' ),
	),
	array(
		'quote' => __( '“Our brand launch finally has visuals that match the site. Texture, tone, and pacing are perfect.”', 'nolan-showcase-theme-x6' ),
		'name'  => __( 'Founder, Studio Brand', 'nolan-showcase-theme-x6' ),
	),
	array(
		'quote' => __( '“Quiet luxury in photo form. The gallery reads like a story.”', 'nolan-showcase-theme-x6' ),
		'name'  => __( 'Client, Wedding', 'nolan-showcase-theme-x6' ),
	),
);

$faqs = array(
	array(
		__( 'Do you help with posing?', 'nolan-showcase-theme-x6' ),
		__( 'Yes—through editorial direction. You’ll get simple movement prompts and refinements that keep expressions real.', 'nolan-showcase-theme-x6' ),
	),
	array(
		__( 'What should we wear?', 'nolan-showcase-theme-x6' ),
		__( 'After booking, you’ll receive a styling guide with color palettes, texture notes, and timeless examples.', 'nolan-showcase-theme-x6' ),
	),
	array(
		__( 'How do we choose a location?', 'nolan-showcase-theme-x6' ),
		__( 'We choose based on light, mood, and comfort. Indoor options are always on the table.', 'nolan-showcase-theme-x6' ),
	),
	array(
		__( 'Can you travel?', 'nolan-showcase-theme-x6' ),
		__( 'Yes—travel is available by request. Share your city and date, and we’ll confirm timing and feasibility.', 'nolan-showcase-theme-x6' ),
	),
);
?>

<main id="main-content" class="site-main">
	<?php get_template_part( 'template-parts/section', 'hero' ); ?>

	<section class="section section--ink" id="statement">
		<div class="container statement-grid">
			<div class="reveal">
				<p class="kicker"><?php esc_html_e( 'Brand statement', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'An art-directed approach—so the final gallery feels cohesive, elevated, and unmistakably you.', 'nolan-showcase-theme-x6' ); ?></h2>
			</div>
			<div class="statement-card reveal">
				<p><?php esc_html_e( 'MNY Photo works like an editorial team: we shape the mood, simplify the plan, and photograph what matters. The result is timeless imagery with cinematic depth—built for real life, not performance.', 'nolan-showcase-theme-x6' ); ?></p>
				<ul class="rule-list" aria-label="<?php echo esc_attr__( 'Approach', 'nolan-showcase-theme-x6' ); ?>">
					<li><?php esc_html_e( 'Natural direction and clean composition.', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'Warm color, honest texture, minimal distractions.', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'A gallery that reads like a story.', 'nolan-showcase-theme-x6' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<?php
	set_query_var( 'nolan_showcase_x6_portfolio_items', $portfolio_items );
	get_template_part( 'template-parts/section', 'portfolio-preview' );
	?>

	<?php
	set_query_var( 'nolan_showcase_x6_services', $services );
	get_template_part( 'template-parts/section', 'services-preview' );
	?>

	<section class="section" id="style-pillars">
		<div class="container">
			<header class="section-head reveal">
				<p class="kicker"><?php esc_html_e( 'Signature style', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'Modern editorial with cinematic restraint.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p class="section-lede"><?php esc_html_e( 'A few quiet rules we keep so the work feels timeless.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>
			<div class="pillar-grid">
				<article class="pillar-card reveal"><h3><?php esc_html_e( 'Light-first', 'nolan-showcase-theme-x6' ); ?></h3><p><?php esc_html_e( 'We photograph what the light is already doing—then refine.', 'nolan-showcase-theme-x6' ); ?></p></article>
				<article class="pillar-card reveal"><h3><?php esc_html_e( 'Editorial pacing', 'nolan-showcase-theme-x6' ); ?></h3><p><?php esc_html_e( 'Images read like a story: wide, detail, portrait, breath.', 'nolan-showcase-theme-x6' ); ?></p></article>
				<article class="pillar-card reveal"><h3><?php esc_html_e( 'Gentle direction', 'nolan-showcase-theme-x6' ); ?></h3><p><?php esc_html_e( 'Clear prompts that keep you present—never posed to exhaustion.', 'nolan-showcase-theme-x6' ); ?></p></article>
				<article class="pillar-card reveal"><h3><?php esc_html_e( 'Warm-luxury finish', 'nolan-showcase-theme-x6' ); ?></h3><p><?php esc_html_e( 'Ivory highlights, soft shadows, rich midtones.', 'nolan-showcase-theme-x6' ); ?></p></article>
			</div>
		</div>
	</section>

	<?php
	set_query_var( 'nolan_showcase_x6_process_steps', $process_steps );
	get_template_part( 'template-parts/section', 'process' );
	?>

	<section class="section section--ink" id="about-preview">
		<div class="container about-grid">
			<div class="about-copy reveal">
				<p class="kicker"><?php esc_html_e( 'Who we are', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'A small studio with a big respect for quiet moments.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p><?php esc_html_e( 'MNY Photo blends documentary honesty with editorial polish. We work quickly, calmly, and with a light hand—so the photos feel like you, at your best.', 'nolan-showcase-theme-x6' ); ?></p>
				<div class="cluster">
					<a class="button button--secondary" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Meet the team', 'nolan-showcase-theme-x6' ); ?></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'See recent work', 'nolan-showcase-theme-x6' ); ?></a>
				</div>
			</div>
			<div class="about-visual reveal">
				<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'about-photographer.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Illustration of a photographer', 'nolan-showcase-theme-x6' ); ?>">
			</div>
		</div>
	</section>

	<section class="section" id="collections">
		<div class="container">
			<header class="section-head reveal">
				<p class="kicker"><?php esc_html_e( 'Collections', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'Collections that feel editorial—without the chaos.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p class="section-lede"><?php esc_html_e( 'Use these as a starting point; everything is tailored after inquiry.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>
			<div class="pricing-grid">
				<article class="pricing-card reveal">
					<h3><?php esc_html_e( 'Essentials', 'nolan-showcase-theme-x6' ); ?></h3>
					<p class="price"><?php esc_html_e( 'Starting at $1,250', 'nolan-showcase-theme-x6' ); ?></p>
					<ul class="check-list">
						<li><?php esc_html_e( 'Planning call + direction', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( '90 minutes coverage', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( 'Online gallery delivery', 'nolan-showcase-theme-x6' ); ?></li>
					</ul>
					<a class="button button--primary button--full" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Check availability', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
				<article class="pricing-card reveal">
					<h3><?php esc_html_e( 'Signature', 'nolan-showcase-theme-x6' ); ?></h3>
					<p class="price"><?php esc_html_e( 'Starting at $2,400', 'nolan-showcase-theme-x6' ); ?></p>
					<ul class="check-list">
						<li><?php esc_html_e( 'Creative direction + styling notes', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( 'Half-day coverage', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( 'Editorial retouching', 'nolan-showcase-theme-x6' ); ?></li>
					</ul>
					<a class="button button--secondary button--full" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request collections', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
				<article class="pricing-card reveal">
					<h3><?php esc_html_e( 'Studio / Campaign', 'nolan-showcase-theme-x6' ); ?></h3>
					<p class="price"><?php esc_html_e( 'Starting at $3,600', 'nolan-showcase-theme-x6' ); ?></p>
					<ul class="check-list">
						<li><?php esc_html_e( 'Moodboard + shot plan', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( 'Usage-aware image set', 'nolan-showcase-theme-x6' ); ?></li>
						<li><?php esc_html_e( 'Delivery in waves', 'nolan-showcase-theme-x6' ); ?></li>
					</ul>
					<a class="button button--ghost button--full" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'View services', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
			</div>
		</div>
	</section>

	<?php
	set_query_var( 'nolan_showcase_x6_testimonials', $testimonials );
	get_template_part( 'template-parts/section', 'testimonials' );
	?>

	<section class="section" id="press">
		<div class="container">
			<header class="section-head reveal">
				<p class="kicker"><?php esc_html_e( 'Press + partners', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'A studio built for premium brands and intimate celebrations.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p class="section-lede"><?php esc_html_e( 'We collaborate with planners, designers, and founders to create imagery that matches the room and the website.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>
			<div class="logo-grid reveal" aria-label="<?php echo esc_attr__( 'Partner marks', 'nolan-showcase-theme-x6' ); ?>">
				<span class="logo-pill">Atelier</span>
				<span class="logo-pill">Harbor Studio</span>
				<span class="logo-pill">Stone &amp; Silk</span>
				<span class="logo-pill">Candlelight Co.</span>
				<span class="logo-pill">Modern Bloom</span>
				<span class="logo-pill">Gallery No. 7</span>
			</div>
			<p class="center-text reveal">
				<a class="button button--ghost" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Explore services', 'nolan-showcase-theme-x6' ); ?></a>
			</p>
		</div>
	</section>

	<section class="section" id="faq">
		<div class="container">
			<header class="section-head reveal">
				<p class="kicker"><?php esc_html_e( 'Questions', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'A few quick answers.', 'nolan-showcase-theme-x6' ); ?></h2>
			</header>
			<div class="faq-grid">
				<?php foreach ( $faqs as $faq ) : ?>
					<details class="faq-item reveal">
						<summary><?php echo esc_html( $faq[0] ); ?></summary>
						<div class="faq-body"><p><?php echo esc_html( $faq[1] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
			<p class="center-text reveal">
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Read resources', 'nolan-showcase-theme-x6' ); ?></a>
			</p>
		</div>
	</section>

	<section class="section section--ink" id="resources-preview">
		<div class="container">
			<header class="section-head reveal">
				<p class="kicker"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'Guides that keep planning simple.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p class="section-lede"><?php esc_html_e( 'Short reads to help you choose locations, wardrobe, and pacing—without the overwhelm.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>
			<div class="resource-grid">
				<article class="resource-card reveal">
					<h3><?php esc_html_e( 'Wardrobe + texture', 'nolan-showcase-theme-x6' ); ?></h3>
					<p><?php esc_html_e( 'Neutral palettes, subtle contrast, and materials that photograph beautifully.', 'nolan-showcase-theme-x6' ); ?></p>
					<a class="text-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Open resources', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
				<article class="resource-card reveal">
					<h3><?php esc_html_e( 'Timeline planning', 'nolan-showcase-theme-x6' ); ?></h3>
					<p><?php esc_html_e( 'Where to place portraits so the day feels calm and the light stays soft.', 'nolan-showcase-theme-x6' ); ?></p>
					<a class="text-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'See the checklist', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
				<article class="resource-card reveal">
					<h3><?php esc_html_e( 'Location selection', 'nolan-showcase-theme-x6' ); ?></h3>
					<p><?php esc_html_e( 'A quick way to choose spaces that match your mood and photograph cleanly.', 'nolan-showcase-theme-x6' ); ?></p>
					<a class="text-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Ask for guidance', 'nolan-showcase-theme-x6' ); ?></a>
				</article>
			</div>
		</div>
	</section>

	<section class="section" id="contact-preview">
		<div class="container contact-preview-grid">
			<div class="contact-copy reveal">
				<p class="kicker"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'Tell us the date and the mood. We’ll build the session around it.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p><?php esc_html_e( 'Share a few details and we’ll reply within 2 business days with next steps and collection options.', 'nolan-showcase-theme-x6' ); ?></p>
				<div class="cluster">
					<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start Your Inquiry', 'nolan-showcase-theme-x6' ); ?></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x6' ); ?></a>
				</div>
				<p class="microcopy">
					<?php
					printf(
						/* translators: %s: email address */
						wp_kses_post( __( 'Prefer email? Write to <a href="mailto:%s">hello@mnyphoto.example</a>.', 'nolan-showcase-theme-x6' ) ),
						esc_attr( 'hello@mnyphoto.example' )
					);
					?>
				</p>
			</div>
			<div class="contact-visual reveal">
				<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'contact-studio-desk.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Studio desk illustration', 'nolan-showcase-theme-x6' ); ?>">
			</div>
		</div>
	</section>

	<section class="section section--ink" id="availability">
		<div class="container availability-grid">
			<div class="reveal">
				<p class="kicker"><?php esc_html_e( 'Availability', 'nolan-showcase-theme-x6' ); ?></p>
				<h2><?php esc_html_e( 'Limited bookings—so each gallery gets full attention.', 'nolan-showcase-theme-x6' ); ?></h2>
				<p><?php esc_html_e( 'We take a limited number of sessions per month to protect quality and turnaround. If your date is soon, mention urgency in your message.', 'nolan-showcase-theme-x6' ); ?></p>
				<div class="cluster">
					<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Check your date', 'nolan-showcase-theme-x6' ); ?></a>
					<a class="button button--secondary" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Read planning guides', 'nolan-showcase-theme-x6' ); ?></a>
				</div>
			</div>
			<div class="availability-card reveal">
				<h3><?php esc_html_e( 'What to include', 'nolan-showcase-theme-x6' ); ?></h3>
				<ul class="check-list">
					<li><?php esc_html_e( 'Date + location', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'Session type (wedding, brand, couples, event)', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'The mood you want the images to feel like', 'nolan-showcase-theme-x6' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<?php get_template_part( 'template-parts/section', 'final-cta' ); ?>
</main>

<?php
get_footer();
