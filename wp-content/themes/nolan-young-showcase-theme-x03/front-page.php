<?php get_header(); ?>

<main id="content">
	<section class="hero">
		<div class="hero-copy">
			<p class="kicker">Premium studio showcase</p>
			<h1>Bright, editorial, and intentionally composed for portfolio storytelling.</h1>
			<p class="lede">A warm, magazine-like homepage built for strong first impressions, accessible navigation, and a clean visual rhythm.</p>
			<div class="hero-actions">
				<a class="button button-primary" href="#featured-work">Explore Work</a>
				<a class="button button-secondary" href="#contact">Book a Session</a>
			</div>
		</div>

		<div class="hero-card" aria-label="Selected project spotlight">
			<div class="hero-card__image" role="img" aria-label="Abstract editorial composition"></div>
			<div class="hero-card__meta">
				<span>Selected Project</span>
				<strong>Northlight Residency</strong>
			</div>
		</div>
	</section>

	<section class="content-section" aria-label="Highlights">
		<div class="feature-strip">
			<div>
				<strong>15+</strong>
				<span>Years of craft-led work</span>
			</div>
			<div>
				<strong>3</strong>
				<span>Core service tracks</span>
			</div>
			<div>
				<strong>02</strong>
				<span>Current showcase edition</span>
			</div>
		</div>
	</section>

	<section class="content-section" id="featured-work">
		<div class="section-head">
			<p class="kicker">Featured Work</p>
			<h2>Selected compositions with clean framing and strong contrast.</h2>
		</div>
		<div class="cards-grid">
			<article class="card">
				<div class="card__visual card__visual--a"></div>
				<h3>Studio Portrait Series</h3>
				<p>Quiet light, layered shadows, and sharp, readable composition.</p>
			</article>
			<article class="card">
				<div class="card__visual card__visual--b"></div>
				<h3>Brand Launch Story</h3>
				<p>A compact set of images designed to carry a homepage and campaign.</p>
			</article>
			<article class="card">
				<div class="card__visual card__visual--c"></div>
				<h3>Before and After</h3>
				<p>Simple side-by-side framing for retouching or transformation stories.</p>
			</article>
		</div>
	</section>

	<section class="content-section">
		<div class="section-head">
			<p class="kicker">Spotlight Stories</p>
			<h2>Carousel-style panels with a tactile editorial rhythm.</h2>
		</div>
		<div class="spotlight-grid">
			<article class="panel-card">
				<span>01</span>
				<h3>Process-first creative direction</h3>
				<p>Every project starts with mood, pacing, and usable output requirements.</p>
			</article>
			<article class="panel-card">
				<span>02</span>
				<h3>Images that work as a system</h3>
				<p>Hero crops, details, and supporting frames are planned together.</p>
			</article>
			<article class="panel-card">
				<span>03</span>
				<h3>Readable on desktop and mobile</h3>
				<p>Layout scales without relying on remote resources or runtime APIs.</p>
			</article>
		</div>
	</section>

	<section class="content-section">
		<div class="section-head">
			<p class="kicker">Client Testimonials</p>
			<h2>Rotating quotes represented with a static card set.</h2>
		</div>
		<div class="testimonial-grid">
			<blockquote class="testimonial">
				<p>“The presentation feels polished without getting fussy.”</p>
				<footer>Studio client</footer>
			</blockquote>
			<blockquote class="testimonial">
				<p>“The navigation and hierarchy make the homepage easy to scan.”</p>
				<footer>Brand partner</footer>
			</blockquote>
		</div>
	</section>

	<section class="content-section" id="contact">
		<div class="section-head">
			<p class="kicker">Contact</p>
			<h2>A preview-ready landing section for bookings and inquiries.</h2>
		</div>
		<div class="contact-card">
			<p>Use this area to route users toward a booking form, email contact, or a project intake page.</p>
			<a class="button button-primary" href="mailto:hello@example.com">hello@example.com</a>
		</div>
	</section>
</main>

<?php get_footer(); ?>
