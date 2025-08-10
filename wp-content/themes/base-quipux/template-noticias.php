<?php
/**
 * Template Name: Plantilla de Noticias Quipux
 */
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <!-- Sección Hero -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <h1 class="main-title"><?php echo get_the_title(); ?></h1>
                        <p class="lead mb-0 text-muted subtitle">Estas son las últimas noticias y actualizaciones</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cuadrícula de Noticias -->
        <section class="news-section">
            <div class="container">
                <div class="row" id="news-grid">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'noticias',
                        'posts_per_page' => 3, // Mostrar 3 noticias por página
                        'paged' => $paged,
                        'post_status' => 'publish'
                    );
                    
                    $news_query = new WP_Query($args);
                    
                    if ($news_query->have_posts()) :
                        while ($news_query->have_posts()) : $news_query->the_post();
                            ?>
                            <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex">
                                <article id="post-<?php the_ID(); ?>" <?php post_class("card h-100 shadow-sm border-0 news-card w-100"); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="position-relative overflow-hidden news-thumbnail">
                                            <a href="<?php the_permalink(); ?>" class="d-block">
                                                <?php 
                                                the_post_thumbnail('medium', array(
                                                    'class' => 'card-img-top img-fluid news-image',
                                                    'loading' => 'lazy'
                                                )); 
                                                ?>
                                            </a>
                                            <div class="position-absolute w-100 h-100 news-overlay" style="top: 0; left: 0;">
                                                <div class="position-absolute" style="top: 15px; left: 15px;">
                                                    <span class="badge badge-primary">
                                                        <?php
                                                        $categories = get_the_terms(get_the_ID(), 'noticias_category');
                                                        if ($categories && !is_wp_error($categories)) {
                                                            echo $categories[0]->name;
                                                        } else {
                                                            echo 'Noticias';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center news-placeholder">
                                            <i class="fas fa-newspaper fa-3x text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="card-body d-flex flex-column">
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center text-muted small">
                                                <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                                                <span class="mr-3"><?php echo get_the_date('d M Y'); ?></span>
                                                <i class="fas fa-user mr-2 text-primary"></i>
                                                <span><?php echo get_the_author(); ?></span>
                                            </div>
                                        </div>
                                        
                                        <h2 class="card-title h5 font-weight-bold mb-3">
                                            <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none stretched-link">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        
                                        <div class="card-text text-muted mb-3 flex-grow-1">
                                            <?php 
                                            if (has_excerpt()) {
                                                echo wp_trim_words(get_the_excerpt(), 20, '...');
                                            } else {
                                                echo wp_trim_words(get_the_content(), 20, '...');
                                            }
                                            ?>
                                        </div>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                </small>
                                                <span class="btn btn-primary">
                                                    <?php _e('Leer más', 'base-quipux'); ?>
                                                    <i class="icon icon-arrow-forward-ios ms-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <?php
                        endwhile;
                        ?>
                        
                        <!-- Paginación -->
                        <div class="col-12">
                            <nav class="pagination-wrapper d-flex justify-content-center" role="navigation" aria-label="Paginación de noticias">
                                <?php
                                $pagination = paginate_links(array(
                                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, get_query_var('paged')),
                                    'total' => $news_query->max_num_pages,
                                    'prev_text' => __('← Anterior', 'base-quipux'),
                                    'next_text' => __('Siguiente →', 'base-quipux'),
                                    'type' => 'plain',
                                    'mid_size' => 2,
                                    'end_size' => 1,
                                ));
                                
                                if ($pagination) {
                                    echo '<div class="pagination-inner d-flex flex-wrap justify-content-center align-items-center">' . $pagination . '</div>';
                                }
                                ?>
                            </nav>
                        </div>
                        
                    <?php else : ?>
                        <!-- No se encontraron noticias -->
                        <div class="col-12">
                            <div class="no-news-found text-center">
                                <div class="mb-4">
                                    <i class="fas fa-newspaper fa-5x text-primary"></i>
                                </div>
                                <h3 class="mb-3"><?php _e('No se encontraron noticias', 'base-quipux'); ?></h3>
                                <p class="text-muted"><?php _e('Vuelve pronto para ver las últimas actualizaciones', 'base-quipux'); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Estilos CSS -->
<style>
/* Variables CSS para consistencia */
:root {
    --primary-color: #007bff;
    --primary-hover: #0056b3;
    --text-dark: #2d3436;
    --text-muted: #636e72;
    --bg-light: #f8f9fa;
    --shadow-light: rgba(0,0,0,0.05);
    --shadow-medium: rgba(0,0,0,0.15);
    --border-radius: 0.5rem;
    --transition: all 0.3s ease;
}

/* Diseño general */
.content-area {
    width: 100%;
    max-width: 100%;
    padding: 0;
    margin: 0;
}

/* Sección Hero */
.hero-section {
    background: none;
    margin-bottom: 2rem;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}

/* Título principal */
.main-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.2;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
}

.main-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background-color: var(--primary-color);
    border-radius: 2px;
}

/* Subtítulo */
.subtitle {
    font-size: 1.35rem;
    color: var(--text-muted);
    margin-top: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Sección de Noticias */
.news-section {
    padding-bottom: 4rem;
}

/* Tarjetas de Noticias */
.news-card {
    transition: var(--transition);
    border-radius: var(--border-radius) !important;
    border: none !important;
    overflow: hidden;
    height: 100%;
}

.news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 1rem 2rem var(--shadow-medium) !important;
}

/* Miniaturas */
.news-thumbnail {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.news-image {
    height: 200px !important;
    width: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.news-card:hover .news-image {
    transform: scale(1.05);
}

.news-placeholder {
    height: 200px;
}

/* Efecto de superposición */
.news-overlay {
    background: linear-gradient(45deg, rgba(0,0,0,0.1) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.news-card:hover .news-overlay {
    opacity: 1;
}

/* Contenido de la tarjeta */
.card-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    height: calc(100% - 200px);
}

/* Título de la tarjeta */
.card-title {
    font-size: 1.1rem;
    line-height: 1.4;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.8rem;
}

.card-title a {
    transition: color 0.3s ease;
}

.card-title a:hover {
    color: var(--primary-color) !important;
}

/* Texto de la tarjeta */
.card-text {
    font-size: 0.9rem;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-grow: 1;
}

/* Paginación mejorada */
.pagination-wrapper {
    margin: 4rem 0 2rem 0;
    width: 100%;
}

.pagination-inner {
    gap: 0.5rem;
}

/* Estilos de los enlaces de paginación */
.pagination-wrapper a,
.pagination-wrapper span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1rem;
    margin: 0.25rem;
    color: var(--primary-color);
    text-decoration: none;
    border: 2px solid #dee2e6;
    border-radius: var(--border-radius);
    transition: var(--transition);
    font-weight: 500;
    min-width: 45px;
    height: 45px;
}

.pagination-wrapper a:hover {
    color: white;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px var(--shadow-light);
}

.pagination-wrapper .current {
    color: white;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    box-shadow: 0 4px 8px var(--shadow-light);
}

.pagination-wrapper .dots {
    border: none;
    background: none;
    color: var(--text-muted);
    cursor: default;
}

.pagination-wrapper .dots:hover {
    background: none;
    transform: none;
    box-shadow: none;
}

/* Mensaje de No hay noticias */
.no-news-found {
    background: white;
    border-radius: 1rem;
    padding: 4rem 2rem;
    margin: 2rem auto;
    box-shadow: 0 0 30px var(--shadow-light);
    max-width: 600px;
}

.no-news-found h3 {
    color: var(--text-dark);
    font-size: 2rem;
    font-weight: 600;
}

.no-news-found p {
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0 auto;
    color: var(--text-muted);
}

/* Animaciones */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.news-card {
    animation: fadeInUp 0.6s ease forwards;
}

/* Retrasos en la animación para cada tarjeta */
.news-card:nth-child(1) { animation-delay: 0.1s; }
.news-card:nth-child(2) { animation-delay: 0.2s; }
.news-card:nth-child(3) { animation-delay: 0.3s; }
.news-card:nth-child(4) { animation-delay: 0.4s; }
.news-card:nth-child(5) { animation-delay: 0.5s; }
.news-card:nth-child(6) { animation-delay: 0.6s; }

/* Diseño Responsivo */
@media (max-width: 1199.98px) {
    .news-card {
        margin-bottom: 2rem;
    }
}

@media (max-width: 991.98px) {
    .main-title {
        font-size: 2rem;
    }
    
    .hero-section {
        padding: 1.5rem 0;
    }
}

@media (max-width: 767.98px) {
    .main-title {
        font-size: 2rem;
    }
    
    .subtitle {
        font-size: 1.1rem;
        padding: 0 1rem;
    }
    
    .hero-section {
        padding: 1rem 0;
        margin-bottom: 1.5rem;
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .pagination-wrapper a,
    .pagination-wrapper span {
        padding: 0.5rem 0.75rem;
        min-width: 40px;
        height: 40px;
        font-size: 0.9rem;
    }
    
    .no-news-found {
        margin: 1rem;
        padding: 3rem 1rem;
    }
    
    .no-news-found h3 {
        font-size: 1.75rem;
    }
    
    .no-news-found p {
        font-size: 1rem;
    }
}

@media (max-width: 575.98px) {
    .main-title {
        font-size: 2rem;
    }
    
    .pagination-inner {
        flex-wrap: wrap;
        justify-content: center !important;
    }
    
    .pagination-wrapper a,
    .pagination-wrapper span {
        margin: 0.125rem;
    }
}

/* Mejoras de accesibilidad */
@media (prefers-reduced-motion: reduce) {
    .news-card,
    .news-image,
    .pagination-wrapper a {
        transition: none;
        animation: none;
    }
    
    .news-card:hover {
        transform: none;
    }
    
    .news-card:hover .news-image {
        transform: none;
    }
}

/* Estados de foco para accesibilidad */
.news-card a:focus,
.pagination-wrapper a:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Desplazamiento suave para la paginación
    const paginationLinks = document.querySelectorAll('.pagination-wrapper a');
    
    paginationLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            if (this.getAttribute('href') && this.getAttribute('href').indexOf('#') === -1) {
                // Pequeño retraso para permitir que la página se cargue
                setTimeout(function() {
                    const newsGrid = document.getElementById('news-grid');
                    if (newsGrid) {
                        const offset = 100;
                        const elementPosition = newsGrid.offsetTop;
                        const offsetPosition = elementPosition - offset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }, 100);
            }
        });
    });
    
    // Carga diferida mejorada para imágenes
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('.news-image').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Mejorar la experiencia táctil
    if ('ontouchstart' in window) {
        document.querySelectorAll('.news-card').forEach(card => {
            card.addEventListener('touchstart', function() {
                this.classList.add('touch-hover');
            });
            
            card.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.classList.remove('touch-hover');
                }, 300);
            });
        });
    }
});
</script>

<?php get_footer(); ?>

