<?php
/**
 * Funciones y definiciones del tema Base Quipux
 */

// Cargar estilos del tema padre y del tema hijo
function base_quipux_enqueue_styles() {
    wp_enqueue_style('wp-bootstrap-starter-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style('base-quipux-style',
        get_stylesheet_uri(),
        array('wp-bootstrap-starter-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'base_quipux_enqueue_styles');

// Cargar hoja de estilos de iconos externos de Quipux
function base_quipux_enqueue_external_styles() {
    wp_enqueue_style('quipux-icons', 
        'https://cdn.quipux.com/resources/icons/qicons/style.css',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'base_quipux_enqueue_external_styles');

// Registrar Tipo de Publicación Personalizada para Noticias
function base_quipux_register_news_post_type() {
    $labels = array(
        'name'                  => _x('Noticias', 'Nombre general del tipo de publicación', 'base-quipux'),
        'singular_name'         => _x('Noticia', 'Nombre singular del tipo de publicación', 'base-quipux'),
        'menu_name'            => _x('Noticias', 'Texto del Menú Admin', 'base-quipux'),
        'name_admin_bar'       => _x('Noticia', 'Agregar Nueva en la Barra de Herramientas', 'base-quipux'),
        'add_new'              => __('Agregar Nueva', 'base-quipux'),
        'add_new_item'         => __('Agregar Nueva Noticia', 'base-quipux'),
        'new_item'             => __('Nueva Noticia', 'base-quipux'),
        'edit_item'            => __('Editar Noticia', 'base-quipux'),
        'view_item'            => __('Ver Noticia', 'base-quipux'),
        'all_items'            => __('Todas las Noticias', 'base-quipux'),
        'search_items'         => __('Buscar Noticias', 'base-quipux'),
        'not_found'            => __('No se encontraron noticias.', 'base-quipux'),
        'not_found_in_trash'   => __('No se encontraron noticias en la papelera.', 'base-quipux'),
        'featured_image'       => __('Imagen Destacada de la Noticia', 'base-quipux'),
        'set_featured_image'   => __('Establecer imagen destacada', 'base-quipux'),
        'remove_featured_image'=> __('Eliminar imagen destacada', 'base-quipux'),
        'archives'             => __('Archivo de noticias', 'base-quipux'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'noticias'),
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
        'show_in_rest'       => true, // Habilitar editor Gutenberg
    );

    register_post_type('news', $args);
}
add_action('init', 'base_quipux_register_news_post_type');

// Agregar tamaños de imagen personalizados para noticias
function base_quipux_add_image_sizes() {
    add_image_size('news-thumbnail', 370, 250, true);
    add_image_size('news-featured', 1200, 675, true);
}
add_action('after_setup_theme', 'base_quipux_add_image_sizes');

// Modificar longitud del extracto para publicaciones de noticias
function base_quipux_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'base_quipux_custom_excerpt_length', 999);

// Modificar texto "leer más" del extracto
function base_quipux_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'base_quipux_excerpt_more');

// Agregar clases de Bootstrap a la paginación
function base_quipux_pagination_classes($html) {
    $html = str_replace('class="page-numbers"', 'class="page-numbers page-link"', $html);
    $html = str_replace('class="prev page-numbers"', 'class="page-numbers page-link prev"', $html);
    $html = str_replace('class="next page-numbers"', 'class="page-numbers page-link next"', $html);
    $html = str_replace('class="current"', 'class="page-numbers current page-link"', $html);
    return $html;
}
add_filter('paginate_links', 'base_quipux_pagination_classes'); 

// Eliminar plantillas de página del tema padre
function base_quipux_remove_page_templates($page_templates) {
    unset($page_templates['blank-page-with-container.php']);
    unset($page_templates['blank-page.php']);
    return $page_templates;
}
add_filter('theme_page_templates', 'base_quipux_remove_page_templates'); 