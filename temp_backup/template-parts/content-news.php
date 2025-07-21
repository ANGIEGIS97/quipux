
<?php
/**
 * Template part for displaying news posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package base-quipux
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'news' === get_post_type() ) :
        ?>
            <div class="entry-meta">
                <?php
                // Display the post date
                echo '<span class="posted-on">';
                echo sprintf(
                    /* translators: %s: post date */
                    esc_html__('Posted on %s', 'base-quipux'),
                    '<time class="entry-date published" datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>'
                );
                echo '</span>';
                
                // Display the author if needed
                echo '<span class="byline">';
                echo sprintf(
                    /* translators: %s: post author */
                    esc_html__('by %s', 'base-quipux'),
                    '<span class="author vcard">' . esc_html(get_the_author()) . '</span>'
                );
                echo '</span>';
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="entry-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large', array('class' => 'img-fluid')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) :
            the_content();
        else :
            echo '<div class="entry-summary">';
            the_excerpt();
            echo '<a href="' . esc_url(get_permalink()) . '" class="read-more btn btn-primary">' . 
                 esc_html__('Read More', 'base-quipux') . 
                 '</a>';
            echo '</div>';
        endif;

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'base-quipux'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php if (is_singular()) : ?>
        <footer class="entry-footer">
            <?php
            $categories_list = get_the_category_list(esc_html__(', ', 'base-quipux'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'base-quipux') . '</span>', $categories_list);
            }

            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'base-quipux'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'base-quipux') . '</span>', $tags_list);
            }
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
