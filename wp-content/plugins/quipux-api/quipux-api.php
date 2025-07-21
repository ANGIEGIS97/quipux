<?php
/*
Plugin Name: Quipux API
Plugin URI: https://quipux.com
Description: Un plugin personalizado para exponer una API REST para noticias.
Version: 1.0
Author: Angie Rios
License: GPLv2 or later
Text Domain: quipux-api
*/

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class QuipuxAPI {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('rest_api_init', array($this, 'register_routes'));
    }
    
    public function init() {
        $this->register_news_post_type();
        $this->flush_rewrite_rules_once();
    }
    
    public function register_news_post_type() {
        $labels = array(
            'name' => _x('Noticias', 'Post type general name', 'quipux-api'),
            'singular_name' => _x('Noticia', 'Post type singular name', 'quipux-api'),
            'menu_name' => _x('Noticias', 'Admin Menu text', 'quipux-api'),
            'add_new' => __('Añadir Nueva', 'quipux-api'),
            'add_new_item' => __('Añadir Nueva Noticia', 'quipux-api'),
            'edit_item' => __('Editar Noticia', 'quipux-api'),
            'view_item' => __('Ver Noticia', 'quipux-api'),
            'all_items' => __('Todas las Noticias', 'quipux-api'),
            'search_items' => __('Buscar Noticias', 'quipux-api'),
            'not_found' => __('No se encontraron noticias.', 'quipux-api'),
            'not_found_in_trash' => __('No se encontraron noticias en la papelera.', 'quipux-api'),
        );
        
        $args = array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'noticias'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            'show_in_rest' => false, // Desactivamos la API v2 automática
        );
        
        register_post_type('noticias', $args);
    }
    
    private function flush_rewrite_rules_once() {
        if (!get_option('quipux_api_initialized')) {
            flush_rewrite_rules();
            update_option('quipux_api_initialized', true);
        }
    }
    
    public function register_routes() {
        // Endpoint para obtener todas las noticias
        register_rest_route('quipux-api/v1', '/noticias', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_news'),
            'permission_callback' => '__return_true'
        ));
        
        // Endpoint para obtener una noticia específica
        register_rest_route('quipux-api/v1', '/noticias/(?P<id>\d+)', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_news_item'),
            'permission_callback' => '__return_true'
        ));
    }
    
    public function get_news($request) {
        $args = array(
            'post_type' => 'noticias',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'paged' => $request->get_param('page') ?: 1,
        );
        
        $query = new WP_Query($args);
        $posts = array();
        
        foreach ($query->posts as $post) {
            $posts[] = $this->format_news_item($post);
        }
        
        return new WP_REST_Response($posts, 200);
    }
    
    public function get_news_item($request) {
        $post = get_post($request['id']);
        
        if (empty($post) || $post->post_type !== 'noticias' || $post->post_status !== 'publish') {
            return new WP_Error('not_found', 'Noticia no encontrada', array('status' => 404));
        }
        
        return new WP_REST_Response($this->format_news_item($post), 200);
    }
    
    private function format_news_item($post) {
        return array(
            'id' => $post->ID,
            'titulo' => $post->post_title,
            'contenido' => $post->post_content,
            'extracto' => $post->post_excerpt,
            'autor' => get_the_author_meta('display_name', $post->post_author),
            'fecha' => $post->post_date,
            'imagen_destacada' => get_the_post_thumbnail_url($post->ID, 'full') ?: '',
        );
    }
}

// Inicializar el plugin
new QuipuxAPI();