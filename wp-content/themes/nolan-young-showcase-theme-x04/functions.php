

<?php





function nolan_young_showcase_setup() {


    add_theme_support('title-tag');


    add_theme_support('post-thumbnails');


    add_theme_support('custom-logo');


    add_theme_support('automatic-feed-links');


    add_theme_support('responsive-embeds');


    add_theme_support('html5', array(


        'search-form',


        'comment-form',


        'comment-list',


        'gallery',


        'caption',


        'style',


        'script',


    ));





    register_nav_menus(array(


        'primary' => esc_html__('Primary Menu', 'nolan-young-showcase-theme-x04'),


        'footer'  => esc_html__('Footer Menu', 'nolan-young-showcase-theme-x04'),


    ));





    register_sidebar(array(


        'name'          => esc_html__('Sidebar', 'nolan-young-showcase-theme-x04'),


        'id'            => 'sidebar-1',


        'description'   => esc_html__('Add widgets here.', 'nolan-young-showcase-theme-x04'),


        'before_widget' => '<section id="%1$s" class="widget %2$s">',


        'after_widget'  => '</section>',


        'before_title'  => '<h2 class="widget-title">',


        'after_title'   => '</h2>',


    ));


}


add_action('after_setup_theme', 'nolan_young_showcase_setup');





function nolan_young_showcase_enqueue_assets() {


    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/theme.css', array(), filemtime(get_template_directory() . '/assets/css/theme.css'));


    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/theme.js', array(), filemtime(get_template_directory() . '/assets/js/theme.js'), true);


}


add_action('wp_enqueue_scripts', 'nolan_young_showcase_enqueue_assets');





?>


