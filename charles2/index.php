<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="https://fonts.googleapis.com/css?family=Lato|Roboto" rel="stylesheet">

    <title><?php bloginfo( 'name' ); ?><?php wp_title( '&mdash;' ); ?></title>
    <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

  <div id="content">
<div id="header">
   <a href="/"> <pre>


 </pre></a>
   </div>
      <div id="">
          <?php wp_nav_menu('menu'); ?>
      </div>


      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div <?php post_class(); ?>>
              <div class="posttete">
                  
                      <a href="<?php the_permalink(); ?>">
                          <?php the_date(); ?>
                      </a>
                 
              </div>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
              <div class="content"><?php the_content(); ?></div>
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
                    <div class="right"><?php previous_posts_link( 'Newer posts &raquo;' ); ?></div>

          <div class="left"><?php next_posts_link( '&laquo; Older posts' ); ?></div>
      <?php endif; ?>
      <div class="clear"> </div>
  </div><!-- content -->

  <?php wp_footer(); ?>
  <div class="footer">
      
  </div>
  <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-66072851-1', 'auto');
      ga('send', 'pageview');

  </script>
  
  </body>
</html>