<?php

add_action('init', 'cp_change_post_object');

// Change dashboard Posts to Déconvenues
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Déconvenue';
    $labels->singular_name = 'Déconvenues';
    $labels->add_new = 'Ajouter Déconvenues';
    $labels->add_new_item = 'Ajouter Déconvenues';
    $labels->edit_item = 'Editr Déconvenues';
    $labels->new_item = 'Déconvenues';
    $labels->view_item = 'Lire Déconvenues';
    $labels->search_items = 'Search Déconvenues';
    $labels->not_found = 'No Déconvenues found';
    $labels->not_found_in_trash = 'No Déconvenues found in Trash';
    $labels->all_items = 'All Déconvenues';
    $labels->menu_name = 'Déconvenues';
    $labels->name_admin_bar = 'Déconvenues';
}

function change_tax_object_label() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = __('Auteur', 'deconvenuesdomain');
    $labels->singular_name = __('Auteur', 'deconvenuesdomain');
    $labels->search_items = __('Search Auteur', 'deconvenuesdomain');
    $labels->all_items = __('Auteurs', 'deconvenuesdomain');
    $labels->separate_items_with_commas = __('Separate Auteurs with commas', 'deconvenuesdomain');
    $labels->choose_from_most_used = __('Choose from the most used Auteurs', 'deconvenuesdomain');
    $labels->popular_items = __('Popular Auteurs', 'deconvenuesdomain');
    $labels->edit_item = __('Edit Auteur Name', 'deconvenuesdomain');
    $labels->view_item = __('View Auteur Name', 'deconvenuesdomain');
    $labels->update_item = __('Update Auteur Name', 'deconvenuesdomain');
    $labels->add_new_item = __('Add Your Auteur Name', 'deconvenuesdomain');
    $labels->new_item_name = __('Your New Auteurs Name', 'deconvenuesdomain');
}

add_action('init', 'change_tax_object_label');




add_action( 'init', 'create_organismes_taxo');
 
function create_organismes_taxo() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Organismes', 'taxonomy general name' ),
    'singular_name' => _x( 'Organismes', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Organismes' ),
    'popular_items' => __( 'Popular Organismes' ),
    'all_items' => __( 'All Organismes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Organismes' ), 
    'update_item' => __( 'Update Organismes' ),
    'add_new_item' => __( 'Add New Organismes' ),
    'new_item_name' => __( 'New Organismes Name' ),
    'separate_items_with_commas' => __( 'Separate organismes with commas' ),
    'add_or_remove_items' => __( 'Add or remove organismes' ),
    'choose_from_most_used' => __( 'Choose from the most used organismes' ),
    'menu_name' => __( 'Organismes' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('organismes','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'organismes' ),
  ));
}










?>