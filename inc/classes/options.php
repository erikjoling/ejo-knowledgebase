<?php 

Namespace Ejo\Knowledgebase;

abstract class Options {

    private static $option_key = 'ejo_knowledgebase_settings';

    // Stores the option boxes for the options page
    private static $option_boxes = [];

    public static function get_option_key() {
        return static::$option_key;
    }

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

    /**
     * Get options from database
     */
    public static function get() {
        return get_option( static::$option_key, [] );
    }

    /**
     * Store options in database
     */
    private static function set($options) {
        update_option(static::get_option_key(), $options);
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

        static::add_option_box( __('Post Type', 'ejo-kb'), WP_Plugin::get_file_path( 'inc/admin/option-box-post-type.php') );        
    }

    public static function load_options(){

        if (static::maybe_save_options()) {
            // redirect...
        }
    }

    public static function maybe_save_options(){

        // Check if this is a post request
        if (empty($_POST)) return false;
    
        // Check the nonce
        check_admin_referer(static::get_nonce_value());

        // Get options
        $options = $_POST[static::get_option_key()] ?? false;
        
        if ($options) {

            /**
             * Remove slashes
             * 
             * WordPress adds slashes to $_POST/$_GET/$_REQUEST/$_COOKIE regardless of what get_magic_quotes_gpc() returns.
             * @link https://codex.wordpress.org/Function_Reference/stripslashes_deep
             */
            $options = stripslashes_deep($options);

            // ?
            // $options = array_filter($options, function($value){ return $value == '0' || !empty($value); });

            log($options);
    
            static::set($options);
        }

        return $options;
    }
}
