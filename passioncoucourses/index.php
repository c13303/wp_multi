<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <link rel="icon" type="image/png" href="lard.png" />
<meta property="og:image" content="http://passioncoucourses.5tfu.org/wp-content/uploads/sites/12/2017/12/avatar_1116d068cd40_64.png" />

      <title><?php bloginfo( 'name' ); ?><?php wp_title( '&mdash;' ); ?></title>
    <meta name="description" content="Passion Coucourses - Le site des passionnés des coucourses" />
    <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
        

    <div id="container">
        
      <div id="header">
       <h1><a href="<?php bloginfo('url'); ?>">
                <div style="float:left">
                    Passion Coucourses
                </div> 
                <div style="float:right">
                    <img src="http://passioncoucourses.5tfu.org/wp-content/uploads/sites/12/2017/12/avatar_1116d068cd40_64.png" alt="Passion Coucourses Logo" style="border:none; max-width: 200px; height:auto;"/>
                </div>
            </a>
            
        </h1>
     
      </div><!-- header -->
      <div id="content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="left">
               <?php the_date(); ?>
              <?php the_tags(); ?>
          </div>
          <div <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>
           
            <?php if ( !is_singular() && get_the_title() == '' ) : ?>
              <a href="<?php the_permalink(); ?>">(more...)</a>
            <?php endif; ?>
            <?php if ( is_singular() ) : ?>
              <div class="pagination"><?php wp_link_pages(); ?></div>
            <?php endif; ?>

              <div class="clear"> </div>
            <br/>

          </div><!-- post_class() -->
         
        <?php endwhile; else: ?>
          <div class="hentry"><h2>Sorry, the page you requested cannot be found</h2></div>
        <?php endif; ?>
        
        <?php if ( is_singular() || is_404() ) : ?>
          <div class="left"><a href="<?php bloginfo( 'url' ); ?>">&laquo; Home page</a></div>
        <?php else : ?>
          <?php next_posts_link( 'Page précédente' ); ?> /
          <?php previous_posts_link( 'Page Suivante' ); ?>
        <?php endif; ?>
        <div class="clear"> </div>
        <p>Pour contribuer, envoyez votre review de coucourses à <a href="mailto:charles.torris@gmail.com">charles.torris@gmail.com</a> <br/>( <a href="http://passioncoucourses.5tfu.org/guidelines/">guidelines</a> )</p>
      </div><!-- content -->
    </div><!-- container -->
    <?php wp_footer(); ?>
    

    
  </body>
</html>