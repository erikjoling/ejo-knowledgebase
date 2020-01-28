<?php 

namespace Ejo\Knowledgebase;

/**
 * This has to be tested, but I doubt it works.
 * 
 * I got the inspiration from the Enclopedia plugin. There is a I18n class.
 * But it emulates translation. I think that goes against WordPress standards.
 * And why go against standards when the win isn't that high...
 */

abstract class L10n {
    const textdomain = 'ejo-knowledgebase';

    public static function get_text_domain(){
        return static::textdomain;
    }

    public static function t($text, $context = null){
        return \t($text, $context);
    }

    public static function __($text){
        return \__($text, static::get_text_domain());
    }

    public static function _e($text){
        echo \_e($text, static::get_text_domain());
    }

    public static function _x($text, $context){
        return \_x($text, $context, static::get_text_domain());
    }

    public static function _ex($text, $context){
        echo \_ex($text, $context, static::get_text_domain());
    }
}