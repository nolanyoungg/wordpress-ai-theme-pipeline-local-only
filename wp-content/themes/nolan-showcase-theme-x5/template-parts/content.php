<?php
/**
 * Template part for displaying posts.
 *
 * @package Nolan_Showcase_Theme_X5
 */

$fallback_image = nolan_showcase_x5_image_url( 'gallery-black-white-portrait.svg' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card reveal' ); ?>>
	<p class="eyebrow"><?php echo esc_html( get_the_date() ); ?></p>

	<?php if ( is_singular() ) : ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
	<?php else : ?>
		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php endif; ?>

	<div class="post-thumb frame">
		<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large' ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( $fallback_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
			<?php endif; ?>
		</a>
	</div>

	<div class="entry-content">
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			the_excerpt();
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nolan-showcase-theme-x5' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>

