<?php get_header();



?>

<div id="content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="right">
            <?php echo  get_the_post_thumbnail( $post_id, 'medium' ); ?>
            <?php the_field('sidebar'); ?>
        </div>
<div id="left">
   <h1> <?php the_title();?></h1>
<?php the_content(); ?>

</div>

        <br/><br/> <br/><br/><?php the_date(); ?><br/><br/>
        <p><?php the_tags(); ?></p>


    <?php endwhile; else: ?>
        <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
    <?php endif; ?>

    <div class="clear"> </div>
</div><!-- content -->
</div><!-- container -->
<?php wp_footer(); ?>
</body>
</html>