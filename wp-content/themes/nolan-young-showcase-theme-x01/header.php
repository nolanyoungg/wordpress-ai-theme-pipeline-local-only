







```php








<!DOCTYPE html>








<html <?php language_attributes(); ?>>








<head>








    <meta charset="<?php bloginfo( 'charset' ); ?>">








    <meta name="viewport" content="width=device-width, initial-scale=1">








    <?php wp_head(); ?>








</head>








<body <?php body_class(); ?>>








    <header id="site-header" class="sticky-header">








        <div class="container">








            <div class="logo-wordmark">








                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">








                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">








                    <span><?php bloginfo( 'name' ); ?></span>








                </a>








            </div>








            <nav class="primary-navigation">








                <?php








                wp_nav_menu(array(








                    'theme_location' => 'primary',








                    'container'      => false,








                    'menu_class'     => 'nav-menu',








                    'fallback_cb'    => '__return_false'








                ));








                ?>








            </nav>








            <div class="contact-cta">








                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Contact Us</a>








            </div>








        </div>








    </header>

















    <?php wp_body_open(); ?>














