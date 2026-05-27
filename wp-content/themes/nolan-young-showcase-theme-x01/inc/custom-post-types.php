







<?php








/**








 * Custom Post Types for Nolan Young Showcase Theme X01.








 *








 * @package Nolan_Young_Showcase_Theme_X01








 */

















if ( ! defined( 'ABSPATH' ) ) {








    exit; // Exit if accessed directly.








}

















/**








 * Register custom post types.








 */








function nolan_young_register_custom_post_types() {








    // Portfolio Post Type








    $portfolio_labels = array(








        'name'                  => _x( 'Portfolio', 'Post type general name', 'nolan-young-showcase-theme-x01' ),








        'singular_name'         => _x( 'Portfolio Item', 'Post type singular name', 'nolan-young-showcase-theme-x01' ),








        'menu_name'             => _x( 'Portfolio', 'Admin Menu text', 'nolan-young-showcase-theme-x01' ),








        'name_admin_bar'        => _x( 'Portfolio Item', 'Add New on Toolbar', 'nolan-young-showcase-theme-x01' ),








        'add_new'               => __( 'Add New', 'nolan-young-showcase-theme-x01' ),








        'add_new_item'          => __( 'Add New Portfolio Item', 'nolan-young-showcase-theme-x01' ),








        'new_item'              => __( 'New Portfolio Item', 'nolan-young-showcase-theme-x01' ),








        'edit_item'             => __( 'Edit Portfolio Item', 'nolan-young-showcase-theme-x01' ),








        'view_item'             => __( 'View Portfolio Item', 'nolan-young-showcase-theme-x01' ),








        'all_items'             => __( 'All Portfolio Items', 'nolan-young-showcase-theme-x01' ),








        'search_items'          => __( 'Search Portfolio Items', 'nolan-young-showcase-theme-x01' ),








        'parent_item_colon'     => __( 'Parent Portfolio Items:', 'nolan-young-showcase-theme-x01' ),








        'not_found'             => __( 'No portfolio items found.', 'nolan-young-showcase-theme-x01' ),








        'not_found_in_trash'    => __( 'No portfolio items found in Trash.', 'nolan-young-showcase-theme-x01' ),








        'featured_image'        => _x( 'Portfolio Item Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'nolan-young-showcase-theme-x01' ),








        'set_featured_image'    => _x( 'Set portfolio item image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'nolan-young-showcase-theme-x01' ),








        'remove_featured_image' => _x( 'Remove portfolio item image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'nolan-young-showcase-theme-x01' ),








        'use_featured_image'    => _x( 'Use as portfolio item image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'nolan-young-showcase-theme-x01' ),








        'archives'              => _x( 'Portfolio Item Archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.1', 'nolan-young-showcase-theme-x01' ),








        'insert_into_item'      => _x( 'Insert into portfolio item', 'Overrides the “Insert into post”/“Insert into page” phrase (used when inserting media into a post). Added in 4.2', 'nolan-young-showcase-theme-x01' ),








        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio item', 'Overrides the “Uploaded to this post”/“Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.2', 'nolan-young-showcase-theme-x01' ),








        'filter_items_list'     => _x( 'Filter portfolio items list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/“Filter pages list”. Added in 4.4', 'nolan-young-showcase-theme-x01' ),








        'items_list_navigation' => _x( 'Portfolio items list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/“Pages list navigation”. Added in 4.4', 'nolan-young-showcase-theme-x01' ),








        'items_list'            => _x( 'Portfolio items list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/“Pages list”. Added in 4.4', 'nolan-young-showcase-theme-x01' ),








    );

















    $portfolio_args = array(








        'labels'             => $portfolio_labels,








        'public'             => true,








        'publicly_queryable' => true,








        'show_ui'            => true,








        'show_in_menu'       => true,








        'query_var'          => true,








        'rewrite'            => array( 'slug' => 'portfolio' ),








        'capability_type'    => 'post',








        'has_archive'        => true,








        'hierarchical'       => false,








        'menu_position'      => null,








        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),








    );

















    register_post_type( 'portfolio', $portfolio_args );








}

















add_action( 'init', 'nolan_young_register_custom_post_types' );








