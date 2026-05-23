<?php
/**
 * Template Name: Contact
 *
 * @package Nolan_Showcase_Theme_X6
 */

get_header();
?>

<main id="main-content" class="site-main">
	<section class="section">
		<div class="container contact-grid">
			<header class="page-head reveal">
				<p class="kicker"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x6' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'Start an inquiry', 'nolan-showcase-theme-x6' ); ?></h1>
				<p class="page-lede"><?php esc_html_e( 'Share the date, location, and what you want the images to feel like.', 'nolan-showcase-theme-x6' ); ?></p>
			</header>

			<div class="contact-card reveal">
				<?php
				echo wp_kses_post(
					wpautop(
						__( 'This theme ships with a styled form layout. Use your preferred form plugin (or WordPress block forms) and drop the shortcode here. For demo purposes, this is a static form that does not submit.', 'nolan-showcase-theme-x6' )
					)
				);
				?>

				<form class="form" action="#" method="post">
					<label>
						<span><?php esc_html_e( 'Name', 'nolan-showcase-theme-x6' ); ?></span>
						<input type="text" name="name" autocomplete="name" required>
					</label>
					<label>
						<span><?php esc_html_e( 'Email', 'nolan-showcase-theme-x6' ); ?></span>
						<input type="email" name="email" autocomplete="email" required>
					</label>
					<label class="form-two">
						<span><?php esc_html_e( 'Date', 'nolan-showcase-theme-x6' ); ?></span>
						<input type="text" name="date" autocomplete="off" placeholder="<?php echo esc_attr__( 'MM/DD/YYYY', 'nolan-showcase-theme-x6' ); ?>">
					</label>
					<label class="form-two">
						<span><?php esc_html_e( 'Location', 'nolan-showcase-theme-x6' ); ?></span>
						<input type="text" name="location" autocomplete="off" placeholder="<?php echo esc_attr__( 'City / Venue', 'nolan-showcase-theme-x6' ); ?>">
					</label>
					<label>
						<span><?php esc_html_e( 'Message', 'nolan-showcase-theme-x6' ); ?></span>
						<textarea name="message" rows="5" placeholder="<?php echo esc_attr__( 'What do you want the images to feel like?', 'nolan-showcase-theme-x6' ); ?>"></textarea>
					</label>
					<button type="submit" class="button button--primary button--full"><?php esc_html_e( 'Send inquiry (demo)', 'nolan-showcase-theme-x6' ); ?></button>
					<p class="microcopy">
						<?php
						printf(
							/* translators: %s: email address */
							wp_kses_post( __( 'Prefer email? Write to <a href="mailto:%s">hello@mnyphoto.example</a>.', 'nolan-showcase-theme-x6' ) ),
							esc_attr( 'hello@mnyphoto.example' )
						);
						?>
					</p>
				</form>
			</div>

			<div class="contact-side reveal">
				<img src="<?php echo esc_url( nolan_showcase_x6_image_url( 'contact-studio-desk.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Studio desk illustration', 'nolan-showcase-theme-x6' ); ?>">
				<div class="contact-side__note">
					<h2><?php esc_html_e( 'Response time', 'nolan-showcase-theme-x6' ); ?></h2>
					<p><?php esc_html_e( 'Reply goal: within 2 business days. If your date is soon, mention urgency in the message.', 'nolan-showcase-theme-x6' ); ?></p>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

