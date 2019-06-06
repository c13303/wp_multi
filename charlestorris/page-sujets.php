<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <h1 class="page-title">Sujets</h1>			
        </header>
        <article>
            <div class="entry-content">
                <div class="mypost">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'post_tag',
                        'orderby' => 'count',
                        'order' => 'desc',
                        'hide_empty' => false,
                    ));
                    foreach ($terms as $term) {
                        ?> <br/><a href="<?php echo get_term_link($term); ?>"><?= ucfirst($term->name); ?></a> (<?= $term->count; ?>) <?php
                    }
                    ?>
                </div>
            </div>
        </article>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
