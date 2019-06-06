<?php




/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {

    // Load our main stylesheet.
    wp_enqueue_style('twentyfifteen-style', get_stylesheet_uri());

    wp_enqueue_script('feather-js', get_template_directory_uri() . '/js/featherlight.min.js', array('jquery'), 1, true);
    wp_enqueue_style('feather-css', get_template_directory_uri() . '/js/featherlight.min.css', array('twentyfifteen-style'), '20141010');
    
    wp_enqueue_script('heures-js', get_template_directory_uri() . '/js/heures.js', array(), time(), true);
    wp_localize_script('heures-js', 'ajaxurl', admin_url('admin-ajax.php'));
}

add_action('wp_enqueue_scripts', 'twentyfifteen_scripts');



add_action('init', 'codex_photoload_init');

function codex_photoload_init() {
    $labels = array(
        'name' => _x('Photoloads', 'post type general name', 'your-plugin-textdomain'),
        'singular_name' => _x('Photoload', 'post type singular name', 'your-plugin-textdomain'),
        'menu_name' => _x('Photoloads', 'admin menu', 'your-plugin-textdomain'),
        'name_admin_bar' => _x('Photoload', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'photoload', 'your-plugin-textdomain'),
        'add_new_item' => __('Add New Photoload', 'your-plugin-textdomain'),
        'new_item' => __('New Photoload', 'your-plugin-textdomain'),
        'edit_item' => __('Edit Photoload', 'your-plugin-textdomain'),
        'view_item' => __('View Photoload', 'your-plugin-textdomain'),
        'all_items' => __('All Photoloads', 'your-plugin-textdomain'),
        'search_items' => __('Search Photoloads', 'your-plugin-textdomain'),
        'parent_item_colon' => __('Parent Photoloads:', 'your-plugin-textdomain'),
        'not_found' => __('No photoloads found.', 'your-plugin-textdomain'),
        'not_found_in_trash' => __('No photoloads found in Trash.', 'your-plugin-textdomain')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'heures-domain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'photoload'),
        'capability_type' => 'page',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('photoload', $args);
}

add_filter('image_strip_meta', false);


add_filter('wp_handle_upload_prefilter', 'custom_upload_filter');

function custom_upload_filter($file) {
    $upload_dir = wp_upload_dir();
    $path = $upload_dir['path'];

    $exif = exif_read_data($file['tmp_name']);

    error_log(print_r($exif, 1));


    $datestamp = str_replace(':', '_', $exif['DateTime']);
    $file['name'] = $datestamp . '[-]' . $file['name'];

    return $file;
}

function scaled_image_path($attachment_id, $size = 'thumbnail') {
    $file = get_attached_file($attachment_id, true);
    if (empty($size) || $size === 'full') {
        // for the original size get_attached_file is fine
        return realpath($file);
    }
    if (!wp_attachment_is_image($attachment_id)) {
        return false; // the id is not referring to a media
    }
    $info = image_get_intermediate_size($attachment_id, $size);
    if (!is_array($info) || !isset($info['file'])) {
        return false; // probably a bad size argument
    }

    return realpath(str_replace(wp_basename($file), $info['file'], $file));
}

function my_pre_save_post($post_id) {


    if (!isset($_POST['acf']['field_5cf605d55bcd3'])) {
        return $post_id;
    }

    $pics = $_POST['acf']['field_5cf605d55bcd3'];
    if (!$pics) {
        return $post_id;
    }
    foreach ($pics as $pic) {

        $dapost = get_post($pic);
        $datestampstring = explode('-', $dapost->post_name);
        $datestamp = explode('_', $datestampstring[0]);
        $formateddate = $datestamp[2] . '/' . $datestamp[1] . '/' . $datestamp[0];
        $heure = get_field('heure', 'user_' . get_current_user_id());

        $my_post = array(
            'post_title' => $formateddate,
            'post_content' => $dapost->post_excerpt,
            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
            'post_date' => $datestamp[0] . '-' . $datestamp[1] . '-' . $datestamp[2] . ' '.$heure.':00'
        );
        //  echo PHP_EOL;        var_dump($my_post);                die();
        $pid = wp_insert_post($my_post);
        update_field('photo', $pic, $pid);
    }

    wp_redirect('/?filter=' . get_current_user_id());
    exit();
}

add_filter('acf/pre_save_post', 'my_pre_save_post', 10, 1);

/*

  add_filter('media_upload_tabs', 'my_plugin_image_tabs', 10, 1);

  function my_plugin_image_tabs($_default_tabs) {
  // unset($_default_tabs['type']);
  unset($_default_tabs['type_url']);
  unset($_default_tabs['gallery']);
  unset($_default_tabs['library']);
  return($_default_tabs);
  }
 */

add_action('pre_get_posts', 'users_own_attachments');

function users_own_attachments($wp_query_obj) {

    global $current_user, $pagenow;

    $is_attachment_request = ($wp_query_obj->get('post_type') == 'attachment');

    if (!$is_attachment_request)
        return;

    if (!is_a($current_user, 'WP_User'))
        return;

    if (!in_array($pagenow, array('upload.php', 'admin-ajax.php')))
        return;

    if (!current_user_can('delete_pages'))
        $wp_query_obj->set('author', $current_user->ID);

    return;
}
add_action('admin_head','remove_personal_options');
function remove_personal_options() {
    echo '<script type="text/javascript">jQuery(document).ready(function($) {
  
$(\'form#your-profile > h2:first\').remove(); // remove the "Personal Options" title
  
$(\'form#your-profile tr.user-rich-editing-wrap\').remove(); // remove the "Visual Editor" field
  
$(\'form#your-profile tr.user-admin-color-wrap\').remove(); // remove the "Admin Color Scheme" field
  
$(\'form#your-profile tr.user-comment-shortcuts-wrap\').remove(); // remove the "Keyboard Shortcuts" field
  
$(\'form#your-profile tr.user-admin-bar-front-wrap\').remove(); // remove the "Toolbar" field
  
$(\'form#your-profile tr.user-language-wrap\').remove(); // remove the "Language" field
  
  
  
  
  
$(\'table.form-table tr.user-url-wrap\').remove();// remove the "Website" field in the "Contact Info" section
  
$(\'h2:contains("About Yourself"), h2:contains("About the user")\').remove(); // remove the "About Yourself" and "About the user" titles
  
$(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
  
$(\'form#your-profile tr.user-profile-picture\').remove(); // remove the "Profile Picture" field
  
$(\'table.form-table tr.user-aim-wrap\').remove();// remove the "AIM" field in the "Contact Info" section
 
$(\'table.form-table tr.user-yim-wrap\').remove();// remove the "Yahoo IM" field in the "Contact Info" section
 
$(\'table.form-table tr.user-jabber-wrap\').remove();// remove the "Jabber / Google Talk" field in the "Contact Info" section
 
});</script>';
}

function remove_dash() {
    remove_menu_page('index.php');
    remove_menu_page('tools.php');
    remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_dash');




add_action('wp_ajax_get_photo', 'get_photo');
add_action('wp_ajax_nopriv_get_photo', 'get_photo');

function get_photo() {

    $param = $_POST['param'];
    /*$post = get_post($param);
    $photo = get_field('photo',$post);*/
  
    $photo = wp_get_attachment_image_src($param,'full');
    echo ($photo[0]);

    die();
}
