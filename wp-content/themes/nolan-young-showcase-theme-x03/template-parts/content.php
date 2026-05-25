

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <header class="entry-header">


        <?php if (is_singular()) : ?>


            <h1 class="entry-title"><?php the_title(); ?></h1>


        <?php else : ?>


            <h2 class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>


        <?php endif; ?>





        <?php if ('post' === get_post_type()) : ?>


            <div class="entry-meta">


                <?php


                nolan_young_showcase_posted_on();


                nolan_young_showcase_posted_by();


                ?>


            </div><!-- .entry-meta -->


        <?php endif; ?>


    </header><!-- .entry-header -->





    <div class="entry-content">


        <?php


        the_content(


            sprintf(


                wp_kses(


                    /* translators: %s: Name of current post. Only visible to screen readers */


                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'nolan-young-showcase-theme-x02'),


                    array(


                        'span' => array(


                            'class' => array(),


                        ),


                    )


                ),


                esc_html(get_the_title())


            )


        );





        wp_link_pages(array(


            'before' => '<div class="page-links">' . esc_html__('Pages:', 'nolan-young-showcase-theme-x02'),


            'after'  => '</div>',


        ));


        ?>


    </div><!-- .entry-content -->





    <footer class="entry-footer">


        <?php nolan_young_showcase_entry_footer(); ?>


    </footer><!-- .entry-footer -->


</article><!-- #post-<?php the_ID(); ?> -->


