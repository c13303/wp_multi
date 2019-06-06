<?php get_header(); ?>

    <div id="content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_content(); ?>
                <?php if ( !is_singular() && get_the_title() == '' ) : ?>
                    <a href="<?php the_permalink(); ?>">(more...)</a>
                <?php endif; ?>
                <?php if ( is_singular() ) : ?>
                    <div class="pagination"><?php wp_link_pages(); ?></div>
                <?php endif; ?>
                <div class="clear"> </div>  <?php dynamic_sidebar( 'Widgets' ); ?>
            </div><!-- post_class() -->
            <?php if ( is_singular() ) : ?>


                <div id="myside">
                    <?php
                    $side=get_field('sidebar');
                    print_r($side);

                    ?>
                </div>


            <?php endif; ?>
        <?php endwhile; else: ?>
            <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
        <?php endif; ?>










        <div class="clear"> </div>
    </div><!-- content -->
</div><!-- container -->
<?php wp_footer(); ?>
</body>
</html>