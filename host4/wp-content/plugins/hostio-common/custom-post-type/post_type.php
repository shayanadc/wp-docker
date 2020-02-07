<?php



add_action( 'init', 'create_Type_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Type_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like Skills
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Type', 'travelia' ),
    'singular_name' => __( 'Type', 'travelia' ),
    'search_items' =>  __( 'Search Type','travelia' ),
    'all_items' => __( 'All Type','travelia' ),
    'parent_item' => __( 'Parent Type','travelia' ),
    'parent_item_colon' => __( 'Parent Type:','travelia' ),
    'edit_item' => __( 'Edit Type','travelia' ), 
    'update_item' => __( 'Update Type','travelia' ),
    'add_new_item' => __( 'Add New Type','travelia' ),
    'new_item_name' => __( 'New Type Name','travelia' ),
    'menu_name' => __( 'Type','travelia' ),
  );     

// Now register the taxonomy

  register_taxonomy('type',array('Portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}


?>