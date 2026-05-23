<?php
/**
 * Hero section for the front page.
 *
 * @package Nolan_Showcase_Theme_X6
 */

?>

<section class="hero" id="top">
	<div class="container hero-grid">
		<div class="hero-copy reveal">
			<p class="kicker"><?php esc_html_e( 'MNY Photo', 'nolan-showcase-theme-x6' ); ?></p>
			<h1><?php esc_html_e( 'Cinematic, editorial photography—crafted with warmth, restraint, and intention.', 'nolan-showcase-theme-x6' ); ?></h1>
			<p class="hero-lead"><?php esc_html_e( 'From weddings to brand sessions, we build images that feel like a film still: quiet luxury, honest emotion, precise light.', 'nolan-showcase-theme-x6' ); ?></p>

			<div class="cluster">
				<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start Your Inquiry', 'nolan-showcase-theme-x6' ); ?></a>
				<a class="button button--secondary" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x6' ); ?></a>
			</div>

			<div class="hero-proof" aria-label="<?php echo esc_attr__( 'Service notes', 'nolan-showcase-theme-x6' ); ?>">
				<div class="proof-item">
					<strong><?php esc_html_e( 'Guided direction', 'nolan-showcase-theme-x6' ); ?></strong>
					<span><?php esc_html_e( 'Clear prompts, never stiff posing.', 'nolan-showcase-theme-x6' ); ?></span>
				</div>
				<div class="proof-item">
					<strong><?php esc_html_e( 'Warm-luxury tone', 'nolan-showcase-theme-x6' ); ?></strong>
					<span><?php esc_html_e( 'Ivory highlights + cinematic contrast.', 'nolan-showcase-theme-x6' ); ?></span>
				</div>
				<div class="proof-item">
					<strong><?php esc_html_e( 'Fast replies', 'nolan-showcase-theme-x6' ); ?></strong>
					<span><?php esc_html_e( 'Reply goal: 2 business days.', 'nolan-showcase-theme-x6' ); ?></span>
				</div>
			</div>
		</div>

		<div class="hero-visual reveal">
			<div class="frame" aria-label="<?php echo esc_attr__( 'Editorial portrait placeholder', 'nolan-showcase-theme-x6' ); ?>">
				<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'hero-editorial-portrait.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Abstract editorial portrait illustration', 'nolan-showcase-theme-x6' ); ?>">
			</div>
			<div class="hero-overlay" aria-hidden="true">
				<span><?php esc_html_e( 'editorial set', 'nolan-showcase-theme-x6' ); ?></span>
				<strong><?php esc_html_e( 'light + story', 'nolan-showcase-theme-x6' ); ?></strong>
			</div>
		</div>
	</div>
</section>

