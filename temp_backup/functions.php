
<?php
/**
 * Base Quipux functions and definitions
 */

if (!defined('_S_VERSION')) {
    // Replace the version number as needed
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function base_quipux_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title.
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for custom logo
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'base_quipux_setup');

/**
 * Register custom post type for News
 */
function base_quipux_register_news_post_type() {
    $labels = array(
        'name'                  => _x('News', 'Post type general name', 'base-quipux'),
        'singular_name'         => _x('News', 'Post type singular name', 'base-quipux'),
        'menu_name'            => _x('News', 'Admin Menu text', 'base-quipux'),
        'name_admin_bar'       => _x('News', 'Add New on Toolbar', 'base-quipux'),
        'add_new'              => __('Add New', 'base-quipux'),
        'add_new_item'         => __('Add New News', 'base-quipux'),
        'new_item'             => __('New News', 'base-quipux'),
        'edit_item'            => __('Edit News', 'base-quipux'),
        'view_item'            => __('View News', 'base-quipux'),
        'all_items'            => __('All News', 'base-quipux'),
        'search_items'         => __('Search News', 'base-quipux'),
        'not_found'            => __('No news found.', 'base-quipux'),
        'not_found_in_trash'   => __('No news found in Trash.', 'base-quipux'),
        'featured_image'       => __('News Featured Image', 'base-quipux'),
        'set_featured_image'   => __('Set featured image', 'base-quipux'),
        'remove_featured_image'=> __('Remove featured image', 'base-quipux'),
        'archives'             => __('News archives', 'base-quipux'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'news'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments',
            'revisions',
        ),
        'show_in_rest'       => true, // Enable Gutenberg editor
    );

    register_post_type('news', $args);
}
add_action('init', 'base_quipux_register_news_post_type');

/**
 * Enqueue scripts and styles.
 */
function base_quipux_scripts() {
    wp_enqueue_style('base-quipux-style', get_stylesheet_uri(), array(), _S_VERSION);
    
    // Add Bootstrap CSS from parent theme if needed
    wp_enqueue_style('base-quipux-bootstrap', 
        get_template_directory_uri() . '/css/bootstrap.min.css', 
        array(), 
        _S_VERSION
    );

    // Add custom CSS for news
    wp_enqueue_style('base-quipux-news',
        get_stylesheet_directory_uri() . '/css/news.css',
        array('base-quipux-bootstrap'),
        _S_VERSION
    );
}
add_action('wp_enqueue_scripts', 'base_quipux_scripts');

/**
 * Add custom image sizes for news
 */
function base_quipux_add_image_sizes() {
    add_image_size('news-thumbnail', 370, 250, true);
    add_image_size('news-featured', 1200, 675, true);
}
add_action('after_setup_theme', 'base_quipux_add_image_sizes');

/**
 * Modify the excerpt length for news posts
 */
function base_quipux_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'base_quipux_custom_excerpt_length', 999);

/**
 * Modify the excerpt "read more" text
 */
function base_quipux_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'base_quipux_excerpt_more');
