<?php get_header();
query_posts('cat=2');


?>

<div id="content" class="mozaic">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


        <a href="<?php the_permalink(); ?>">  <?php
            echo  get_the_post_thumbnail( $post_id, 'medium' );         // Medium resolution



            ?>
        </a>


    <?php endwhile; else: ?>
        <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
    <?php endif; ?>



    <div class="clear"> </div>
</div><!-- content -->
</div><!-- container -->
<?php wp_footer(); ?>
</body>
</html>