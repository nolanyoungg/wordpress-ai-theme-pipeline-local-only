<?php
/**
 * Template Name: Who We Are
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();

$contact_url = esc_url( home_url( '/contact/' ) );
$work_url    = esc_url( home_url( '/work/' ) );
?>

<section class="page-hero">
	<div class="container page-hero__grid">
		<div class="page-hero__copy" data-reveal>
			<p class="page-hero__kicker"><?php esc_html_e( 'Who we are', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="page-hero__title"><?php esc_html_e( 'A calm studio with a cinematic eye.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="page-hero__subtitle"><?php esc_html_e( 'MNY Photo is built for clients who want warmth, clarity, and images that feel honest — while still looking like a feature.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="page-hero__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Start an inquiry', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="<?php echo $work_url; ?>"><?php esc_html_e( 'View work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
		<div class="page-hero__media" data-reveal aria-hidden="true">
			<img src="<?php echo nolan_x9_asset( 'assets/images/about-studio-01.jpg' ); ?>" width="1200" height="820" alt="" loading="eager" decoding="async">
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
				<?php
				the_content();
				?>
			</div>
			<?php
		endwhile;
		?>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<div class="two-col" data-reveal>
			<div class="two-col__copy">
				<h2 class="section-title"><?php esc_html_e( 'Our story', 'nolan-showcase-theme-x9' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'We started with a simple promise: make people feel comfortable, then craft images that live beyond a trend.', 'nolan-showcase-theme-x9' ); ?></p>
				<p><?php esc_html_e( 'The studio is intentionally small — so communication is direct, timelines are respected, and every gallery gets real attention. We photograph with warmth and precision, and edit with an eye for consistency across an entire story.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="two-col__media" aria-hidden="true">
				<img src="<?php echo nolan_x9_asset( 'assets/images/about-experience-01.jpg' ); ?>" width="960" height="720" alt="" loading="lazy" decoding="async">
			</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container">
		<header class="section-head" data-reveal>
			<h2 class="section-title"><?php esc_html_e( 'Values', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'The guardrails that keep sessions calm — and galleries consistent.', 'nolan-showcase-theme-x9' ); ?></p>
		</header>
		<div class="grid grid--values">
			<div class="value" data-reveal>
				<h3 class="value__title"><?php esc_html_e( 'Warmth over hype', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="value__copy"><?php esc_html_e( 'Trends come and go. We aim for warmth, clarity, and images you’ll still love years from now.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="value" data-reveal>
				<h3 class="value__title"><?php esc_html_e( 'Direction that feels natural', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="value__copy"><?php esc_html_e( 'We lead with simple prompts and pacing so you never feel stuck or overly “posed.”', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="value" data-reveal>
				<h3 class="value__title"><?php esc_html_e( 'Print-first craft', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="value__copy"><?php esc_html_e( 'Color, skin tone, and contrast matter. Our edits are made to hold up in print and across campaigns.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="value" data-reveal>
				<h3 class="value__title"><?php esc_html_e( 'Clear communication', 'nolan-showcase-theme-x9' ); ?></h3>
				<p class="value__copy"><?php esc_html_e( 'The best sessions feel easy. We keep expectations and timelines straightforward from the first email.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section section--soft">
	<div class="container">
		<div class="three-up" data-reveal>
			<div class="three-up__card">
				<h2 class="section-title"><?php esc_html_e( 'Our approach', 'nolan-showcase-theme-x9' ); ?></h2>
				<p><?php esc_html_e( 'We start with your goals and your audience, then build a shot flow that fits your time and energy. Light comes first — and everything else follows.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="three-up__card">
				<h2 class="section-title"><?php esc_html_e( 'Client experience', 'nolan-showcase-theme-x9' ); ?></h2>
				<p><?php esc_html_e( 'Expect a guided, low-pressure session with direct feedback. You’ll never wonder what to do with your hands.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
			<div class="three-up__card">
				<h2 class="section-title"><?php esc_html_e( 'Editing philosophy', 'nolan-showcase-theme-x9' ); ?></h2>
				<p><?php esc_html_e( 'Consistent, warm, and true to your skin. We chase clean tones and a cinematic softness that doesn’t look filtered.', 'nolan-showcase-theme-x9' ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section section--cta">
	<div class="container">
		<div class="final-cta" data-reveal>
			<h2 class="final-cta__title"><?php esc_html_e( 'Let’s plan something calm and beautiful.', 'nolan-showcase-theme-x9' ); ?></h2>
			<p class="final-cta__copy"><?php esc_html_e( 'Tell us what you’re planning — we’ll recommend the right coverage and a light-first timeline.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="final-cta__actions">
				<a class="btn btn-primary" href="<?php echo $contact_url; ?>"><?php esc_html_e( 'Contact Us', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-ghost" href="<?php echo $work_url; ?>"><?php esc_html_e( 'View Work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

