<?php get_header();



?>

<div id="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="right">
            <?php the_field('sidebar'); ?>
        </div>
        <div id="left">
            <?php the_content(); ?>

        </div>



    <?php endwhile; else: ?>
        <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
    <?php endif; ?>

    <div class="clear"> </div>
</div><!-- content -->
</div><!-- container -->
<?php wp_footer(); ?>
</body>
</html>