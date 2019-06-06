<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    // Post thumbnail.
    twentyfifteen_post_thumbnail();
    ?>



    <div class="entry-content">



        <div class="mypost">
            <h2> <a href="<?php the_permalink(); ?>"><?php the_date(); ?> </a></h2>

            <?php
            /* translators: %s: Name of current post */
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfifteen') . '</span>',
                'after' => '</div>',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'pagelink' => '<span class="screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>%',
                'separator' => '<span class="screen-reader-text">, </span>',
            ));
            ?>
            <p class="datashit">
                <?php
                $terms = get_field('gens');

                if ($terms):
                    ?>
                Gens  
                    <?php foreach ($terms as $term): ?>
                        <a href="<?php echo get_term_link($term); ?>"><?= $term->name; ?></a> 
                    <?php endforeach; ?>
                
            <?php endif; ?>

            
            <?php // edit_post_link(__('Edit', 'twentyfifteen'), '<span class="edit-link">', '</span>'); ?></p>
        </div>
    </div><!-- .entry-content -->

    <?php
// Author bio.
    if (is_single() && get_the_author_meta('description')) :
        get_template_part('author-bio');
    endif;
    ?>



</article><!-- #post-## -->
