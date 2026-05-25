

<?php get_header(); ?>





<main>


    <h1><?php esc_html_e('Archives', 'nolan-young-showcase-theme-x01'); ?></h1>





    <?php


    if (have_posts()) {


        while (have_posts()) {


            the_post();


            get_template_part('template-parts/content');


        }


    } else {


        get_template_part('template-parts/content-none');


    }


    ?>


</main>





<?php get_footer(); ?>


