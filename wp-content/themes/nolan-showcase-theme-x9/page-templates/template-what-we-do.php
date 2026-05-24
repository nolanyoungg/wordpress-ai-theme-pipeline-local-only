<?php
/**
 * Template Name: What We Do
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();

$contact_url = esc_url( home_url( '/contact/' ) );
?>

<section class="page-hero">
	<div class="container page-hero__grid">
		<div class="page-hero__copy" data-reveal>
			<p class="page-hero__kicker"><?php esc_html_e( 'What we do', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="page-hero__title"><?php esc_html_e( 'Editorial coverage for people, brands, and fast days.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="page-hero__subtitle"><?php esc_html_e( 'Our sessions are built around light and pacing, so you feel present — and the images feel effortless.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="page-hero__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Request availability', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="#services"><?php esc_html_e( 'Browse services', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
		<div class="page-hero__media" data-reveal aria-hidden="true">
			<img src="<?php echo nolan_x9_asset( 'assets/images/service-brand-01.jpg' ); ?>" width="1200" height="820" alt="" loading="eager" decoding="async">
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

<section id="services" class="section section--soft">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Service menu', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Six offerings, each with a distinct intention and deliverable style.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="grid grid--services">
			<?php
			$cards = array(
				array(
					'title'   => __( 'Portrait Sessions', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-portrait-01.jpg',
					'desc'    => __( 'Modern portraits for creatives, founders, and couples — guided, natural, editorial.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: web bios, press kits, dating profiles', 'nolan-showcase-theme-x9' ),
						__( 'Includes: wardrobe + light-first timing', 'nolan-showcase-theme-x9' ),
						__( 'Deliverables: curated gallery + hero selects', 'nolan-showcase-theme-x9' ),
					),
				),
				array(
					'title'   => __( 'Weddings & Engagements', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-wedding-01.jpg',
					'desc'    => __( 'Documentary storytelling with portraits that feel effortless and timeless.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: city hall, full weekends, elopements', 'nolan-showcase-theme-x9' ),
						__( 'Includes: timeline + portrait plan', 'nolan-showcase-theme-x9' ),
						__( 'Option: 48-hour sneak peek', 'nolan-showcase-theme-x9' ),
					),
				),
				array(
					'title'   => __( 'Events & Celebrations', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-event-01.jpg',
					'desc'    => __( 'Fast, flattering coverage with candid energy and detail storytelling.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: launches, galas, milestone nights', 'nolan-showcase-theme-x9' ),
						__( 'Includes: candid + editorial portraits', 'nolan-showcase-theme-x9' ),
						__( 'Deliverables: highlight set + full gallery', 'nolan-showcase-theme-x9' ),
					),
				),
				array(
					'title'   => __( 'Brand Photography', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-brand-01.jpg',
					'desc'    => __( 'Campaign-ready visuals that align to your positioning and feel consistent across channels.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: founders, teams, launches', 'nolan-showcase-theme-x9' ),
						__( 'Includes: creative direction + shotlist', 'nolan-showcase-theme-x9' ),
						__( 'Usage: web, press, social, ads', 'nolan-showcase-theme-x9' ),
					),
				),
				array(
					'title'   => __( 'Product & Detail Photography', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-product-01.jpg',
					'desc'    => __( 'Warm still life and product details with studio polish — crisp, tactile, and clean.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: ecommerce, packaging, lookbooks', 'nolan-showcase-theme-x9' ),
						__( 'Includes: styling + lighting plan', 'nolan-showcase-theme-x9' ),
						__( 'Deliverables: hero set + variants', 'nolan-showcase-theme-x9' ),
					),
				),
				array(
					'title'   => __( 'Lifestyle & Family Sessions', 'nolan-showcase-theme-x9' ),
					'img'     => 'service-family-01.jpg',
					'desc'    => __( 'Natural moments photographed with editorial composition and warm, polished finishing.', 'nolan-showcase-theme-x9' ),
					'details' => array(
						__( 'Best for: families, couples, milestones', 'nolan-showcase-theme-x9' ),
						__( 'Includes: timing + location guidance', 'nolan-showcase-theme-x9' ),
						__( 'Deliverables: curated gallery + print options', 'nolan-showcase-theme-x9' ),
					),
				),
			);

			foreach ( $cards as $card ) :
				?>
				<article class="service-card service-card--detailed" data-reveal>
					<img class="service-card__img" src="<?php echo nolan_x9_asset( 'assets/images/' . $card['img'] ); ?>" width="900" height="650" alt="" loading="lazy" decoding="async">
					<div class="service-card__body">
						<h3 class="service-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="service-card__desc"><?php echo esc_html( $card['desc'] ); ?></p>
						<ul class="service-card__details">
							<?php foreach ( $card['details'] as $detail ) : ?>
								<li><?php echo esc_html( $detail ); ?></li>
							<?php endforeach; ?>
						</ul>
						<a class="btn btn-text" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Ask about availability →', 'nolan-showcase-theme-x9' ); ?></a>
					</div>
				</article>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Compare sessions at a glance', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'A simple comparison to help you choose the right fit.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>

		<div class="table-wrap" data-reveal>
			<table class="compare" aria-label="<?php echo esc_attr_x( 'Service comparison', 'aria label', 'nolan-showcase-theme-x9' ); ?>">
				<thead>
					<tr>
						<th scope="col"><?php esc_html_e( 'Service', 'nolan-showcase-theme-x9' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Best for', 'nolan-showcase-theme-x9' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Planning', 'nolan-showcase-theme-x9' ); ?></th>
						<th scope="col"><?php esc_html_e( 'Delivery', 'nolan-showcase-theme-x9' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e( 'Portraits', 'nolan-showcase-theme-x9' ); ?></th>
						<td><?php esc_html_e( 'Founders, creatives, couples', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Wardrobe + location guidance', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Curated gallery + hero selects', 'nolan-showcase-theme-x9' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Weddings', 'nolan-showcase-theme-x9' ); ?></th>
						<td><?php esc_html_e( 'Full days and weekends', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Timeline + portrait plan', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Story gallery + sneak peek option', 'nolan-showcase-theme-x9' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Events', 'nolan-showcase-theme-x9' ); ?></th>
						<td><?php esc_html_e( 'Launches and celebrations', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Run-of-show alignment', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Highlights + full gallery', 'nolan-showcase-theme-x9' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Brand', 'nolan-showcase-theme-x9' ); ?></th>
						<td><?php esc_html_e( 'Campaigns and evergreen assets', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Creative direction + shotlist', 'nolan-showcase-theme-x9' ); ?></td>
						<td><?php esc_html_e( 'Usage-ready sets', 'nolan-showcase-theme-x9' ); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'FAQ', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Service-specific questions we hear often.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>
		<div class="faq" data-reveal>
			<details>
				<summary><?php esc_html_e( 'Can you help with styling?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'Yes. We’ll recommend a palette, fabrics that photograph well, and options for your location and goals.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
			<details>
				<summary><?php esc_html_e( 'Do you shoot in-studio and on-location?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'Both. We choose the setting based on your story and your comfort. Light and pacing matter more than a specific “spot.”', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
			<details>
				<summary><?php esc_html_e( 'How many images do we receive?', 'nolan-showcase-theme-x9' ); ?></summary>
				<p><?php esc_html_e( 'It depends on session length and complexity. You’ll always receive a curated gallery that tells a complete story, not a dump of near-duplicates.', 'nolan-showcase-theme-x9' ); ?></p>
			</details>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'Not sure which service fits?', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Send us your goal and your timeframe — we’ll recommend the right structure.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

