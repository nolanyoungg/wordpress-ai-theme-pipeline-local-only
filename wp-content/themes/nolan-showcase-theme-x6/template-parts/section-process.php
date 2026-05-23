<?php
/**
 * Process section.
 *
 * @package Nolan_Showcase_Theme_X6
 */

$steps = (array) get_query_var( 'nolan_showcase_x6_process_steps', array() );
?>

<section class="section" id="process">
	<div class="container process-grid">
		<header class="section-head reveal">
			<p class="kicker"><?php esc_html_e( 'Process', 'nolan-showcase-theme-x6' ); ?></p>
			<h2><?php esc_html_e( 'High-touch process. Minimal friction. Beautiful delivery.', 'nolan-showcase-theme-x6' ); ?></h2>
			<p class="section-lede"><?php esc_html_e( 'We keep planning simple and focused, so you can stay present and the photos can breathe.', 'nolan-showcase-theme-x6' ); ?></p>
		</header>

		<div class="process-visual reveal">
			<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'process-contact-sheet.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Contact sheet illustration', 'nolan-showcase-theme-x6' ); ?>">
		</div>

		<ol class="process-rail" aria-label="<?php echo esc_attr__( 'Process steps', 'nolan-showcase-theme-x6' ); ?>">
			<?php foreach ( $steps as $step ) : ?>
				<li class="reveal">
					<strong><?php echo esc_html( (string) ( $step[0] ?? '' ) ); ?></strong>
					<span><?php echo esc_html( (string) ( $step[1] ?? '' ) ); ?></span>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

