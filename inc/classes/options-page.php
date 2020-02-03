<?php 

Namespace Ejo\Knowledgebase;

abstract class OptionsPage {

    // Stores the option boxes for the options page
    private static $option_boxes = [];
        
    // Init
    public static function init() {
        add_action( 'admin_menu', [static::class, 'add_to_menu'] );
        
        // ...
        add_action( static::get_pre_options_page_hook(), [static::class, 'load_options_page'] );
    }

    /*=============================================================*/
    /**                        Getters                             */
    /*=============================================================*/
    
    public static function get_options_name() {
        return Options::get_option_key();
    }

    public static function get_nonce_value() {
        return 'save_knowledgebase_options';
    }

    public static function get_pre_options_page_hook() {       
        return 'pre_'.Post_Type::get_id().'_options_page';
    }

    // public static function get_parent_slug()

    // public static function get_page_url() {
    //     return admin_url('edit.php?post_type='.Post_Type::get_id());
    // }

    public static function get_option_boxes() {
        return static::$option_boxes;
    }

    /*=============================================================*/
    /**                       Utilities                            */
    /*=============================================================*/

    
    /**
     * Add options page to submenu of Knowledgebase
     */
    public static function add_to_menu() {
        
        $handle = \add_submenu_page( 
            'edit.php?post_type='.Post_Type::get_id(), // parent slug
            sprintf( __('%s settings', 'ejo-kb'), Post_Type::get_name() ), // page name
            __('Settings', 'ejo-kb'), // menu name
            'manage_options', // capability
            Post_Type::get_id().'-options', // page slug
            [static::class, 'print_page']
        );
        
        // Create custom action at before rendering options page
        add_action( 'load-'.$handle, function() {
            do_action( static::get_pre_options_page_hook() );
        });
    }

    public static function print_page() {
        require_once( WP_Plugin::get_file_path( 'inc/admin/options-page.php' ) ); 
    }
    
    /**
     * Load options
     */
    public static function load_options_page() {
        
        flush_rewrite_rules();

        // Setup admin_boxes
        static::add_option_box( __('Post Type', 'ejo-kb'), WP_Plugin::get_file_path( 'inc/admin/option-box-post-type.php') );

        // If this is a Post request to save the options
        if (static::save_options_page()) {
           
            // Redirect to prevent F5 page-refresh
            // NEED BETTER SOLUTION!
            $options_page_url = admin_url( 'edit.php?') . $_SERVER['QUERY_STRING'];

            if ( wp_safe_redirect( $options_page_url . '&settings-updated=true' ) ) {
                exit;
            }

        }
    }
    
    /**
     * Save options page
     */
    public static function save_options_page(){
        
        // Check if this is a post request
        if (empty($_POST)) return false;
        
        // Check the nonce
        check_admin_referer(static::get_nonce_value());
        
        // Get options
        $options = $_POST[static::get_options_name()] ?? false;
        
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
            
            Options::set($options);
        }
        
        return $options;
    }

    // public static function get_url($parameters = []){
    //     $url = add_Query_Arg(['page' => static::page_slug], Admin_Url('options-general.php'));
    //     if (is_Array($parameters) && !empty($parameters)) $url = add_Query_Arg($parameters, $url);
    //     return $url;
    // }


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
}
