<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <link rel="icon" type="image/png" href="lard.png" />

      <title><?php bloginfo( 'name' ); ?><?php wp_title( '&mdash;' ); ?></title>
    <meta name="description" content="Unique Tapes : Limited Edition of 1 Cassette Tape Label" />
    <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=1375595965997727&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
    <div id="container">
      <div id="header">
        <h1><a href="<?php bloginfo('url'); ?>"><img src="http://unique-tapes.5tfu.org/wp-content/uploads/sites/9/2015/05/UTLOGO.jpg" alt="Unique Tapes Logo" style="border:none;"/></a></h1>
        <p id="description"><?php bloginfo( 'description' ); ?></p>
        <?php if ( has_nav_menu( 'menu' ) ) : wp_nav_menu(); else : ?>
          <ul><?php wp_list_pages( 'title_li=&depth=-1' ); ?></ul>
        <?php endif; ?>
      </div><!-- header -->
      <div id="content">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>
            <?php the_date(); ?>
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
        <?php if ( is_active_sidebar( 'widgets' ) ) : ?>
          <div class="widgets"><?php dynamic_sidebar( 'widgets' ); ?></div>
        <?php endif; ?>
        <?php if ( is_singular() || is_404() ) : ?>
          <div class="left"><a href="<?php bloginfo( 'url' ); ?>">&laquo; Home page</a></div>
        <?php else : ?>
          <div class="left"><?php next_posts_link( '&laquo; Older posts' ); ?></div>
          <div class="right"><?php previous_posts_link( 'Newer posts &raquo;' ); ?></div>
        <?php endif; ?>
        <div class="clear"> </div>
      </div><!-- content -->
    </div><!-- container -->
    <?php wp_footer(); ?>
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48618956-1', '5tfu.org');
  ga('send', 'pageview');

</script>
    
  </body>
</html>