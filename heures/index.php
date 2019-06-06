<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $idu = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_NUMBER_INT);


        $iduq = $idu ? 'author="' . $idu . '"' : '';
        $ajax = '[ajax_load_more id="3796901420" post_type="post" posts_per_page="12" ' . $iduq . ']';
        if ($idu) {
            $user = get_user_by('ID',$idu);
            ?>
        <h1><?= get_field('heure','user_'.$idu); ?> - <?= $user->display_name; ?></h1><?php
        }

        echo do_shortcode($ajax);
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
