<?php
if (!isset($content_width))
    $content_width = 625;

function twentytwelve_setup() {


    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
}

add_action('after_setup_theme', 'twentytwelve_setup');

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Twelve 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentytwelve_get_font_url() {
    $font_url = '';

    /* translators: If there are characters in your language that are not supported
     * by Open Sans, translate this to 'off'. Do not translate into your own language.
     */
    if ('off' !== _x('on', 'Open Sans font: on or off', 'twentytwelve')) {
        $subsets = 'latin,latin-ext';

        /* translators: To add an additional Open Sans character subset specific to your language,
         * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x('no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve');

        if ('cyrillic' == $subset)
            $subsets .= ',cyrillic,cyrillic-ext';
        elseif ('greek' == $subset)
            $subsets .= ',greek,greek-ext';
        elseif ('vietnamese' == $subset)
            $subsets .= ',vietnamese';

        $query_args = array(
            'family' => 'Open+Sans:400italic,700italic,400,700',
            'subset' => $subsets,
        );
        $font_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return $font_url;
}

/**
 * Enqueue scripts and styles for front end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
    global $wp_styles;

    wp_enqueue_script('featherJS', get_template_directory_uri() . '/lightbox/lightbox.min.js', array ( 'jquery' ));
    wp_enqueue_style( 'featherCSS', get_template_directory_uri() . '/lightbox/lightbox.min.css');


    $font_url = twentytwelve_get_font_url();
    if (!empty($font_url))
        wp_enqueue_style('twentytwelve-fonts', esc_url_raw($font_url), array(), null);

    // Loads our main stylesheet.
    wp_enqueue_style('twentytwelve-style', get_stylesheet_uri());

    // Loads the Internet Explorer specific stylesheet.
    wp_enqueue_style('twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array('twentytwelve-style'), '20121010');
    $wp_styles->add_data('twentytwelve-ie', 'conditional', 'lt IE 9');
}

add_action('wp_enqueue_scripts', 'twentytwelve_scripts_styles');

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Twelve 2.2
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentytwelve_resource_hints($urls, $relation_type) {
    if (wp_style_is('twentytwelve-fonts', 'queue') && 'preconnect' === $relation_type) {
        if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '>=')) {
            $urls[] = array(
                'href' => 'https://fonts.gstatic.com',
                'crossorigin',
            );
        } else {
            $urls[] = 'https://fonts.gstatic.com';
        }
    }

    return $urls;
}

add_filter('wp_resource_hints', 'twentytwelve_resource_hints', 10, 2);

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses twentytwelve_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Twenty Twelve 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function twentytwelve_mce_css($mce_css) {
    $font_url = twentytwelve_get_font_url();

    if (empty($font_url))
        return $mce_css;

    if (!empty($mce_css))
        $mce_css .= ',';

    $mce_css .= esc_url_raw(str_replace(',', '%2C', $font_url));

    return $mce_css;
}

add_filter('mce_css', 'twentytwelve_mce_css');

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title($title, $sep) {
    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name', 'display');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if (( $paged >= 2 || $page >= 2 ) && !is_404())
        $title = "$title $sep " . sprintf(__('Page %s', 'twentytwelve'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'twentytwelve_wp_title', 10, 2);




/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class($classes) {
    $background_color = get_background_color();
    $background_image = get_background_image();

    if (!is_active_sidebar('sidebar-1') || is_page_template('page-templates/full-width.php'))
        $classes[] = 'full-width';

    if (is_page_template('page-templates/front-page.php')) {
        $classes[] = 'template-front-page';
        if (has_post_thumbnail())
            $classes[] = 'has-post-thumbnail';
        if (is_active_sidebar('sidebar-2') && is_active_sidebar('sidebar-3'))
            $classes[] = 'two-sidebars';
    }

    if (empty($background_image)) {
        if (empty($background_color))
            $classes[] = 'custom-background-empty';
        elseif (in_array($background_color, array('fff', 'ffffff')))
            $classes[] = 'custom-background-white';
    }

    // Enable custom font class only if the font CSS is queued to load.
    if (wp_style_is('twentytwelve-fonts', 'queue'))
        $classes[] = 'custom-font-enabled';

    if (!is_multi_author())
        $classes[] = 'single-author';

    return $classes;
}

add_filter('body_class', 'twentytwelve_body_class');

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
    if (is_page_template('page-templates/full-width.php') || is_attachment() || !is_active_sidebar('sidebar-1')) {
        global $content_width;
        $content_width = 960;
    }
}

add_action('template_redirect', 'twentytwelve_content_width');

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Peintures';
    $submenu['edit.php'][5][0] = 'Peintures';
    $submenu['edit.php'][10][0] = 'Ajouter une Peinture';
}

function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Peintures';
    $labels->singular_name = 'Peinture';
    $labels->add_new = 'Ajouter une peinture';
    $labels->add_new_item = 'Ajouter une peinture';
    $labels->edit_item = 'Modifier';
    $labels->new_item = 'Peinture';
    $labels->view_item = 'View Peintures';
    $labels->search_items = 'Search Peintures';
    $labels->not_found = 'No Peintures found';
    $labels->not_found_in_trash = 'No Peintures found in Trash';
    $labels->all_items = 'All Peintures';
    $labels->menu_name = 'Peintures';
    $labels->name_admin_bar = 'Peintures';
}

add_action('admin_menu', 'revcon_change_post_label');
add_action('init', 'revcon_change_post_object');


/*
 * ANNICK
 */

function custom_image_size() {
    // Set default values for the upload media box
    update_option('image_default_align', 'center');
    update_option('image_default_size', 'large');
}

add_action('after_setup_theme', 'custom_image_size');

function remove_menus() {

    $user = wp_get_current_user();
    if (!in_array('administrator', (array) $user->roles)) {
        remove_menu_page('index.php');                  //Dashboard
        remove_menu_page('jetpack');                    //Jetpack* 
        // remove_menu_page( 'edit.php' );                   //Posts
        remove_menu_page('upload.php');                 //Media
//  remove_menu_page( 'edit.php?post_type=page' );    //Pages
        remove_menu_page('edit-comments.php');          //Comments
        remove_menu_page('themes.php');                 //Appearance
        remove_menu_page('plugins.php');                //Plugins
        remove_menu_page('users.php');                  //Users
        remove_menu_page('tools.php');                  //Tools
        remove_menu_page('options-general.php');        //Settings
        remove_menu_page('how-to-use-clipboard-images');
    }
}

add_action('admin_menu', 'remove_menus');




/* disable comments */

// Add to existing function.php file
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}

add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}

add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}

add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}

add_action('init', 'df_disable_comments_admin_bar');


function wpb_custom_new_menu() {
  register_nav_menu('nav-menu',__( 'Annick Menu'));
}
add_action( 'init', 'wpb_custom_new_menu' );



function remove_dashboard_widgets() {
    global $wp_meta_boxes;
       // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['tiny-compress-images_dashboard_widget ']);
}
 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

function admin_css() {

$admin_handle = 'admin_css';
$admin_stylesheet = get_template_directory_uri() . '/css/admin.css';

wp_enqueue_style( $admin_handle, $admin_stylesheet );
}
add_action('admin_print_styles', 'admin_css', 11 );



// Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');
