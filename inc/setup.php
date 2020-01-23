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

namespace Ejo\Kb;

add_action( 'init', function() {

    register_post_type( 'knowledgebase', array(
        'description'           => __('Knowledgebase','ejo-kb'),
        'labels'                => array(
            'name'                  => __('Knowledgebase','ejo-kb'),
            'singular_name'         => __('Knowledgebase article','ejo-kb'),
            'add_new'               => __('Add new','ejo-kb'),
            'add_new_item'          => __('Add new article','ejo-kb'),
            'edit_item'             => __('Edit article','ejo-kb'),
            'new_item'              => __('New article','ejo-kb'),
            'view_item'             => __('View article','ejo-kb'),
            'search_items'          => __('Search articles','ejo-kb'),
            'not_found'             => __('No article found','ejo-kb'),
            'not_found_in_trash'    => __('No article found in trash','ejo-kb'),
            'all_items'             => __('All articles','ejo-kb'),
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
        ),
        'public'                => true,
        'menu_position'         => 24,
        'rewrite'               => array(
            'slug'       => __('knowledgebase','ejo-kb'),
            'with_front' => false,
        ),
        'supports'              => array('title','editor','author','thumbnail'),
        'public'                => true,
        'show_ui'               => true,
        'publicly_queryable'    => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'show_in_rest'          => true,
    ));
    
    register_taxonomy( 'knowledgebase_category',array( 'knowledgebase' ),array( 
        'hierarchical'  => false,
        'labels'        => array(
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
        ),
        'show_ui'       => true,
        'public'        => true,
        'query_var'     => true,
        'hierarchical'  => true,
        'rewrite'       => array( 
            'slug' => __('knowledgebase-category','ejo-kb'),
        )
    ));
});
