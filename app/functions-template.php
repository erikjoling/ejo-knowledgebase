<?php
/**
 * Plugin setup functions.
 *
 * This file is hooked at `plugins_loaded`
 * 
 * @package   Ejo\Kb
 * @author    Erik Joling <erik@ejoweb.nl>
 * @copyright 2019 Erik Joling
 * @link      https://www.ejoweb.nl/
 */

namespace Ejo\Knowledgebase;

function is_archive_page() {

    return (Options::get_archive_page() == \get_the_ID());
}