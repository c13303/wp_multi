<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php wp_title( '&mdash;' ); ?> <?php bloginfo( 'name' ); ?></title>
    <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400italic,700,400' rel='stylesheet' type='text/css'>

</head>
<body <?php body_class(); ?>>
<div id="container">
    <div id="header">

        <div class="inline">
        <?php wp_nav_menu();         ?><a href="/" style="border:none;">Petite Année de la Marchandise Label</a>



        <?php //wp_nav_menu( array('menu' => 'menu2' )); ?>
         </div>
    </div><!-- header -->
<div class="ligne"></div>
