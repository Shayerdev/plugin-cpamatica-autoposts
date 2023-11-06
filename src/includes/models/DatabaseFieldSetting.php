<?php

namespace CAP\model\settings;

use CAP\Exception\ExceptionDatabaseSettings;

class DatabaseFieldSetting
{
    public static function get($field): string
    {
        global $wpdb;
        $table_name = $wpdb->prefix . CPAMATICA_TABLE_NAME;

        $result = $wpdb->get_var("SELECT $field FROM $table_name");

        if ($wpdb->last_error || $result === null) {
            throw new ExceptionDatabaseSettings("Database Settings: Field $field not exist.");
        }
        return $result;
    }
}
