
<?php
/*
Template Name: Noticias
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_type' => 'news',
            'posts_per_page' => 10,
            'paged' => $paged,
        );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php _e( 'News', 'base-quipux' ); ?></h1>
            </header><!-- .page-header -->

            <?php
            /* Start the Loop */
            while ( $query->have_posts() ) : $query->the_post();

                get_template_part( 'template-parts/content', 'news' );

            endwhile;

            the_posts_pagination( array(
                'prev_text' => __( 'Previous', 'base-quipux' ),
                'next_text' => __( 'Next', 'base-quipux' ),
            ) );

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer();
