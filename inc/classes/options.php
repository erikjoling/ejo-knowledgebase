<?php 

Namespace Ejo\Knowledgebase;

abstract class Options {

    private static $option_key = 'ejo_knowledgebase_settings';

    public static function get_option_key() {
        return static::$option_key;
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
    public static function set($options) {
        update_option(static::get_option_key(), $options);
    }
}
