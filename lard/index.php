<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="https://fonts.googleapis.com/css?family=VT323" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <title><?php bloginfo('name'); ?><?php wp_title('&mdash;'); ?></title>
        <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

        <div id="content">
            <div id="header">
                <a href="/"> <pre>
╦  ┌─┐┬─┐┌┬┐  ┌┬┐┬ ┬   ╦┌─┐┬ ┬  ╦  ╦┬┌┬┐┌─┐┌─┐
║  ├─┤├┬┘ ││   │││ │   ║├┤ │ │  ╚╗╔╝│ ││├┤ │ │
╩═╝┴ ┴┴└──┴┘  ─┴┘└─┘  ╚╝└─┘└─┘   ╚╝ ┴─┴┘└─┘└─┘

                    </pre></a>
            </div>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div <?php post_class(); ?>>
                        <h2 class="posttete"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php// the_date(); ?></a></h2>

                        <?php the_content(); ?>
                        <?php if (!is_singular() && get_the_title() == '') : ?>
                            <a href="<?php the_permalink(); ?>">(more...)</a>
                        <?php endif; ?>
                        <?php if (is_singular()) : ?>
                            <div class="pagination"><?php wp_link_pages(); ?></div>
                        <?php endif; ?>

                        <div class="clear"> </div>
                        <br/>

                    </div><!-- post_class() -->

                <?php endwhile;
            else: ?>
                <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
            <?php endif; ?>
            <?php if (is_active_sidebar('widgets')) : ?>
                <div class="widgets"><?php dynamic_sidebar('widgets'); ?></div>
            <?php endif; ?>
            <?php if (is_singular() || is_404()) : ?>
                <div class="left"><a href="<?php bloginfo('url'); ?>">&laquo; Home page</a></div>
<?php else : ?>
                <div class="left"><?php next_posts_link('&laquo; Older posts'); ?></div>
                <div class="right"><?php previous_posts_link('Newer posts &raquo;'); ?></div>
<?php endif; ?>
            <div class="clear"> </div>
                        <a class="twitter-timeline"  href="https://twitter.com/LardDuJeuVideo" data-widget-id="629929784743718912">Tweets by @LardDuJeuVideo</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          
        </div><!-- content -->

<?php wp_footer(); ?>
        
    </body>
</html>