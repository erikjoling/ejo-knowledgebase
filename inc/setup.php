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

// First we need to make classes available
require_once( WP_Plugin::get_file_path( 'inc/classes/post-type.php' ) );
require_once( WP_Plugin::get_file_path( 'inc/classes/options.php' ) );

// Add actions
add_action( 'init',       __NAMESPACE__.'\register_post_type' );
add_action( 'admin_menu', __NAMESPACE__.'\add_options_page' );

// ...
add_action( Options::get_pre_options_page_hook(), [__NAMESPACE__.'\Options', 'load_options'] );
add_action( Options::get_pre_options_page_hook(), [__NAMESPACE__.'\Options', 'setup_option_boxes'] );
add_action( Options::get_pre_options_page_hook(), [__NAMESPACE__.'\Options', 'maybe_save_options'] );

/**
 * Add options page to submenu of Knowledgebase
 */
function add_options_page() {

    $handle = \add_submenu_page( 
        Options::get_parent_slug(),
        Options::get_page_name(),
        Options::get_menu_name(),
        Options::get_capability(),
        Options::get_page_slug(),
        [__NAMESPACE__.'\Options', 'display_page']
    );

    // Create custom action at beginning of option page
    add_action( 'load-'.$handle, function() {
        do_action( Options::get_pre_options_page_hook() );
    });
}


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

        // WordPress core
        // 'name'                     => array( _x( 'Posts', 'post type general name' ), _x( 'Pages', 'post type general name' ) ),
        // 'singular_name'            => array( _x( 'Post', 'post type singular name' ), _x( 'Page', 'post type singular name' ) ),
        // 'add_new'                  => array( _x( 'Add New', 'post' ), _x( 'Add New', 'page' ) ),
        // 'add_new_item'             => array( __( 'Add New Post' ), __( 'Add New Page' ) ),
        // 'edit_item'                => array( __( 'Edit Post' ), __( 'Edit Page' ) ),
        // 'new_item'                 => array( __( 'New Post' ), __( 'New Page' ) ),
        // 'view_item'                => array( __( 'View Post' ), __( 'View Page' ) ),
        // 'view_items'               => array( __( 'View Posts' ), __( 'View Pages' ) ),
        // 'search_items'             => array( __( 'Search Posts' ), __( 'Search Pages' ) ),
        // 'not_found'                => array( __( 'No posts found.' ), __( 'No pages found.' ) ),
        // 'not_found_in_trash'       => array( __( 'No posts found in Trash.' ), __( 'No pages found in Trash.' ) ),
        // 'parent_item_colon'        => array( null, __( 'Parent Page:' ) ),
        // 'all_items'                => array( __( 'All Posts' ), __( 'All Pages' ) ),
        // 'archives'                 => array( __( 'Post Archives' ), __( 'Page Archives' ) ),
        // 'attributes'               => array( __( 'Post Attributes' ), __( 'Page Attributes' ) ),
        // 'insert_into_item'         => array( __( 'Insert into post' ), __( 'Insert into page' ) ),
        // 'uploaded_to_this_item'    => array( __( 'Uploaded to this post' ), __( 'Uploaded to this page' ) ),
        // 'featured_image'           => array( _x( 'Featured Image', 'post' ), _x( 'Featured Image', 'page' ) ),
        // 'set_featured_image'       => array( _x( 'Set featured image', 'post' ), _x( 'Set featured image', 'page' ) ),
        // 'remove_featured_image'    => array( _x( 'Remove featured image', 'post' ), _x( 'Remove featured image', 'page' ) ),
        // 'use_featured_image'       => array( _x( 'Use as featured image', 'post' ), _x( 'Use as featured image', 'page' ) ),
        // 'filter_items_list'        => array( __( 'Filter posts list' ), __( 'Filter pages list' ) ),
        // 'items_list_navigation'    => array( __( 'Posts list navigation' ), __( 'Pages list navigation' ) ),
        // 'items_list'               => array( __( 'Posts list' ), __( 'Pages list' ) ),
        // 'item_published'           => array( __( 'Post published.' ), __( 'Page published.' ) ),
        // 'item_published_privately' => array( __( 'Post published privately.' ), __( 'Page published privately.' ) ),
        // 'item_reverted_to_draft'   => array( __( 'Post reverted to draft.' ), __( 'Page reverted to draft.' ) ),
        // 'item_scheduled'           => array( __( 'Post scheduled.' ), __( 'Page scheduled.' ) ),
        // 'item_updated'             => array( __( 'Post updated.' ), __( 'Page updated.' ) ),
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