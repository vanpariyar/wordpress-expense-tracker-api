<?php
/**
 * @package Expanse Tracker API
 * @subpackage Customizer.
 * @desc To Customize Admin Experience.
 * 
 */

add_action( 'init', 'WPETA_customizer');

function WPETA_customizer(){
    /* Expenses custom post type - Start */
    $expense_labels = array(
        'name'                => _x( 'Expenses', 'Post Type General Name', 'WPETA' ),
        'singular_name'       => _x( 'Expense', 'Post Type Singular Name', 'WPETA' ),
        'menu_name'           => __( 'Expenses', 'WPETA' ),
        'parent_item_colon'   => __( 'Parent Expense', 'WPETA' ),
        'all_items'           => __( 'All Expenses', 'WPETA' ),
        'view_item'           => __( 'View Expense', 'WPETA' ),
        'add_new_item'        => __( 'Add New Expense', 'WPETA' ),
        'add_new'             => __( 'Add New', 'WPETA' ),
        'edit_item'           => __( 'Edit Expense', 'WPETA' ),
        'update_item'         => __( 'Update Expense', 'WPETA' ),
        'search_items'        => __( 'Search Expense', 'WPETA' ),
        'not_found'           => __( 'Not Found', 'WPETA' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'WPETA' ),
    );
     
    $expense_args = array(
        'label'               => __( 'Expenses', 'WPETA' ),
        'description'         => __( '', 'WPETA' ),
        'labels'              => $expense_labels,        
        'supports'            => array( 'title', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),        
        'taxonomies'          => array( 'expense-category' ),        
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-groups',
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
    );
    
    register_post_type( 'expenses', $expense_args );
    /* Expenses custom post type - End */

    // Register Expense category Start
    $labels = array(
        'name'              => _x( 'Expense Categories', 'taxonomy general name', 'WPETA' ),
        'singular_name'     => _x( 'Expense Category', 'taxonomy singular name', 'WPETA' ),
        'search_items'      => __( 'Search Expense Categories', 'WPETA' ),
        'all_items'         => __( 'All Expense Categories', 'WPETA' ),
        'parent_item'       => __( 'Parent Expense Category', 'WPETA' ),
        'parent_item_colon' => __( 'Parent Expense Category:', 'WPETA' ),
        'edit_item'         => __( 'Edit Expense Category', 'WPETA' ),
        'update_item'       => __( 'Update Expense Category', 'WPETA' ),
        'add_new_item'      => __( 'Add New Expense Category', 'WPETA' ),
        'new_item_name'     => __( 'New Expense Category Name', 'WPETA' ),
        'menu_name'         => __( 'Expense Category', 'WPETA' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'expense-category', 'with_front' => false),
        'show_in_rest'       => true,
        'publicly_queryable' => true,

    );
    register_taxonomy( 'expense-category', array( 'expenses' ), $args );
    // End expense category register
}