<?php

/**
 * Plugin Name: Auto Posts
 * Plugin URI: https://github.com/Shayerdev/plugin-cpamatica-autoposts/tree/main
 * Description: This plugin is designed to automatically create posts at a specific url, which has a json post format.
 * Version: 1.0
 * Requires PHP: 7.4
 * Author: Shayer Developer
 * Text Domain: cpamatica-auto-post
 * Domain Path: /src/lang
 */

require_once __DIR__ . '/vendor/autoload.php';

use CAP\CpamaticaAutoPosts;
use CAP\actions;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

# Basic plugin dir
const CPAMATICA_AUTO_POSTS_PLUGIN_DIR = __FILE__;

if (!class_exists('CpamaticaAutoPosts')) {

    // Create Plugin instance
    $cpamaticaAutoPosts = CpamaticaAutoPosts::getInstance();

    // Load basic Instance
    $cpamaticaAutoPosts->defines();
    $cpamaticaAutoPosts->apiEndpoints();
    $cpamaticaAutoPosts->metaboxes();
    $cpamaticaAutoPosts->shortcode();
    $cpamaticaAutoPosts->actions();
    $cpamaticaAutoPosts->adminPages();

    // Create activate instance
    $cpamaticaAutoPostsActivate = new actions\CpamaticaAutoPostsActivate(__FILE__);
    $cpamaticaAutoPosts->activate($cpamaticaAutoPostsActivate);

    // Create deactivate instance
    $cpamaticaAutoPostsDeactivate = new actions\CpamaticaAutoPostsDeactivate(__FILE__);
    $cpamaticaAutoPosts->diactivate($cpamaticaAutoPostsDeactivate);
}
