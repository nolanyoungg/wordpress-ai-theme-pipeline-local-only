<?php
/**
 * Header template.
 *
 * @package Nolan_Showcase_Theme_X9
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'nolan-showcase-theme-x9' ); ?></a>

<header class="site-header nolan-header" data-nolan-menu>
	<div class="nolan-header__inner">
		<?php nolan_x9_site_logo_markup(); ?>

		<nav class="nolan-menu" aria-label="<?php echo esc_attr_x( 'Primary navigation', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
			<div class="nolan-menu__nav" role="menubar">
				<div class="nolan-menu__item" role="none">
					<button class="nolan-menu__trigger" type="button"
						data-nolan-menu-trigger="what-we-do"
						aria-expanded="false"
						aria-controls="nolan-panel-what-we-do">
						<?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x9' ); ?>
					</button>
					<a class="nolan-menu__link nolan-menu__link--sr" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>">
						<?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x9' ); ?>
					</a>
				</div>

				<div class="nolan-menu__item" role="none">
					<button class="nolan-menu__trigger" type="button"
						data-nolan-menu-trigger="who-we-are"
						aria-expanded="false"
						aria-controls="nolan-panel-who-we-are">
						<?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x9' ); ?>
					</button>
					<a class="nolan-menu__link nolan-menu__link--sr" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>">
						<?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x9' ); ?>
					</a>
				</div>

				<div class="nolan-menu__item" role="none">
					<a class="nolan-menu__link" href="<?php echo esc_url( home_url( '/work/' ) ); ?>" role="menuitem">
						<?php esc_html_e( 'Work', 'nolan-showcase-theme-x9' ); ?>
					</a>
				</div>

				<div class="nolan-menu__item" role="none">
					<button class="nolan-menu__trigger" type="button"
						data-nolan-menu-trigger="resources"
						aria-expanded="false"
						aria-controls="nolan-panel-resources">
						<?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?>
					</button>
					<a class="nolan-menu__link nolan-menu__link--sr" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>">
						<?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?>
					</a>
				</div>
			</div>

			<div class="nolan-menu__cta">
				<a class="btn btn-primary btn-small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
					<?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?>
				</a>
			</div>

			<div class="nolan-menu__panels">
				<section id="nolan-panel-what-we-do" class="nolan-menu__panel is-hidden" data-nolan-menu-panel="what-we-do" aria-label="<?php echo esc_attr_x( 'What we do panel', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
					<div class="nolan-menu__panel-inner">
						<div class="nolan-menu__rail" role="tablist" aria-label="<?php echo esc_attr_x( 'Services', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
							<button class="nolan-menu__rail-button is-active" type="button" data-nolan-panel-tab="portrait" role="tab" aria-selected="true"><?php esc_html_e( 'Portrait Sessions', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="weddings" role="tab" aria-selected="false"><?php esc_html_e( 'Weddings & Engagements', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="events" role="tab" aria-selected="false"><?php esc_html_e( 'Events & Celebrations', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="brand" role="tab" aria-selected="false"><?php esc_html_e( 'Brand Photography', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="product" role="tab" aria-selected="false"><?php esc_html_e( 'Product & Detail Photography', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="lifestyle" role="tab" aria-selected="false"><?php esc_html_e( 'Lifestyle & Family Sessions', 'nolan-showcase-theme-x9' ); ?></button>
						</div>

						<div class="nolan-menu__content">
							<div class="nolan-menu__panel-content is-active" data-nolan-panel-content="portrait" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-portrait-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Portrait sessions with editorial direction', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'A calm, guided experience built around flattering light, easy prompts, and images that feel like a magazine feature — still unmistakably you.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: founders, creatives, couples', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: wardrobe support + location scouting', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Deliverables: curated gallery + print-ready files', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Explore sessions →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="weddings" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-wedding-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Weddings & engagements — refined, documentary coverage', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Quiet confidence on a fast day. We capture the honest moments and the elevated portraits — with timelines and lighting handled.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: full weekends, city hall, elopements', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: timeline + portrait plan', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Option: 48-hour sneak peek', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'View wedding coverage →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="events" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-event-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Events & celebrations — fast, flattering, candid', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'From brand dinners to milestone parties, we photograph the energy and the details — with people-first storytelling and polished edits.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: launches, birthdays, galas', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: candid + editorial portraits', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Delivery: highlight set + full gallery', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Plan your event coverage →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="brand" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-brand-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Brand photography — story-led visuals that convert', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Campaign images and evergreen assets built around your positioning — consistent, editorial, and designed for web + press.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: founders, teams, launches', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: creative direction + shotlist', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Usage: web, press, social, ads', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Build a campaign set →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="product" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-product-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Product & detail photography — warm, crisp, tactile', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Elevated still life and product detail images with studio-level polish — built for ecommerce, lookbooks, and ad creative.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: ecommerce, packaging, tabletop', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: styling suggestions + lighting plan', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Deliverables: hero set + variants', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'See product coverage →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="lifestyle" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/service-family-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'Lifestyle & family sessions — natural, editorial, home-ready', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Simple prompts, beautiful light, and space for real connection — photographed with warmth and a polished, print-first finish.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Best for: families, couples, milestones', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Includes: timing + location guidance', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Delivery: curated gallery + print options', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Plan a lifestyle session →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>
						</div>

						<div class="nolan-menu__cta nolan-menu__cta--panel">
							<a class="btn btn-secondary btn-small" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Service Overview', 'nolan-showcase-theme-x9' ); ?></a>
							<a class="btn btn-ghost btn-small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request Dates', 'nolan-showcase-theme-x9' ); ?></a>
						</div>
					</div>
				</section>

				<section id="nolan-panel-who-we-are" class="nolan-menu__panel is-hidden" data-nolan-menu-panel="who-we-are" aria-label="<?php echo esc_attr_x( 'Who we are panel', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
					<div class="nolan-menu__panel-inner">
						<div class="nolan-menu__rail" role="tablist" aria-label="<?php echo esc_attr_x( 'About', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
							<button class="nolan-menu__rail-button is-active" type="button" data-nolan-panel-tab="studio" role="tab" aria-selected="true"><?php esc_html_e( 'The Studio', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="approach" role="tab" aria-selected="false"><?php esc_html_e( 'Our Approach', 'nolan-showcase-theme-x9' ); ?></button>
							<button class="nolan-menu__rail-button" type="button" data-nolan-panel-tab="experience" role="tab" aria-selected="false"><?php esc_html_e( 'The Client Experience', 'nolan-showcase-theme-x9' ); ?></button>
						</div>

						<div class="nolan-menu__content">
							<div class="nolan-menu__panel-content is-active" data-nolan-panel-content="studio" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/about-studio-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'MNY Photo — warm light, calm direction', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'We’re a small studio built for clients who want images that feel honest and elevated. Minimal gear on set, maximal attention to light, pacing, and comfort.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Based in NYC, available for travel', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Editorial style with modern warmth', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Guided experience from planning to delivery', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Meet the studio →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="approach" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/about-approach-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'A process that protects the vibe', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'We plan around light, movement, and story — then keep the session day simple. Direction is gentle and specific, so you never feel “posed.”', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Creative direction + shot flow', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Location + timing recommendations', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Editing that stays true to skin tones', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'How we work →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>

							<div class="nolan-menu__panel-content" data-nolan-panel-content="experience" role="tabpanel">
								<div class="nolan-menu__preview">
									<img src="<?php echo nolan_x9_asset( 'assets/images/about-experience-01.jpg' ); ?>" width="420" height="300" alt="" loading="lazy" decoding="async">
								</div>
								<div class="nolan-menu__content-inner">
									<h3 class="nolan-menu__title"><?php esc_html_e( 'The client experience: clear, warm, intentional', 'nolan-showcase-theme-x9' ); ?></h3>
									<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Expect clear communication, timeline-friendly pacing, and an easy gallery experience. We help you choose favorites and prep images for print and web.', 'nolan-showcase-theme-x9' ) ); ?></p>
									<ul class="nolan-menu__details">
										<li><?php esc_html_e( 'Guided prep call + wardrobe notes', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Candid moments + hero portraits', 'nolan-showcase-theme-x9' ); ?></li>
										<li><?php esc_html_e( 'Print-ready delivery + sharing links', 'nolan-showcase-theme-x9' ); ?></li>
									</ul>
									<a class="btn btn-text" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'See what to expect →', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>
						</div>

						<div class="nolan-menu__cta nolan-menu__cta--panel">
							<a class="btn btn-secondary btn-small" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Studio Details', 'nolan-showcase-theme-x9' ); ?></a>
							<a class="btn btn-ghost btn-small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start an Inquiry', 'nolan-showcase-theme-x9' ); ?></a>
						</div>
					</div>
				</section>

				<section id="nolan-panel-resources" class="nolan-menu__panel is-hidden" data-nolan-menu-panel="resources" aria-label="<?php echo esc_attr_x( 'Resources panel', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
					<div class="nolan-menu__panel-inner">
						<div class="nolan-menu__content">
							<div class="nolan-menu__content-inner">
								<h3 class="nolan-menu__title"><?php esc_html_e( 'Resources for planning, styling, and print-first delivery', 'nolan-showcase-theme-x9' ); ?></h3>
								<p class="nolan-menu__desc"><?php echo wp_kses_post( __( 'Short reads and practical guides — what to wear, how to pick a location, and how to get the most from your gallery.', 'nolan-showcase-theme-x9' ) ); ?></p>
								<div class="nolan-menu__cards" role="list">
									<article class="nolan-menu__card" role="listitem">
										<img src="<?php echo nolan_x9_asset( 'assets/images/resource-wardrobe-01.jpg' ); ?>" width="220" height="160" alt="" loading="lazy" decoding="async">
										<p class="nolan-menu__card-kicker"><?php esc_html_e( 'Planning', 'nolan-showcase-theme-x9' ); ?></p>
										<p class="nolan-menu__card-title"><?php esc_html_e( 'Wardrobe that photographs like a campaign', 'nolan-showcase-theme-x9' ); ?></p>
										<a class="nolan-menu__card-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Read more →', 'nolan-showcase-theme-x9' ); ?></a>
									</article>
									<article class="nolan-menu__card" role="listitem">
										<img src="<?php echo nolan_x9_asset( 'assets/images/resource-location-01.jpg' ); ?>" width="220" height="160" alt="" loading="lazy" decoding="async">
										<p class="nolan-menu__card-kicker"><?php esc_html_e( 'Locations', 'nolan-showcase-theme-x9' ); ?></p>
										<p class="nolan-menu__card-title"><?php esc_html_e( 'How we choose light-first NYC spots', 'nolan-showcase-theme-x9' ); ?></p>
										<a class="nolan-menu__card-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Browse guides →', 'nolan-showcase-theme-x9' ); ?></a>
									</article>
									<article class="nolan-menu__card" role="listitem">
										<img src="<?php echo nolan_x9_asset( 'assets/images/resource-print-01.jpg' ); ?>" width="220" height="160" alt="" loading="lazy" decoding="async">
										<p class="nolan-menu__card-kicker"><?php esc_html_e( 'Delivery', 'nolan-showcase-theme-x9' ); ?></p>
										<p class="nolan-menu__card-title"><?php esc_html_e( 'Print-ready files (and what that really means)', 'nolan-showcase-theme-x9' ); ?></p>
										<a class="nolan-menu__card-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Learn about delivery →', 'nolan-showcase-theme-x9' ); ?></a>
									</article>
									<article class="nolan-menu__card" role="listitem">
										<img src="<?php echo nolan_x9_asset( 'assets/images/resource-sessionday-01.jpg' ); ?>" width="220" height="160" alt="" loading="lazy" decoding="async">
										<p class="nolan-menu__card-kicker"><?php esc_html_e( 'Session Day', 'nolan-showcase-theme-x9' ); ?></p>
										<p class="nolan-menu__card-title"><?php esc_html_e( 'The easiest way to feel natural on camera', 'nolan-showcase-theme-x9' ); ?></p>
										<a class="nolan-menu__card-link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Get tips →', 'nolan-showcase-theme-x9' ); ?></a>
									</article>
								</div>
								<div class="nolan-menu__cta nolan-menu__cta--panel">
									<a class="btn btn-secondary btn-small" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'View Resources', 'nolan-showcase-theme-x9' ); ?></a>
									<a class="btn btn-ghost btn-small" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Ask a question', 'nolan-showcase-theme-x9' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</nav>

		<button class="nolan-menu-mobile__toggle" type="button" data-nolan-mobile-open aria-expanded="false" aria-controls="nolan-mobile-menu">
			<span class="nolan-menu-mobile__toggle-label"><?php esc_html_e( 'Menu', 'nolan-showcase-theme-x9' ); ?></span>
			<span class="nolan-menu-mobile__toggle-icon" aria-hidden="true"></span>
		</button>
	</div>

	<div class="nolan-menu__backdrop" data-nolan-menu-backdrop hidden></div>

	<aside id="nolan-mobile-menu" class="nolan-menu-mobile" data-nolan-mobile-menu aria-hidden="true">
		<div class="nolan-menu-mobile__header">
			<?php nolan_x9_site_logo_markup(); ?>
			<button class="nolan-menu-mobile__close" type="button" data-nolan-mobile-close>
				<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'nolan-showcase-theme-x9' ); ?></span>
				<span aria-hidden="true">×</span>
			</button>
		</div>

		<div class="nolan-menu-mobile__body">
			<div class="nolan-menu-mobile__section">
				<button class="nolan-menu-mobile__trigger" type="button" data-nolan-mobile-trigger="what-we-do" aria-expanded="false">
					<?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x9' ); ?>
				</button>
				<div class="nolan-menu-mobile__panel" data-nolan-mobile-panel-content="what-we-do" hidden>
					<a class="nolan-menu-mobile__link" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Service overview', 'nolan-showcase-theme-x9' ); ?></a>
					<ul class="nolan-menu-mobile__list">
						<li><?php esc_html_e( 'Portrait Sessions', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Weddings & Engagements', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Events & Celebrations', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Brand Photography', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Product & Detail', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Lifestyle & Family', 'nolan-showcase-theme-x9' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="nolan-menu-mobile__section">
				<button class="nolan-menu-mobile__trigger" type="button" data-nolan-mobile-trigger="who-we-are" aria-expanded="false">
					<?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x9' ); ?>
				</button>
				<div class="nolan-menu-mobile__panel" data-nolan-mobile-panel-content="who-we-are" hidden>
					<a class="nolan-menu-mobile__link" href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Studio + approach', 'nolan-showcase-theme-x9' ); ?></a>
					<ul class="nolan-menu-mobile__list">
						<li><?php esc_html_e( 'The Studio', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Our Approach', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Client Experience', 'nolan-showcase-theme-x9' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="nolan-menu-mobile__section">
				<a class="nolan-menu-mobile__direct" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>

			<div class="nolan-menu-mobile__section">
				<button class="nolan-menu-mobile__trigger" type="button" data-nolan-mobile-trigger="resources" aria-expanded="false">
					<?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?>
				</button>
				<div class="nolan-menu-mobile__panel" data-nolan-mobile-panel-content="resources" hidden>
					<a class="nolan-menu-mobile__link" href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Browse resources', 'nolan-showcase-theme-x9' ); ?></a>
					<ul class="nolan-menu-mobile__list">
						<li><?php esc_html_e( 'Wardrobe + styling', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Location planning', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Gallery + print delivery', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Session day tips', 'nolan-showcase-theme-x9' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="nolan-menu-mobile__section">
				<a class="btn btn-primary btn-full" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</aside>
</header>

<main id="content" class="site-main">
