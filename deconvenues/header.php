<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <title><?php bloginfo('name'); ?><?php wp_title('&mdash;'); ?></title>
        <?php if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro" rel="stylesheet">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>

        <div id="content">
            <div id="header">

                <a href="/"> <img src="<?= get_template_directory_uri(); ?>/logo.JPG" class="logo" alt="<?php wp_title('&mdash;'); ?> logo"/> </a>


            </div>
            <div class="left_col">
                <a href="/">Index</a><br/>
                <a href="/index">Organismes</a><br/>
                <a href="/a-propos">À propos du CNADA</a><br/>
                <a href="/formulaire">
                    Soumettre une déconvenue
                </a>
            </div>
            <div class="moncorps">