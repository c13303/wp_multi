<?php
/**
 * A Simple Category Template
 */
get_header();
?> 

<section id="primary" class="site-content">
    <div id="content" role="main">
        <a href="/">&#127968; Index</a>
        <h2>&#128194;"<?php single_cat_title(); ?>"</h2>
      
        <?php
// Check if there are any posts to display
        if (have_posts()) :
            ?>


            <?php
// The Loop
            while (have_posts()) : the_post();
                ?>


                <a href="<?php the_permalink(); ?>"><div class="deconvenue hoverable">

                        <p>&#128196;<?php the_title(); ?> </p>
                       

                    </div>
                </a>
                <?php
            endwhile; // End Loop

        else:
            ?>
            <p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>