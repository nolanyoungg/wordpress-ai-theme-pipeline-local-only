

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <header class="entry-header">


        <?php if (get_the_title()) : ?>


            <h1 class="entry-title"><?php the_title(); ?></h1>


        <?php endif; ?>


    </header><!-- .entry-header -->





    <div class="entry-content">


        <?php


        the_content();





        wp_link_pages(array(


            'before' => '<div class="page-links">' . esc_html__('Pages:', 'nolan-young-showcase-theme-x02'),


            'after'  => '</div>',


        ));


        ?>


    </div><!-- .entry-content -->





    <footer class="entry-footer">


        <?php


        edit_post_link(


            sprintf(


                wp_kses(


                    /* translators: %s: Name of current post. Only visible to screen readers */


                    __('Edit <span class="screen-reader-text">%s</span>', 'nolan-young-showcase-theme-x02'),


                    array(


                        'span' => array(


                            'class' => array(),


                        ),


                    )


                ),


                esc_html(get_the_title())


            ),


            '<span class="edit-link">',


            '</span>'


        );


        ?>


    </footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->


