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

        // Default item slug
        $item_slug = __('knowledgebase', 'item slug', 'ejo-kb');

        // Get archive slug
        if ($archive_slug = static::get_archive_slug()) {
            $item_slug = $archive_slug;
        }

        return $item_slug;
    }
    
    /**
     * Get archive page slug
     */
    public static function get_archive_slug() {

        // Default archive slug
        $archive_slug = __('knowledgebase', 'archive slug', 'ejo-kb');

        // Get archive page
        if ($archive_page = Options::get_archive_page()) {

            // Get page slug of frontpage
            if ( \get_option('page_on_front') == $archive_page ) {
                $archive_slug = '';
            }

            // Get page slug (including parent pages)
            elseif ($page_slug = get_page_uri($archive_page)) {
                $archive_slug = $page_slug;
            }
        }

        return $archive_slug;
    }
}
