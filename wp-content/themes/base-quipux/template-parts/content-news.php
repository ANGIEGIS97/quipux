<?php
/**
 * Plantilla parcial para mostrar publicaciones de noticias
 * Compatible con el post type 'noticias' registrado por el plugin quipux-api
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-news'); ?>>
    <header class="news-header">
        <?php if (is_singular()) : ?>
            <h1 class="news-title"><?php the_title(); ?></h1>
        <?php else : ?>
            <h2 class="news-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        <?php endif; ?>

        <div class="news-meta">
            <span class="news-date">
                <i class="fas fa-calendar-alt"></i>
                <?php echo get_the_date(); ?>
            </span>
            
            <?php if (get_the_author()) : ?>
                <span class="news-author">
                    <i class="fas fa-user"></i>
                    <?php the_author(); ?>
                </span>
            <?php endif; ?>

            <?php if (has_category()) : ?>
                <span class="news-categories">
                    <i class="fas fa-folder"></i>
                    <?php the_category(', '); ?>
                </span>
            <?php endif; ?>
        </div>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="news-featured-image">
            <?php 
            if (is_singular()) {
                the_post_thumbnail('news-featured', array('class' => 'img-fluid'));
            } else {
                the_post_thumbnail('news-thumbnail', array('class' => 'img-fluid'));
            }
            ?>
        </div>
    <?php endif; ?>

    <div class="news-content">
        <?php
        if (is_singular()) :
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Páginas:', 'base-quipux'),
                'after'  => '</div>',
            ));
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                <?php _e('Leer Más', 'base-quipux'); ?>
            </a>
        <?php endif; ?>
    </div>

    <?php if (is_singular()) : ?>
        <footer class="news-footer">
            <?php if (has_tag()) : ?>
                <div class="news-tags">
                    <i class="fas fa-tags"></i>
                    <?php the_tags('', ', '); ?>
                </div>
            <?php endif; ?>

            <?php
            // Si los comentarios están abiertos o tenemos al menos un comentario, cargamos la plantilla de comentarios
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

            <nav class="navigation post-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e('Navegación de entradas', 'base-quipux'); ?></h2>
                <div class="nav-links">
                    <?php
                    previous_post_link('<div class="nav-previous">%link</div>', '<i class="fas fa-arrow-left"></i> %title');
                    next_post_link('<div class="nav-next">%link</div>', '%title <i class="fas fa-arrow-right"></i>');
                    ?>
                </div>
            </nav>
        </footer>
    <?php endif; ?>
</article> 