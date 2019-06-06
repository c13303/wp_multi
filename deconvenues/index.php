<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class(); ?>>

            <h2><a href="<?php the_permalink(); ?>">&#128196;<?php the_title(); ?></a> </h2>
            <?php
            $categories = wp_get_post_categories(get_the_id());

            foreach ($categories as $cid) {
                $category = (get_category($cid));
                echo '<a href="' . get_category_link($category->term_id) . '">&#128193;' . $category->name . '</a> ';
            }
            ?>
            
             <p>
            <?php
            $note = get_field('note');
            for ($i = 0; $i < $note; $i++) {
                ?>&#11088;<?php
            }
            ?>
                </p>

            <div class="content"><?php the_content(); ?></div>
            <?php if (!is_singular() && get_the_title() == '') : ?>
                <a href="<?php the_permalink(); ?>">(more...)</a>
            <?php endif; ?>
            <?php if (is_singular()) : ?>
                <div class="pagination"><?php wp_link_pages(); ?></div>
            <?php endif; ?>

            <div class="clear"> </div>
            <br/>
            <p> <?php
                $tags = get_the_tags();

                if ($tags) {
                    echo '	&#128395;&#65039;';
                    foreach ($tags as $tag) {
                        echo '<a href="/tag/' . $tag->slug . '">' . $tag->name . '</a>';
                    }
                }
                ?>
            </p>

            <?= get_field('lieu') ? '<p>&#x1F30D; ' . get_field('lieu') . '</p>' : ''; ?>

            <?php
            $terms = get_field('organismes_concernes');

            if ($terms):
                ?>
                <p>&#x1F3E2;   
                    <?php foreach ($terms as $term): ?>
                        <a href="<?php echo get_term_link($term); ?>"><?= $term->name; ?></a> 
                    <?php endforeach; ?> 
                </p>
            <?php endif; ?>

               

        </div><!-- post_class() -->

        <?php
        /*

         */
        $next_post = get_next_post();
        if (is_a($next_post, 'WP_Post')) :
            ?>
            <p>	&#10145;&#65039; <a href="<?php echo get_permalink($next_post->ID); ?>">&#128196;<?php echo get_the_title($next_post->ID); ?></a>
            </p> <?php
        endif;


        echo '</p>';

    endwhile;
else:
    ?>
    <div class="hentry"><h2>404</h2></div>
<?php endif; ?>


<div class="clear"> </div>
</div><!-- content -->


<?php get_footer(); ?>