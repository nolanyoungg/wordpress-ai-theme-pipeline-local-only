<?php
/**
 * Front page template.
 *
 * @package Nolan_Showcase_Theme_X8
 */

get_header();

$featured_posts = get_posts(
	array(
		'numberposts'      => 6,
		'post_status'      => 'publish',
		'post_type'        => 'post',
		'suppress_filters' => false,
	)
);

$contact_email = (string) get_option( 'admin_email' );
$contact_email = is_email( $contact_email ) ? $contact_email : '';
?>

<section class="hero" id="top">
	<div class="container hero-grid">
		<div class="hero-copy">
			<p class="eyebrow"><?php echo esc_html__( 'Showcase Theme', 'nolan-showcase-theme-x8' ); ?></p>
			<h1 class="hero-title">
				<?php
				printf(
					/* translators: %s: site name */
					esc_html__( 'A modern portfolio for %s', 'nolan-showcase-theme-x8' ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</h1>
			<p class="hero-lead">
				<?php echo esc_html__( 'Typography-forward layouts, accessible navigation, and a clean project grid—built as a classic WordPress theme.', 'nolan-showcase-theme-x8' ); ?>
			</p>

			<div class="hero-actions">
				<a class="btn btn-primary" href="#work"><?php echo esc_html__( 'View Work', 'nolan-showcase-theme-x8' ); ?></a>
				<a class="btn btn-secondary" href="#contact"><?php echo esc_html__( 'Contact', 'nolan-showcase-theme-x8' ); ?></a>
			</div>

			<ul class="hero-points" aria-label="<?php echo esc_attr__( 'Highlights', 'nolan-showcase-theme-x8' ); ?>">
				<li><?php echo esc_html__( 'Card-based project grid', 'nolan-showcase-theme-x8' ); ?></li>
				<li><?php echo esc_html__( 'High-contrast, generous spacing', 'nolan-showcase-theme-x8' ); ?></li>
				<li><?php echo esc_html__( 'Subtle motion (reduced-motion respected)', 'nolan-showcase-theme-x8' ); ?></li>
			</ul>
		</div>

		<div class="hero-visual" aria-label="<?php echo esc_attr__( 'Featured layout preview', 'nolan-showcase-theme-x8' ); ?>">
			<div class="frame">
				<div class="frame-top">
					<span class="dot" aria-hidden="true"></span>
					<span class="dot" aria-hidden="true"></span>
					<span class="dot" aria-hidden="true"></span>
				</div>
				<div class="frame-body">
					<div class="frame-line"></div>
					<div class="frame-line frame-line--short"></div>
					<div class="frame-grid" aria-hidden="true">
						<div class="frame-card"></div>
						<div class="frame-card"></div>
						<div class="frame-card"></div>
						<div class="frame-card"></div>
					</div>
				</div>
			</div>
			<p class="hero-micro">
				<?php echo esc_html__( 'Tip: assign a Primary Menu for full control.', 'nolan-showcase-theme-x8' ); ?>
			</p>
		</div>
	</div>
</section>

<section class="section" id="work">
	<div class="container">
		<header class="section-head">
			<p class="eyebrow"><?php echo esc_html__( 'Featured Work', 'nolan-showcase-theme-x8' ); ?></p>
			<h2><?php echo esc_html__( 'Projects that read clean and feel premium.', 'nolan-showcase-theme-x8' ); ?></h2>
			<p class="section-lead"><?php echo esc_html__( 'This grid pulls from your latest posts. Add featured images for extra polish.', 'nolan-showcase-theme-x8' ); ?></p>
		</header>

		<div class="grid cards">
			<?php if ( $featured_posts ) : ?>
				<?php foreach ( $featured_posts as $post ) : ?>
					<?php
					$post_id = (int) $post->ID;
					$permalink = get_permalink( $post_id );
					?>
					<article class="card reveal">
						<?php if ( has_post_thumbnail( $post_id ) ) : ?>
							<a class="card-media" href="<?php echo esc_url( $permalink ); ?>">
								<?php echo get_the_post_thumbnail( $post_id, 'large', array( 'loading' => 'lazy' ) ); ?>
							</a>
						<?php else : ?>
							<a class="card-media card-media--placeholder" href="<?php echo esc_url( $permalink ); ?>">
								<span class="screen-reader-text">
									<?php
									printf(
										/* translators: %s: post title */
										esc_html__( 'Read %s', 'nolan-showcase-theme-x8' ),
										esc_html( get_the_title( $post_id ) )
									);
									?>
								</span>
							</a>
						<?php endif; ?>

						<div class="card-body">
							<p class="card-meta">
								<time datetime="<?php echo esc_attr( get_the_date( 'c', $post_id ) ); ?>"><?php echo esc_html( get_the_date( '', $post_id ) ); ?></time>
							</p>
							<h3 class="card-title">
								<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( get_the_title( $post_id ) ); ?></a>
							</h3>
							<p class="card-excerpt"><?php echo nolan_showcase_x8_get_post_excerpt( $post_id, 22 ); ?></p>
							<p class="card-actions">
								<a class="text-link" href="<?php echo esc_url( $permalink ); ?>">
									<?php echo esc_html__( 'Read more', 'nolan-showcase-theme-x8' ); ?>
								</a>
							</p>
						</div>
					</article>
				<?php endforeach; ?>
			<?php else : ?>
				<?php
				$placeholders = array(
					array(
						'title' => esc_html__( 'Brand system refresh', 'nolan-showcase-theme-x8' ),
						'desc'  => esc_html__( 'A tidy visual system with confident type and accessible contrast.', 'nolan-showcase-theme-x8' ),
					),
					array(
						'title' => esc_html__( 'Landing page redesign', 'nolan-showcase-theme-x8' ),
						'desc'  => esc_html__( 'A conversion-focused layout with clean sections and motion that stays subtle.', 'nolan-showcase-theme-x8' ),
					),
					array(
						'title' => esc_html__( 'Content & case studies', 'nolan-showcase-theme-x8' ),
						'desc'  => esc_html__( 'Readable posts with a consistent rhythm for headings, links, and images.', 'nolan-showcase-theme-x8' ),
					),
				);
				?>
				<?php foreach ( $placeholders as $item ) : ?>
					<article class="card reveal">
						<div class="card-media card-media--placeholder" aria-hidden="true"></div>
						<div class="card-body">
							<p class="card-meta"><?php echo esc_html__( 'Add posts to populate', 'nolan-showcase-theme-x8' ); ?></p>
							<h3 class="card-title"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="card-excerpt"><?php echo esc_html( $item['desc'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<div class="center-actions reveal">
			<a class="btn btn-secondary" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url( '/' ) ); ?>">
				<?php echo esc_html__( 'Browse posts', 'nolan-showcase-theme-x8' ); ?>
			</a>
			<a class="btn btn-primary" href="#contact"><?php echo esc_html__( 'Start a project', 'nolan-showcase-theme-x8' ); ?></a>
		</div>
	</div>
</section>

<section class="section section-ink" id="about">
	<div class="container split">
		<div class="reveal">
			<p class="eyebrow"><?php echo esc_html__( 'About', 'nolan-showcase-theme-x8' ); ?></p>
			<h2><?php echo esc_html__( 'A clean, modern foundation—ready for your work.', 'nolan-showcase-theme-x8' ); ?></h2>
			<p class="section-lead">
				<?php echo esc_html__( 'Use this theme for a portfolio, studio, or small business site. It’s built for clarity: strong type, thoughtful spacing, and predictable components.', 'nolan-showcase-theme-x8' ); ?>
			</p>

			<ul class="checklist" aria-label="<?php echo esc_attr__( 'Theme notes', 'nolan-showcase-theme-x8' ); ?>">
				<li><?php echo esc_html__( 'Accessible skip link + focus styles', 'nolan-showcase-theme-x8' ); ?></li>
				<li><?php echo esc_html__( 'Mobile-first navigation toggle', 'nolan-showcase-theme-x8' ); ?></li>
				<li><?php echo esc_html__( 'Cards and typography scale cleanly', 'nolan-showcase-theme-x8' ); ?></li>
			</ul>
		</div>

		<div class="about-card reveal">
			<h3><?php echo esc_html__( 'What to customize', 'nolan-showcase-theme-x8' ); ?></h3>
			<ol class="process" aria-label="<?php echo esc_attr__( 'Quick start', 'nolan-showcase-theme-x8' ); ?>">
				<li><strong><?php echo esc_html__( 'Set your homepage', 'nolan-showcase-theme-x8' ); ?></strong><span><?php echo esc_html__( 'Use Settings → Reading for a static front page.', 'nolan-showcase-theme-x8' ); ?></span></li>
				<li><strong><?php echo esc_html__( 'Assign a menu', 'nolan-showcase-theme-x8' ); ?></strong><span><?php echo esc_html__( 'Appearance → Menus → Primary Menu.', 'nolan-showcase-theme-x8' ); ?></span></li>
				<li><strong><?php echo esc_html__( 'Add featured images', 'nolan-showcase-theme-x8' ); ?></strong><span><?php echo esc_html__( 'Cards look best with thumbnails.', 'nolan-showcase-theme-x8' ); ?></span></li>
			</ol>
		</div>
	</div>
</section>

<section class="section" id="contact">
	<div class="container">
		<div class="cta reveal">
			<div>
				<p class="eyebrow"><?php echo esc_html__( 'Contact', 'nolan-showcase-theme-x8' ); ?></p>
				<h2><?php echo esc_html__( 'Have a project in mind?', 'nolan-showcase-theme-x8' ); ?></h2>
				<p class="section-lead"><?php echo esc_html__( 'Send a quick note and we’ll reply with next steps.', 'nolan-showcase-theme-x8' ); ?></p>
			</div>
			<div class="cta-actions">
				<?php if ( $contact_email ) : ?>
					<a class="btn btn-primary" href="<?php echo esc_url( 'mailto:' . antispambot( $contact_email ) ); ?>">
						<?php echo esc_html__( 'Email us', 'nolan-showcase-theme-x8' ); ?>
					</a>
				<?php endif; ?>
				<a class="btn btn-secondary" href="<?php echo esc_url( home_url( '/?s=' ) ); ?>">
					<?php echo esc_html__( 'Search the site', 'nolan-showcase-theme-x8' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
