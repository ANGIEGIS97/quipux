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

// Nota: El post type 'noticias' es registrado por el plugin quipux-api
// para mantener la funcionalidad consistente y seguir las mejores prácticas

// Nota: Los tamaños de imagen para noticias son manejados por el plugin quipux-api

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

// Configurar estructura de permalinks por defecto
function base_quipux_set_permalink_structure() {
    // Solo configurar si no se ha configurado antes o si está en la estructura por defecto
    $current_structure = get_option('permalink_structure');
    if (empty($current_structure) || $current_structure === '/?p=%post_id%') {
        // Estructura: /%year%/%monthnum%/%day%/%postname%/
        // Esto corresponde al formato "Día y nombre"
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%year%/%monthnum%/%day%/%postname%/');
        $wp_rewrite->flush_rules();
        
        // Actualizar la opción en la base de datos
        update_option('permalink_structure', '/%year%/%monthnum%/%day%/%postname%/');
    }
}
add_action('after_setup_theme', 'base_quipux_set_permalink_structure');

// Configurar este tema como el tema activo por defecto
function base_quipux_activate_theme() {
    // Verificar si este tema no está activo y activarlo
    $current_theme = get_option('stylesheet');
    if ($current_theme !== 'base-quipux') {
        switch_theme('base-quipux');
        
        // Flush rewrite rules para asegurar que los permalinks funcionen
        flush_rewrite_rules();
    }
}
add_action('init', 'base_quipux_activate_theme', 1); 