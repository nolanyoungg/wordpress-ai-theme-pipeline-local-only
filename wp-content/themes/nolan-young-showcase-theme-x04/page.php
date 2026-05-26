

<?php get_header(); ?>


<main id="content">


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <article <?php post_class(); ?>>


            <h1><?php esc_html(the_title()); ?></h1>


            <div><?php wp_kses_post(the_content()); ?></div>


        </article>


    <?php endwhile; endif; ?>


</main>


<?php get_footer(); ?>


