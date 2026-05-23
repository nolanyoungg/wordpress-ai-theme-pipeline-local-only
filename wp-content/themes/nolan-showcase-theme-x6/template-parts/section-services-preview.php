<?php
/**
 * Services preview section.
 *
 * @package Nolan_Showcase_Theme_X6
 */

$services = (array) get_query_var( 'nolan_showcase_x6_services', array() );
?>

<section class="section section--ink" id="services">
	<div class="container">
		<header class="section-head reveal">
			<p class="kicker"><?php esc_html_e( 'What we do', 'nolan-showcase-theme-x6' ); ?></p>
			<h2><?php esc_html_e( 'Photo sessions designed like a set: curated, calm, and art-directed.', 'nolan-showcase-theme-x6' ); ?></h2>
			<p class="section-lede"><?php esc_html_e( 'Choose a starting point—then we tailor the plan around your story and the light.', 'nolan-showcase-theme-x6' ); ?></p>
		</header>

		<div class="service-grid">
			<?php foreach ( $services as $service ) : ?>
				<article class="service-card reveal">
					<h3><?php echo esc_html( (string) ( $service['title'] ?? '' ) ); ?></h3>
					<p><?php echo esc_html( (string) ( $service['desc'] ?? '' ) ); ?></p>
					<?php if ( ! empty( $service['bul'] ) && is_array( $service['bul'] ) ) : ?>
						<ul class="tag-list">
							<?php foreach ( $service['bul'] as $bullet ) : ?>
								<li><?php echo esc_html( (string) $bullet ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="cta-strip reveal">
			<div>
				<p class="kicker"><?php esc_html_e( 'Booking', 'nolan-showcase-theme-x6' ); ?></p>
				<h3><?php esc_html_e( 'Tell us the date and the mood. We’ll build the session around it.', 'nolan-showcase-theme-x6' ); ?></h3>
			</div>
			<a class="button button--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Start Your Inquiry', 'nolan-showcase-theme-x6' ); ?></a>
		</div>
	</div>
</section>

