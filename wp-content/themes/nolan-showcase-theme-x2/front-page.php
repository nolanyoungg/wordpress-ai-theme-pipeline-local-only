<?php
/**
 * Front page template.
 *
 * @package Nolan_Showcase_Theme_X2
 */

get_header();

$capabilities = array(
	array( 'Software Development', 'Product interfaces, service integrations, architecture cleanup, and maintainable front-end systems built for change.', '01' ),
	array( 'WordPress Development', 'Custom theme engineering, editorial workflows, accessible templates, performance tuning, and practical admin experiences.', '02' ),
	array( 'Automation', 'Internal tools, review pipelines, handoff systems, repeatable QA checks, and operations that remove avoidable manual work.', '03' ),
	array( 'AI Integration', 'Structured AI features with prompt systems, human review points, privacy-aware patterns, and measurable product value.', '04' ),
	array( 'Analytics & Tracking', 'Event strategy, conversion instrumentation, dashboard-ready schemas, and insight loops teams can trust.', '05' ),
	array( 'Technical Leadership', 'Architecture direction, launch planning, mentoring, vendor review, and calm execution across ambiguous delivery surfaces.', '06' ),
);

$metrics = array(
	array( '48', 'launch checkpoints converted into reusable QA playbooks' ),
	array( '32', 'core interaction events mapped for product analytics' ),
	array( '14', 'automation lanes designed for editorial and engineering teams' ),
);
?>
<main id="primary" class="site-main">
	<section class="hero" id="top">
		<div class="container hero__grid">
			<div class="hero__content reveal">
				<p class="eyebrow"><?php esc_html_e( 'Developer portfolio / systems builder', 'nolan-showcase-theme-x2' ); ?></p>
				<h1><?php esc_html_e( 'Nolan designs and ships blue-chip web systems for teams that need software clarity.', 'nolan-showcase-theme-x2' ); ?></h1>
				<p class="hero__lead"><?php esc_html_e( 'A premium portfolio theme for a developer who connects polished interfaces, WordPress platforms, automation, AI integrations, analytics, and technical leadership into one dependable delivery practice.', 'nolan-showcase-theme-x2' ); ?></p>
				<div class="hero__actions">
					<a class="button button--primary" href="<?php echo esc_url( home_url( '/#work' ) ); ?>"><?php esc_html_e( 'View Selected Work', 'nolan-showcase-theme-x2' ); ?></a>
					<a class="button button--secondary" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Discuss a Build', 'nolan-showcase-theme-x2' ); ?></a>
				</div>
			</div>
			<div class="hero-console reveal" aria-label="<?php echo esc_attr__( 'Portfolio capability dashboard', 'nolan-showcase-theme-x2' ); ?>">
				<div class="console-top"><span></span><span></span><span></span><strong><?php esc_html_e( 'delivery.system', 'nolan-showcase-theme-x2' ); ?></strong></div>
				<div class="console-status">
					<span><?php esc_html_e( 'Portfolio Stack', 'nolan-showcase-theme-x2' ); ?></span>
					<strong><?php esc_html_e( 'Production Ready', 'nolan-showcase-theme-x2' ); ?></strong>
				</div>
				<div class="signal-grid" aria-hidden="true">
					<span></span><span></span><span></span><span></span><span></span><span></span>
				</div>
				<ul class="console-list">
					<li><span><?php esc_html_e( '01', 'nolan-showcase-theme-x2' ); ?></span><?php esc_html_e( 'custom theme architecture', 'nolan-showcase-theme-x2' ); ?></li>
					<li><span><?php esc_html_e( '02', 'nolan-showcase-theme-x2' ); ?></span><?php esc_html_e( 'automation and AI guardrails', 'nolan-showcase-theme-x2' ); ?></li>
					<li><span><?php esc_html_e( '03', 'nolan-showcase-theme-x2' ); ?></span><?php esc_html_e( 'event tracking and reporting', 'nolan-showcase-theme-x2' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<section id="capabilities" class="section">
		<div class="container">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Capabilities', 'nolan-showcase-theme-x2' ); ?></p>
				<h2><?php esc_html_e( 'A portfolio built around the work a modern technical lead actually does.', 'nolan-showcase-theme-x2' ); ?></h2>
			</div>
			<div class="capability-grid">
				<?php foreach ( $capabilities as $capability ) : ?>
					<article class="capability-card reveal" data-tilt-card>
						<span><?php echo esc_html( $capability[2] ); ?></span>
						<h3><?php echo esc_html( $capability[0] ); ?></h3>
						<p><?php echo esc_html( $capability[1] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section id="work" class="section section--blueprint">
		<div class="container split-layout">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Selected work / process', 'nolan-showcase-theme-x2' ); ?></p>
				<h2><?php esc_html_e( 'From rough systems to launchable product surfaces.', 'nolan-showcase-theme-x2' ); ?></h2>
				<p><?php esc_html_e( 'Use this section for case studies that show product thinking, clean implementation, stakeholder judgment, and measurable improvement.', 'nolan-showcase-theme-x2' ); ?></p>
			</div>
			<div class="process-stack">
				<article class="process-card reveal"><strong><?php esc_html_e( 'Map', 'nolan-showcase-theme-x2' ); ?></strong><span><?php esc_html_e( 'Audit content, users, workflows, integrations, analytics gaps, and operational constraints.', 'nolan-showcase-theme-x2' ); ?></span></article>
				<article class="process-card reveal"><strong><?php esc_html_e( 'Build', 'nolan-showcase-theme-x2' ); ?></strong><span><?php esc_html_e( 'Ship maintainable templates, UI systems, automation routes, AI touchpoints, and reviewable increments.', 'nolan-showcase-theme-x2' ); ?></span></article>
				<article class="process-card reveal"><strong><?php esc_html_e( 'Measure', 'nolan-showcase-theme-x2' ); ?></strong><span><?php esc_html_e( 'Validate accessibility, performance, tracking quality, and the operational impact of each release.', 'nolan-showcase-theme-x2' ); ?></span></article>
			</div>
		</div>
	</section>

	<section id="metrics" class="section">
		<div class="container metrics-layout">
			<div class="section-heading reveal">
				<p class="eyebrow"><?php esc_html_e( 'Metrics', 'nolan-showcase-theme-x2' ); ?></p>
				<h2><?php esc_html_e( 'Measurement is treated as part of the product, not a tag pasted on later.', 'nolan-showcase-theme-x2' ); ?></h2>
			</div>
			<div class="metric-grid">
				<?php foreach ( $metrics as $metric ) : ?>
					<div class="metric-card reveal">
						<strong data-counter="<?php echo esc_attr( $metric[0] ); ?>">0</strong>
						<span><?php echo esc_html( $metric[1] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section id="leadership" class="section leadership">
		<div class="container leadership__inner reveal">
			<p class="eyebrow"><?php esc_html_e( 'Technical leadership', 'nolan-showcase-theme-x2' ); ?></p>
			<h2><?php esc_html_e( 'Calm technical direction for work that crosses design, engineering, content, data, and operations.', 'nolan-showcase-theme-x2' ); ?></h2>
			<p><?php echo wp_kses_post( __( 'The theme frames leadership as an applied practice: clear architecture, useful tradeoffs, launch discipline, mentoring, quality review, and systems that survive beyond the first release.', 'nolan-showcase-theme-x2' ) ); ?></p>
		</div>
	</section>

	<section id="contact" class="section contact">
		<div class="container contact__inner reveal">
			<div>
				<p class="eyebrow"><?php esc_html_e( 'Contact / CTA', 'nolan-showcase-theme-x2' ); ?></p>
				<h2><?php esc_html_e( 'Ready to turn technical depth into a portfolio that feels precise, current, and credible?', 'nolan-showcase-theme-x2' ); ?></h2>
			</div>
			<a class="button button--primary" href="<?php echo esc_url( home_url( '/#top' ) ); ?>"><?php esc_html_e( 'Back to Top', 'nolan-showcase-theme-x2' ); ?></a>
		</div>
	</section>
</main>
<?php
get_footer();
