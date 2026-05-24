<?php
/**
 * Template Name: Contact
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="page-hero">
	<div class="container page-hero__grid">
		<div class="page-hero__copy" data-reveal>
			<p class="page-hero__kicker"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="page-hero__title"><?php esc_html_e( 'Tell us what you’re planning.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="page-hero__subtitle"><?php esc_html_e( 'We’ll reply with availability, timing recommendations, and a simple plan. No pressure — just clarity.', 'nolan-showcase-theme-x9' ); ?></p>
			<ul class="hero__trust">
				<li><?php esc_html_e( 'NYC + travel', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php esc_html_e( 'Editorial + documentary blend', 'nolan-showcase-theme-x9' ); ?></li>
				<li><?php esc_html_e( 'Print-ready delivery', 'nolan-showcase-theme-x9' ); ?></li>
			</ul>
		</div>
		<div class="page-hero__media" data-reveal aria-hidden="true">
			<img src="<?php echo nolan_x9_asset( 'assets/images/hero-portrait-01.jpg' ); ?>" width="1200" height="820" alt="" loading="eager" decoding="async">
		</div>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<div class="contact-grid">
			<div class="contact-form" data-reveal>
				<h2 class="section-title"><?php esc_html_e( 'Inquiry form', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'This is a styled demo form (no external services). For a real site, connect it to your preferred form plugin or email handler.', 'nolan-showcase-theme-x9' ); ?></p>

				<form class="form" action="<?php echo esc_url( home_url( '/contact/' ) ); ?>" method="post" novalidate>
					<div class="form__row">
						<label for="x9-name"><?php esc_html_e( 'Name', 'nolan-showcase-theme-x9' ); ?></label>
						<input id="x9-name" name="name" type="text" autocomplete="name" required>
					</div>
					<div class="form__row">
						<label for="x9-email"><?php esc_html_e( 'Email', 'nolan-showcase-theme-x9' ); ?></label>
						<input id="x9-email" name="email" type="email" autocomplete="email" required>
					</div>
					<div class="form__row">
						<label for="x9-type"><?php esc_html_e( 'Session type', 'nolan-showcase-theme-x9' ); ?></label>
						<select id="x9-type" name="session_type">
							<option><?php esc_html_e( 'Portrait session', 'nolan-showcase-theme-x9' ); ?></option>
							<option><?php esc_html_e( 'Wedding / engagement', 'nolan-showcase-theme-x9' ); ?></option>
							<option><?php esc_html_e( 'Event coverage', 'nolan-showcase-theme-x9' ); ?></option>
							<option><?php esc_html_e( 'Brand photography', 'nolan-showcase-theme-x9' ); ?></option>
							<option><?php esc_html_e( 'Product & detail', 'nolan-showcase-theme-x9' ); ?></option>
							<option><?php esc_html_e( 'Lifestyle / family', 'nolan-showcase-theme-x9' ); ?></option>
						</select>
					</div>
					<div class="form__row">
						<label for="x9-date"><?php esc_html_e( 'Preferred date/timeframe', 'nolan-showcase-theme-x9' ); ?></label>
						<input id="x9-date" name="timeframe" type="text" autocomplete="off" placeholder="<?php echo esc_attr__( 'Example: mid-June weekend, weekday mornings, ASAP', 'nolan-showcase-theme-x9' ); ?>">
					</div>
					<div class="form__row">
						<label for="x9-location"><?php esc_html_e( 'Location', 'nolan-showcase-theme-x9' ); ?></label>
						<input id="x9-location" name="location" type="text" autocomplete="off" placeholder="<?php echo esc_attr__( 'Example: Manhattan, Brooklyn, Hudson Valley, on-location', 'nolan-showcase-theme-x9' ); ?>">
					</div>
					<div class="form__row">
						<label for="x9-message"><?php esc_html_e( 'Message', 'nolan-showcase-theme-x9' ); ?></label>
						<textarea id="x9-message" name="message" rows="5" placeholder="<?php echo esc_attr__( 'Tell us what you’re planning and how you’ll use the images.', 'nolan-showcase-theme-x9' ); ?>"></textarea>
					</div>
					<div class="form__row">
						<button class="btn btn-primary btn-full" type="submit"><?php esc_html_e( 'Send inquiry (demo)', 'nolan-showcase-theme-x9' ); ?></button>
						<p class="form-hint"><?php esc_html_e( 'Prefer email? Use hello@mnyphoto.example.', 'nolan-showcase-theme-x9' ); ?></p>
					</div>
				</form>
			</div>

			<div class="contact-aside" data-reveal>
				<h2 class="section-title"><?php esc_html_e( 'Details', 'nolan-showcase-theme-x9' ); ?></h2>
				<ul class="contact-aside__list">
					<li><strong><?php esc_html_e( 'Email:', 'nolan-showcase-theme-x9' ); ?></strong> <?php echo esc_html__( 'hello@mnyphoto.example', 'nolan-showcase-theme-x9' ); ?></li>
					<li><strong><?php esc_html_e( 'Base:', 'nolan-showcase-theme-x9' ); ?></strong> <?php echo esc_html__( 'Manhattan, NY', 'nolan-showcase-theme-x9' ); ?></li>
					<li><strong><?php esc_html_e( 'Travel:', 'nolan-showcase-theme-x9' ); ?></strong> <?php echo esc_html__( 'Available with planning lead time', 'nolan-showcase-theme-x9' ); ?></li>
				</ul>

				<div class="contact-aside__box">
					<h3 class="contact-aside__title"><?php esc_html_e( 'Booking steps', 'nolan-showcase-theme-x9' ); ?></h3>
					<ol class="contact-aside__steps">
						<li><?php esc_html_e( 'Inquiry + availability', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Creative direction + plan', 'nolan-showcase-theme-x9' ); ?></li>
						<li><?php esc_html_e( 'Session + delivery window', 'nolan-showcase-theme-x9' ); ?></li>
					</ol>
				</div>

				<div class="contact-aside__box">
					<h3 class="contact-aside__title"><?php esc_html_e( 'FAQ', 'nolan-showcase-theme-x9' ); ?></h3>
					<div class="faq">
						<details>
							<summary><?php esc_html_e( 'Do you travel?', 'nolan-showcase-theme-x9' ); ?></summary>
							<p><?php esc_html_e( 'Yes. Share the location and timeframe, and we’ll confirm travel logistics and planning lead time.', 'nolan-showcase-theme-x9' ); ?></p>
						</details>
						<details>
							<summary><?php esc_html_e( 'Can you help choose a session type?', 'nolan-showcase-theme-x9' ); ?></summary>
							<p><?php esc_html_e( 'Absolutely. Tell us your goals and how you’ll use the images — we’ll recommend the right structure.', 'nolan-showcase-theme-x9' ); ?></p>
						</details>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'We reply with clarity — not a sales pitch.', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Share your date/timeframe and what you need. We’ll respond with availability and next steps.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'Services', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

