<?php
/**
 * Comments template.
 *
 * @package Nolan_Showcase_Theme_X5
 */

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === (int) $comment_count ) {
				esc_html_e( 'One comment', 'nolan-showcase-theme-x5' );
			} else {
				printf(
					/* translators: %s: comment count */
					esc_html__( '%s comments', 'nolan-showcase-theme-x5' ),
					esc_html( number_format_i18n( $comment_count ) )
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nolan-showcase-theme-x5' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</section>

