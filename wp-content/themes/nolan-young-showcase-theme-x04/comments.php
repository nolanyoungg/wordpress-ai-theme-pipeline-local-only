

<div id="comments">


    <?php if (have_comments()) : ?>


        <h2><?php echo esc_html(get_comments_number()); ?> Comments</h2>


        <ol class="comment-list">


            <?php wp_list_comments(); ?>


        </ol>


    <?php endif; ?>





    <?php comment_form(); ?>


</div>


