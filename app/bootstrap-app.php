<?php

namespace Ejo\Knowledgebase;

/**
 * Bootstrap app
 */
add_action( 'plugins_loaded', function() {

	// Load text domain
	load_plugin_textdomain( 'ejo-kb', false, dirname(WP_Plugin::get_file()) . '/assets/languages' );

	require_once( WP_Plugin::get_file_path( 'inc/setup.php' ) );
});