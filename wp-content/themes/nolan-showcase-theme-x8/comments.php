<?php
/**
 * Comments template.
 *
 * @package Nolan_Showcase_Theme_X8
 */

if ( post_password_required() ) {
	return;
}
?>

<section class="comments-area" id="comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = (int) get_comments_number();
			printf(
				/* translators: %d: number of comments */
				esc_html( _n( '%d Comment', '%d Comments', $comment_count, 'nolan-showcase-theme-x8' ) ),
				esc_html( (string) $comment_count )
			);
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

	<?php if ( comments_open() ) : ?>
		<div class="comment-form-wrap">
			<?php comment_form(); ?>
		</div>
	<?php endif; ?>
</section>

