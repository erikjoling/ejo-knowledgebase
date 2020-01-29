<?php 

Namespace Ejo\Knowledgebase;

abstract class Post_Type {

    public static function get_id() {
        return 'knowledgebase';
    }

    public static function get_name() {
        return Options::get()['post_type']['name'] ?? __('Knowledgebase','ejo-kb');
    }

    public static function get_singular_name() {
        return Options::get()['post_type']['singular_name'] ?? __('article','ejo-kb');
    }
    
    public static function get_plural_name() {
        return Options::get()['post_type']['plural_name'] ?? __('articles','ejo-kb');
    }
    
    public static function get_item_slug() {
        return Options::get()['post_type']['item_slug'] ?? __('articles','ejo-kb');
    }
    
    public static function get_archive_slug() {
        return Options::get()['post_type']['archive_slug'] ?? __('knowledgebase','ejo-kb');
    }
}
