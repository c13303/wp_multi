<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>

<section id="primary" class="site-content">
    <div id="content" role="main">

        <?php if (have_posts()) : ?>
            <header class="archive-header">
                <h1 class="archive-title">
                    <?php printf('<span>' . single_cat_title('', false) . '</span>'); ?></h1>
            </header><!-- .archive-header -->

            <?php
            /* Start the Loop */
            while (have_posts()) : the_post();
                ?>

                <?php $image = get_field('peinture', $post->ID); ?>

                <a href="<?= $image['url']; ?>" data-lightbox="<?= single_cat_title('', false); ?>" 
                   data-title="<?php the_title(); ?> <?php the_content(); ?>"
                   >
                    <img src="<?= $image['sizes']['thumbnail']; ?>" />                            
                </a>

                </article><!-- #post -->

                <?php
            endwhile;
            ?>

        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>

    </div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
