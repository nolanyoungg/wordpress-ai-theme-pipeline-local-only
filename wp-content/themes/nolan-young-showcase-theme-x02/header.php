

<!DOCTYPE html>


<html <?php language_attributes(); ?>>


<head>


    <meta charset="<?php bloginfo('charset'); ?>">


    <meta name="viewport" content="width=device-width, initial-scale=1">


    <?php wp_head(); ?>


</head>


<body <?php body_class(); ?>>





<header>


    <div class="nolan-menu">


        <div class="nolan-menu__brand">


            <a href="<?php echo esc_url(home_url('/')); ?>">


                <?php the_custom_logo(); ?>


                <span><?php bloginfo('name'); ?></span>


            </a>


        </div>





        <nav class="nolan-menu__nav">


            <ul class="nolan-menu__list">


                <li class="nolan-menu__item">


                    <button class="nolan-menu__trigger" data-menu-item="what-we-do">What We Do</button>


                </li>


                <li class="nolan-menu__item">


                    <button class="nolan-menu__trigger" data-menu-item="who-we-are">Who We Are</button>


                </li>


                <li class="nolan-menu__item">


                    <a href="<?php echo esc_url(home_url('/work')); ?>">Work</a>


                </li>


                <li class="nolan-menu__item">


                    <button class="nolan-menu__trigger" data-menu-item="resources">Resources</button>


                </li>


            </ul>





            <div class="nolan-menu__cta">


                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-header-cta">Contact Us</a>


            </div>


        </nav>





        <div class="nolan-menu-mobile">


            <button aria-expanded="false" class="mobile-menu-toggle">Menu</button>


            <!-- Add mobile menu here -->


        </div>


    </div>


</header>


