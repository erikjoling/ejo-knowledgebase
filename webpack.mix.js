/**
 * More information
 *
 * On Laravel Mix
 * https://laravel-mix.com/docs/5.0/installation
 * https://scotch.io/tutorials/using-laravel-mix-with-webpack-for-all-your-assets
 *
 * On Gutenberg setup
 * https://github.com/ahmadawais/create-guten-block/tree/master/packages/cgb-scripts
 * https://gist.github.com/kellymears/389e3ae40ed4c3de1bad0f03a405f940 (custom config)
 *
 * Other
 * https://github.com/justintadlock/mythic/blob/master/webpack.mix.js
 */

let mix = require('laravel-mix');

// Export mix-manifest.json to assets
mix.setPublicPath('assets/dist/');

// Gutenberg blocks
// mix.react('lib/blocks/blocks.js', 'assets/js/blocks.js');

