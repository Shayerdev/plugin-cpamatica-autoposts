<?php

require_once __DIR__ . '/vendor/autoload.php';

use CAP\CpamaticaAutoPosts;
use CAP\Exception\ExceptionDatabaseSettings;
use CAP\model\settings\DatabaseSettings;

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}
if (!class_exists('CpamaticaAutoPosts')) {

    // Create Plugin instance
    $cpamaticaAutoPosts = CpamaticaAutoPosts::getInstance();
    // Load basic Instance
    $cpamaticaAutoPosts->defines();

    $db = new DatabaseSettings();
    try {
        $db->deleteTable();
    } catch (ExceptionDatabaseSettings $e) {
        $e->displayErrorNotice();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}



