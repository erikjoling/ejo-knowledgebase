<?php 

Namespace Ejo\Knowledgebase;

abstract class Options {

    // Stores the option boxes for the options page
    private static $option_boxes = [];

    // // Stores the options page handle (used for hooking action)
    // private static $options_page_handle;

    public static function get_parent_slug() {
        return 'edit.php?post_type='.Post_Type::get_id();
    }

    public static function get_page_slug() {
        return Post_Type::get_id().'-options';
    }

    public static function get_page_name() {
        return sprintf( __('%s settings', 'ejo-kb'), Post_Type::get_name() );
    }

    public static function get_menu_name() {
        return __('Settings', 'ejo-kb');
    }

    public static function get_capability() {
        return 'manage_options';
    }

    public static function get_nonce_value() {
        return 'save_knowledgebase_options';
    }

    public static function display_page() {
        require_once( WP_Plugin::get_file_path( 'inc/admin/options-page.php' ) ); 
    }

    public static function get_pre_options_page_hook() {       
        return 'pre_'.Post_Type::get_id().'_options_page';
    }

    public static function get() {
        return get_option( 'ejo_knowledgebase_settings', [] );
    }

    /**
     * Try to add option box to the option boxes
     */
    public static function add_option_box( $title = '', $file = '' ) {
        
        // Safety check: does the file exist?
        if ( ! file_exists($file) ) return False;

        // Title cannot be empty
        $title = (empty($title)) ? '&nbsp;' : $title;

        // Add a new box
        static::$option_boxes[] = (Object) [
            'title' => $title,
            'file' => $file,
        ];
    }

    public static function get_option_boxes() {
        return static::$option_boxes;
    }

    public static function setup_option_boxes() {
        
        // Add option boxes to the option page
        Options::add_option_box( __('Post Type', 'ejo-kb'), WP_Plugin::get_file_path( 'inc/admin/option-box-post-type.php') );
    }

    public static function maybe_save_options(){

        // Check if this is a post request
        if (empty($_POST)) return false;
    
        // Check the nonce
        check_admin_referer(Options::get_nonce_value());
    
        // Clean the Post array
        $options = stripslashes_deep($_POST);
        $options = array_filter($options, function($value){ return $value == '0' || !empty($value); });

        log($options);
    
        // Save Options
        // update_option(static::options_key, $options);
    
        return true;
      }
}
