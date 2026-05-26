

<article <?php post_class(); ?>>


    <h2><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h2>


    <div><?php wp_kses_post(the_excerpt()); ?></div>


</article>


