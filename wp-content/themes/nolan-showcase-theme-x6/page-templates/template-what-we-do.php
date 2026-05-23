<?php
/**
 * Template Name: What We Do
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();

$services = array(
	array(
		'title' => __( 'Weddings', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Cinematic coverage with editorial pacing—built around moments, not a shot list.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Timeline planning', 'nolan-showcase-theme-x6' ), __( 'Guided portraits', 'nolan-showcase-theme-x6' ), __( 'Full gallery delivery', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Brand Sessions', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Premium imagery designed for websites, press, and launches with cohesive tone.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Moodboard support', 'nolan-showcase-theme-x6' ), __( 'Usage-aware frames', 'nolan-showcase-theme-x6' ), __( 'Consistent color finish', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Couples + Families', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Warm lifestyle photography with a calm pace and gentle direction.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Movement prompts', 'nolan-showcase-theme-x6' ), __( 'Location guidance', 'nolan-showcase-theme-x6' ), __( 'Natural, honest moments', 'nolan-showcase-theme-x6' ) ),
	),
	array(
		'title' => __( 'Events', 'nolan-showcase-theme-x6' ),
		'desc'  => __( 'Discreet, elevated coverage for dinners, launches, and celebrations.', 'nolan-showcase-theme-x6' ),
		'bul'   => array( __( 'Candid coverage', 'nolan-showcase-theme-x6' ), __( 'Detail frames', 'nolan-showcase-theme-x6' ), __( 'Fast highlight selects', 'nolan-showcase-theme-x6' ) ),
	),
);
?>

<main id="main-content" class="site-main">
	<section class="section section--ink">
		<div class="container">
			<header class="page-head reveal">
				<p class="kicker"><?php esc_html_e( 'What we do', 'nolan-showcase-theme-x6' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'Sessions built like a set—calm, curated, art-directed.', 'nolan-showcase-theme-x6' ); ?></h1>
				<p class="page-lede"><?php esc_html_e( 'We’ll shape the mood and simplify the plan so the images feel effortless and elevated.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>

			<div class="service-grid">
				<?php foreach ( $services as $service ) : ?>
					<article class="service-card reveal">
						<h2><?php echo esc_html( $service['title'] ); ?></h2>
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
					<p class="kicker"><?php esc_html_e( 'Inquiries', 'nolan-showcase-theme-x6' ); ?></p>
					<h3><?php esc_html_e( 'Share the date + location—then we’ll build the session around your story.', 'nolan-showcase-theme-x6' ); ?></h3>
				</div>
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x6' ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

