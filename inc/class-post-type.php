<?php 

Namespace Ejo\Knowledgebase;

abstract class Post_Type {

    public static function get_id() {
        return 'knowledgebase';
    }

    public static function get_name() {
        return static::get_settings()['post_type']['name'] ?? __('Knowledgebase','ejo-kb');
    }

    public static function get_singular_name() {
        return static::get_settings()['post_type']['singular_name'] ?? __('article','ejo-kb');
    }
    
    public static function get_plural_name() {
        return static::get_settings()['post_type']['plural_name'] ?? __('articles','ejo-kb');
    }
    
    public static function get_item_slug() {
        return static::get_settings()['post_type']['item_slug'] ?? __('articles','ejo-kb');
    }
    
    public static function get_archive_slug() {
        return static::get_settings()['post_type']['archive_slug'] ?? __('knowledgebase','ejo-kb');
    }

    private static function get_settings() {
        return get_option( 'ejo_knowledgebase_settings', [] );
    }
}
