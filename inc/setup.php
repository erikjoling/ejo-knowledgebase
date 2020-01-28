<?php
/**
 * Plugin setup functions.
 *
 * This file is hooked at `plugins_loaded`
 * 
 * @package   Ejo\Kb
 * @author    Erik Joling <erik@ejoweb.nl>
 * @copyright 2019 Erik Joling
 * @link      https://www.ejoweb.nl/
 */

namespace Ejo\Knowledgebase;

require_once( WP_Plugin::get_file_path( 'inc/class-post-type.php' ) );

add_action( 'init', __NAMESPACE__ . '\register_post_type' );

function register_post_type() {

    $post_type_labels = [
        'name'                  => Post_Type::get_name(),
        'singular_name'         => Post_Type::get_singular_name(),
        'add_new'               => __('Add new','ejo-kb'),
        'add_new_item'          => sprintf( __('Add new %s','ejo-kb'), Post_Type::get_singular_name() ),
        'edit_item'             => sprintf( __('Edit %s','ejo-kb'), Post_Type::get_singular_name() ),
        'new_item'              => sprintf( __('New %s','ejo-kb'), Post_Type::get_singular_name() ),
        'view_item'             => sprintf( __('View %s','ejo-kb'), Post_Type::get_singular_name() ),
        'search_items'          => sprintf( __('Search %s','ejo-kb'), Post_Type::get_plural_name() ),
        'not_found'             => sprintf( __('No %s found','ejo-kb'), Post_Type::get_plural_name() ),
        'not_found_in_trash'    => sprintf( __('No %s found in trash','ejo-kb'), Post_Type::get_plural_name() ),
        'all_items'             => sprintf( __('All %s','ejo-kb'), Post_Type::get_plural_name() ),
        // 'view_items'
        // 'archives'
        // 'attributes'
        // 'insert_into_item'
        // 'uploaded_to_this_item'
        // 'featured_image'
        // 'set_featured_image'
        // 'remove_featured_image'
        // 'use_featured_image'
        // 'menu_name'
        // 'filter_items_list'
        // 'items_list_navigation'
        // 'items_list'
        // 'name_admin_bar'
    ];

    $post_type_args = [
        'description'           => __('Knowledgebase description...','ejo-kb'),
        'labels'                => $post_type_labels,
        'public'                => true,
        'menu_position'         => 24,
        'rewrite'               => [
            'slug'       => Post_Type::get_item_slug(),
            'with_front' => false,
        ],
        'supports'              => array('title','editor','author','thumbnail'),
        'public'                => true,
        'show_ui'               => true,
        'publicly_queryable'    => true,
        'has_archive'           => Post_Type::get_archive_slug(),
        'exclude_from_search'   => false,
        'show_in_rest'          => true,
    ];

    \register_post_type( Post_Type::get_id(), $post_type_args);
}

function register_taxonomy() {

    $taxonomy_labels = [
        'name'              => __('Categories','ejo-kb'),
        'singular_name'     => __('Category','ejo-kb'),
        'search_items'      => __('Search categories','ejo-kb'),
        'all_items'         => __('All categories','ejo-kb'),
        'parent_item'       => __('Parent category','ejo-kb'),
        'parent_item_colon' => __('Parent category:','ejo-kb'),
        'edit_item'         => __('Edit category','ejo-kb'),
        'update_item'       => __('Update category','ejo-kb'),
        'add_new_item'      => __('Add new category','ejo-kb'),
        'new_item_name'     => __('New category name','ejo-kb'),
        'popular_items'     => NULL,
        'menu_name'         => __('Categories','ejo-kb') 
    ];

    $taxonomy_args = [ 
        'hierarchical'  => false,
        'labels'        => $taxonomy_labels,
        'show_ui'       => true,
        'public'        => true,
        'query_var'     => true,
        'hierarchical'  => true,
        'rewrite'       => array( 
            'slug' => __('knowledgebase-category','ejo-kb'),
        )
    ];

    register_taxonomy( 'knowledgebase_category', [ Post_Type::get_id() ], $taxonomy_args );
}    