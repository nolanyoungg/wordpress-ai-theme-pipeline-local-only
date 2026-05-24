<?php
/**
 * 404 template.
 *
 * @package Nolan_Showcase_Theme_X9
 */

get_header();
?>

<section class="section section--tight">
	<div class="container container--narrow">
		<div class="error" data-reveal>
			<p class="error__kicker"><?php esc_html_e( '404', 'nolan-showcase-theme-x9' ); ?></p>
			<h1 class="error__title"><?php esc_html_e( 'That page isn’t here.', 'nolan-showcase-theme-x9' ); ?></h1>
			<p class="error__copy"><?php esc_html_e( 'Try a search, or jump to one of the main pages below.', 'nolan-showcase-theme-x9' ); ?></p>
			<div class="error__actions">
				<a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go home', 'nolan-showcase-theme-x9' ); ?></a>
				<a class="btn btn-secondary" href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'View work', 'nolan-showcase-theme-x9' ); ?></a>
			</div>
		</div>

		<div class="error-links" data-reveal>
			<ul class="link-grid">
				<li><a href="<?php echo esc_url( home_url( '/what-we-do/' ) ); ?>"><?php esc_html_e( 'What We Do', 'nolan-showcase-theme-x9' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Who We Are', 'nolan-showcase-theme-x9' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Resources', 'nolan-showcase-theme-x9' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nolan-showcase-theme-x9' ); ?></a></li>
			</ul>
		</div>
	</div>
</section>

<?php
get_footer();

