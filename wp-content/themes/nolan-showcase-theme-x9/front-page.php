<?php
/**
 * Front page template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();

$work_url      = esc_url( home_url( '/work/' ) );
$contact_url   = esc_url( home_url( '/contact/' ) );
$who_url       = esc_url( home_url( '/who-we-are/' ) );
$services_url  = esc_url( home_url( '/what-we-do/' ) );
$resources_url = esc_url( home_url( '/resources/' ) );
?>

<section class="hero">
	<div class="container hero__grid">
		<div class="hero__copy" data-reveal>
			<p class="hero__kicker"><?php esc_html_e( 'MNY Photo — NYC + travel', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="hero__title"><?php esc_html_e( 'Cinematic photography for people, brands, and unforgettable moments.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="hero__subtitle"><?php echo wp_kses_post( __( 'Warm, editorial images with calm direction and a print-first finish. We build galleries that feel like a story — not a photoshoot.', 'nolan-showcase-theme-x9' ) ); ?></p>
			<div class="hero__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="<?php echo $work_url; ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
			<ul class="hero__trust" aria-label="<?php echo esc_attr_x( 'Trust tags', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
				<li><?php esc_html_e( 'Editorial direction', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php esc_html_e( 'Natural skin tones', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php esc_html_e( 'Print-ready delivery', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php esc_html_e( '48-hour sneak peek option', 'nolan-showcase-theme-x9' ); ?></li>
			</ul>
		</div>

		<div class="hero__media" data-reveal>
			<div class="hero__image-stack" aria-hidden="true">
				<img class="hero__img hero__img--primary" src="<?php echo nolan_x9_asset( 'assets/images/hero-portrait-01.jpg' ); ?>" width="980" height="1240" alt="" loading="eager" decoding="async">
				<img class="hero__img hero__img--secondary" src="<?php echo nolan_x9_asset( 'assets/images/hero-couple-01.jpg' ); ?>" width="780" height="520" alt="" loading="eager" decoding="async">
				<img class="hero__img hero__img--tertiary" src="<?php echo nolan_x9_asset( 'assets/images/hero-brand-01.jpg' ); ?>" width="780" height="520" alt="" loading="eager" decoding="async">
			</div>
		</div>
	</div>
</section>

<section class="section section--statement">
	<div class="container">
		<div class="statement" data-reveal>
			<h2 class="statement__title"><?php esc_html_e( 'Photography that feels editorial — and still completely you.', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="statement__copy"><?php echo wp_kses_post( __( 'MNY Photo blends documentary observation with refined portrait direction. We plan around light, movement, and story — then keep the session day simple so you can be present.', 'nolan-showcase-theme-x9' ) ); ?></p>
			<div class="statement__meta">
				<div class="pill"><?php esc_html_e( 'People-first pacing', 'nolan-showcase-theme-x9' ); ?></div>
				<div class="pill"><?php esc_html_e( 'Warm, polished edit', 'nolan-showcase-theme-x9' ); ?></div>
				<div class="pill"><?php esc_html_e( 'Designed for web + print', 'nolan-showcase-theme-x9' ); ?></div>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Portfolio preview', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Eight story-driven sets — each designed around a different kind of moment.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--portfolio">
			<?php
			$portfolio_cards = array(
				array( 'title' => __( 'Editorial Portrait', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-portrait-01.jpg', 'meta' => __( 'Studio + street light', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Wedding Story', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-wedding-01.jpg', 'meta' => __( 'Documentary + portraits', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Brand Campaign', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-brand-01.jpg', 'meta' => __( 'Launch-ready set', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Event Coverage', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-event-01.jpg', 'meta' => __( 'Candid energy', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Product Detail', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-product-01.jpg', 'meta' => __( 'Warm, tactile stills', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Family Lifestyle', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-family-01.jpg', 'meta' => __( 'Natural connection', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Black & White Study', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-bw-01.jpg', 'meta' => __( 'Print-first contrast', 'nolan-showcase-theme-x9' ) ),
				array( 'title' => __( 'Couple Session', 'nolan-showcase-theme-x9' ), 'img' => 'portfolio-couple-01.jpg', 'meta' => __( 'Quiet romance', 'nolan-showcase-theme-x9' ) ),
			);

			foreach ( $portfolio_cards as $card ) :
				?>
				<article class="card card--image" data-reveal>
					<img class="card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $card['img'] ); ?>" width="960" height="640" alt="" loading="lazy" decoding="async">
					<div class="card__overlay">
						<h3 class="card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="card__meta"><?php echo esc_html( $card['meta'] ); ?></p>
					</div>
				</article>
				<?php
			endforeach;
			?>
		</div>

		<div class="section-actions" data-reveal>
			<a class="btn btn-secondary" href="<?php echo $work_url; ?>"><?php esc_html_e( 'Explore the full portfolio', 'nolan-showcase-theme-x9' ); ?></a>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'A small menu, delivered with big intention.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--services">
			<?php
			$services = array(
				array( 'title' => __( 'Portrait Sessions', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Modern headshots and editorial portraits with calm direction.', 'nolan-showcase-theme-x9' ), 'img' => 'service-portrait-01.jpg' ),
				array( 'title' => __( 'Weddings & Engagements', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Documentary coverage with refined portraits that feel effortless.', 'nolan-showcase-theme-x9' ), 'img' => 'service-wedding-01.jpg' ),
				array( 'title' => __( 'Events & Celebrations', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Candid energy, flattering light, and detail coverage for fast days.', 'nolan-showcase-theme-x9' ), 'img' => 'service-event-01.jpg' ),
				array( 'title' => __( 'Brand Photography', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Campaign sets and evergreen visuals designed for performance.', 'nolan-showcase-theme-x9' ), 'img' => 'service-brand-01.jpg' ),
				array( 'title' => __( 'Product & Detail', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Warm, crisp still life images built for ecommerce and lookbooks.', 'nolan-showcase-theme-x9' ), 'img' => 'service-product-01.jpg' ),
				array( 'title' => __( 'Lifestyle & Family', 'nolan-showcase-theme-x9' ), 'desc' => __( 'Natural moments photographed with editorial composition.', 'nolan-showcase-theme-x9' ), 'img' => 'service-family-01.jpg' ),
			);

			foreach ( $services as $service ) :
				?>
				<article class="service-card" data-reveal>
					<img class="service-card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $service['img'] ); ?>" width="800" height="560" alt="" loading="lazy" decoding="async">
					<div class="service-card__body">
						<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
						<p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>
					</div>
				</article>
				<?php
			endforeach;
			?>
		</div>

		<div class="section-actions" data-reveal>
			<a class="btn btn-primary" href="<?php echo $services_url; ?>"><?php esc_html_e( 'What we do (full guide)', 'nolan-showcase-theme-x9' ); ?></a>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'The process', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'A clear path from inquiry to gallery delivery — built to keep you relaxed.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<ol class="steps" aria-label="<?php echo esc_attr_x( 'Process steps', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
			<li class="step" data-reveal>
				<h3 class="step__title"><?php esc_html_e( 'Inquiry', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="step__desc"><?php esc_html_e( 'Share your date/timeframe, goals, and the kind of images you need. We respond with next steps and availability.', 'nolan-showcase-theme-x9' ); ?></p>
			</li>
			<li class="step" data-reveal>
				<h3 class="step__title"><?php esc_html_e( 'Creative direction', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="step__desc"><?php esc_html_e( 'We align on mood, locations, and styling. You get a simple plan: what to bring, what to expect, and how we’ll shoot.', 'nolan-showcase-theme-x9' ); ?></p>
			</li>
			<li class="step" data-reveal>
				<h3 class="step__title"><?php esc_html_e( 'Session day', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="step__desc"><?php esc_html_e( 'You’ll be guided with easy prompts and clear direction. We keep the energy steady and the pacing comfortable.', 'nolan-showcase-theme-x9' ); ?></p>
			</li>
			<li class="step" data-reveal>
				<h3 class="step__title"><?php esc_html_e( 'Editing', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="step__desc"><?php esc_html_e( 'Warm, polished color, true skin tones, and consistency across the full story. Every gallery is curated with intention.', 'nolan-showcase-theme-x9' ); ?></p>
			</li>
			<li class="step" data-reveal>
				<h3 class="step__title"><?php esc_html_e( 'Gallery delivery', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="step__desc"><?php esc_html_e( 'You receive a shareable gallery with print-ready downloads, favorites tools, and guidance for albums and wall art.', 'nolan-showcase-theme-x9' ); ?></p>
			</li>
		</ol>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<div class="pillars" data-reveal>
			<div class="pillars__copy">
				<h2 class="section-title"><?php esc_html_e( 'Signature style pillars', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'A consistent look that stays timeless — with room for your personality.', 'nolan-showcase-theme-x9' ); ?></p>
				<ul class="pillars__list">
					<li><?php esc_html_e( 'Cinematic light', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Natural direction', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Editorial composition', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Warm, polished editing', 'nolan-showcase-theme-x9' ); ?></li>
				</ul>
				<a class="btn btn-ghost" href="<?php echo $who_url; ?>"><?php esc_html_e( 'Who we are', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
			<div class="pillars__media" aria-hidden="true">
				<img src="<?php echo nolan_x9_asset( 'assets/images/about-approach-01.jpg' ); ?>" width="960" height="720" alt="" loading="lazy" decoding="async">
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="about-preview" data-reveal>
			<div class="about-preview__media" aria-hidden="true">
				<img src="<?php echo nolan_x9_asset( 'assets/images/about-studio-01.jpg' ); ?>" width="960" height="720" alt="" loading="lazy" decoding="async">
			</div>
			<div class="about-preview__copy">
				<h2 class="section-title"><?php esc_html_e( 'A small studio built for calm, confident sessions.', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'We keep sets light and direction clear — so your images feel natural, elevated, and deeply personal.', 'nolan-showcase-theme-x9' ); ?></p>
				<ul class="checklist">
					<li><?php esc_html_e( 'Pre-session planning with mood + shot flow', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Location + wardrobe guidance that actually helps', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Editing that respects skin and light', 'nolan-showcase-theme-x9' ); ?></li>
				</ul>
				<div class="about-preview__actions">
					<a class="btn btn-secondary" href="<?php echo $who_url; ?>"><?php esc_html_e( 'Meet MNY Photo', 'nolan-showcase-theme-x9' ); ?></a>
					<a class="btn btn-text" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Start an inquiry →', 'nolan-showcase-theme-x9' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--band">
	<div class="container">
		<div class="stats" data-reveal>
			<div class="stat">
				<p class="stat__num"><?php esc_html_e( '6+', 'nolan-showcase-theme-x9' ); ?></p>
				<p class="stat__label"><?php esc_html_e( 'session styles', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="stat">
				<p class="stat__num"><?php esc_html_e( '48h', 'nolan-showcase-theme-x9' ); ?></p>
				<p class="stat__label"><?php esc_html_e( 'sneak peek option', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="stat">
				<p class="stat__num"><?php esc_html_e( '100%', 'nolan-showcase-theme-x9' ); ?></p>
				<p class="stat__label"><?php esc_html_e( 'custom planning', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="stat">
				<p class="stat__num"><?php esc_html_e( 'Print', 'nolan-showcase-theme-x9' ); ?></p>
				<p class="stat__label"><?php esc_html_e( 'ready delivery', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Testimonials', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Realistic words from fictional clients — the kind we’re proud to earn.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--testimonials">
			<figure class="quote" data-reveal>
				<blockquote class="quote__text"><?php esc_html_e( '“The direction was so clear that we forgot we were being photographed. The gallery feels like a short film.”', 'nolan-showcase-theme-x9' ); ?></blockquote>
				<figcaption class="quote__meta"><?php esc_html_e( 'Amira + Luca — engagement session', 'nolan-showcase-theme-x9' ); ?></figcaption>
			</figure>
			<figure class="quote" data-reveal>
				<blockquote class="quote__text"><?php esc_html_e( '“Our brand images finally match our product quality. The shots are warm, clean, and ridiculously usable.”', 'nolan-showcase-theme-x9' ); ?></blockquote>
				<figcaption class="quote__meta"><?php esc_html_e( 'Jules — founder, studio retail', 'nolan-showcase-theme-x9' ); ?></figcaption>
			</figure>
			<figure class="quote" data-reveal>
				<blockquote class="quote__text"><?php esc_html_e( '“We got candid moments we didn’t even know happened — and portraits that look like they belong in print.”', 'nolan-showcase-theme-x9' ); ?></blockquote>
				<figcaption class="quote__meta"><?php esc_html_e( 'Mina — wedding coverage', 'nolan-showcase-theme-x9' ); ?></figcaption>
			</figure>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<div class="pricing" data-reveal>
			<div class="pricing__copy">
				<h2 class="section-title"><?php esc_html_e( 'Booking + investment', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Pricing is shaped by time, complexity, and usage — not a one-size menu.', 'nolan-showcase-theme-x9' ); ?></p>
				<ul class="checklist">
					<li><?php esc_html_e( 'Session length + number of locations', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Creative direction + shot count', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Event coverage timing and deliverables', 'nolan-showcase-theme-x9' ); ?></li>
					<li><?php esc_html_e( 'Commercial usage (web, press, ads)', 'nolan-showcase-theme-x9' ); ?></li>
				</ul>
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Request availability', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
			<div class="pricing__media" aria-hidden="true">
				<img src="<?php echo nolan_x9_asset( 'assets/images/portfolio-product-01.jpg' ); ?>" width="960" height="720" alt="" loading="lazy" decoding="async">
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'FAQ', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Quick answers to common questions.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="faq" data-reveal>
			<details>
				<summary><?php esc_html_e( 'Do you help with poses?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'Yes — we direct with simple prompts and small adjustments so you look natural. Think guided movement, not stiff posing.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
			<details>
				<summary><?php esc_html_e( 'How do we choose a location?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'We start with your vibe and how you’ll use the images, then pick places that match the light. You’ll get 2–3 options with timing recommendations.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
			<details>
				<summary><?php esc_html_e( 'When do we get our gallery?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'Turnaround depends on the project size. You’ll always receive a clear delivery window before we shoot, with an optional 48-hour sneak peek for select sessions.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
			<details>
				<summary><?php esc_html_e( 'Do you deliver black & white versions?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'Absolutely. We include black & white conversions when they strengthen the story — not as an afterthought.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Guides for planning a session, choosing looks, and using your gallery well.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--resources">
			<?php
			$resource_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'ignore_sticky_posts' => true,
				)
			);

			if ( $resource_query->have_posts() ) {
				while ( $resource_query->have_posts() ) {
					$resource_query->the_post();
					?>
					<article <?php post_class( 'resource-card' ); ?> data-reveal>
						<h3 class="resource-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="resource-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<p class="resource-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<a class="btn btn-text" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article →', 'nolan-showcase-theme-x9' ); ?></a>
					</article>
					<?php
				}
				wp_reset_postdata();
			} else {
				$fallback_resources = array(
					array( 'title' => __( 'Wardrobe guide for warm neutrals', 'nolan-showcase-theme-x9' ), 'img' => 'resource-wardrobe-01.jpg', 'kicker' => __( 'Planning', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Light-first location scouting in the city', 'nolan-showcase-theme-x9' ), 'img' => 'resource-location-01.jpg', 'kicker' => __( 'Locations', 'nolan-showcase-theme-x9' ) ),
					array( 'title' => __( 'Print-ready delivery (what to expect)', 'nolan-showcase-theme-x9' ), 'img' => 'resource-print-01.jpg', 'kicker' => __( 'Delivery', 'nolan-showcase-theme-x9' ) ),
				);
				foreach ( $fallback_resources as $res ) :
					?>
					<article class="resource-card resource-card--image" data-reveal>
						<img class="resource-card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $res['img'] ); ?>" width="720" height="520" alt="" loading="lazy" decoding="async">
						<p class="resource-card__kicker"><?php echo esc_html( $res['kicker'] ); ?></p>
						<h3 class="resource-card__title"><?php echo esc_html( $res['title'] ); ?></h3>
						<a class="btn btn-text" href="<?php echo $resources_url; ?>"><?php esc_html_e( 'View resources →', 'nolan-showcase-theme-x9' ); ?></a>
					</article>
					<?php
				endforeach;
			}
			?>
		</div>

		<div class="section-actions" data-reveal>
			<a class="btn btn-secondary" href="<?php echo $resources_url; ?>"><?php esc_html_e( 'Browse all resources', 'nolan-showcase-theme-x9' ); ?></a>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'Ready to create images you’ll actually use?', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Tell us what you’re planning — we’ll recommend timing, locations, and the right session structure for your goals.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo $work_url; ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

