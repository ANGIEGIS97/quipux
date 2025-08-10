<?php
// Enable REST API
define('REST_API_ENABLED', true);

// Enable debugging
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// Configurar tema por defecto
define('WP_DEFAULT_THEME', 'base-quipux');

// Hook para activar el tema por defecto automáticamente
add_action('after_setup_theme', function() {
    $current_theme = get_option('stylesheet');
    if (empty($current_theme) || $current_theme !== 'base-quipux') {
        switch_theme('base-quipux');
    }
});
?> 