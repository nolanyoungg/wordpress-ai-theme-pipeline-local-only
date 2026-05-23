<?php
/**
 * Template Name: Who We Are
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="section">
		<div class="container page-grid">
			<header class="page-head reveal">
				<p class="kicker"><?php esc_html_e( 'Who we are', 'nolan-showcase-theme-x6' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'A small team with an editorial eye.', 'nolan-showcase-theme-x6' ); ?></h1>
				<p class="page-lede"><?php esc_html_e( 'We blend documentary honesty with a cinematic finish—so the work feels elevated, not overproduced.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>

			<div class="page-visual reveal">
				<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'about-photographer.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Photographer illustration', 'nolan-showcase-theme-x6' ); ?>">
			</div>

			<section class="page-panel reveal">
				<h2><?php esc_html_e( 'How we work', 'nolan-showcase-theme-x6' ); ?></h2>
				<p><?php esc_html_e( 'You’ll never be left guessing. We give simple direction, keep the pace calm, and focus on clean composition. The aim is a cohesive story—wide frames, details, and portraits with presence.', 'nolan-showcase-theme-x6' ); ?></p>
				<ul class="check-list">
					<li><?php esc_html_e( 'Calm, guided direction', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'Warm-luxury tonal finish', 'nolan-showcase-theme-x6' ); ?></li>
					<li><?php esc_html_e( 'A gallery that reads like a narrative', 'nolan-showcase-theme-x6' ); ?></li>
				</ul>
			</section>

			<section class="page-panel reveal">
				<h2><?php esc_html_e( 'Client experience', 'nolan-showcase-theme-x6' ); ?></h2>
				<p><?php esc_html_e( 'We keep communication tight and decisions simple. Expect quick check-ins, thoughtful planning, and delivery that feels polished and easy to share.', 'nolan-showcase-theme-x6' ); ?></p>
				<div class="cluster">
					<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start your inquiry', 'nolan-showcase-theme-x6' ); ?></a>
					<a class="button button--secondary" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View work', 'nolan-showcase-theme-x6' ); ?></a>
				</div>
			</section>
		</div>
	</section>
</main>

<?php
get_footer();

