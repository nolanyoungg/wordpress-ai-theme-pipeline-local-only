

<article <?php post_class(); ?>>


    <h1><?php esc_html(the_title()); ?></h1>


    <div><?php wp_kses_post(the_content()); ?></div>


</article>


