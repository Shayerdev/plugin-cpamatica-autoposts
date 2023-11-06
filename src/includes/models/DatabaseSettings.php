<?php

namespace CAP\model\settings;

use CAP\Exception\ExceptionDatabaseSettings;
use CAP\interfaces\model\IDatabaseSettings;

class DatabaseSettings implements IDatabaseSettings
{
    /**
     * Database name
     *
     * @var string
     */
    private $db_name = CPAMATICA_TABLE_NAME;

    public function __construct()
    {
    }

    /**
     * Create Settings table
     *
     * @return void
     * @throws ExceptionDatabaseSettings;
     */
    public function createSettingsTable(): void
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->db_name;

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            " . CPAMATICA_TABLE_FIELD_AUTHOR . "        varchar(255),
            " . CPAMATICA_TABLE_FIELD_URL . "           varchar(255),
            " . CPAMATICA_TABLE_FIELD_URL_A_KEY . "     varchar(255),
            " . CPAMATICA_TABLE_FIELD_URL_A_VAL . "     varchar(255),
            " . CPAMATICA_TABLE_FIELD_URL_POST_TYPE . " varchar(255),
            " . CPAMATICA_TABLE_FIELD_API_PHRASE . "    varchar(255)
        )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        if ($wpdb->last_error) {
            throw new ExceptionDatabaseSettings("Database Settings: Table {$this->db_name} not created.");
        }
    }

    /**
     * Delete table
     *
     * @return void
     * @throws ExceptionDatabaseSettings
     */
    public function deleteTable(): void
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->db_name;
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
        if ($wpdb->last_error) {
            throw new ExceptionDatabaseSettings("Database Settings: Table $this->db_name not deleted.");
        }
    }

    /**
     * Append Value (default)
     *
     * @return void
     * @throws ExceptionDatabaseSettings
     */
    public function append(): void
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->db_name;

        $defaultSettings = $wpdb->prepare(
            "INSERT INTO {$table_name}
            (" . CPAMATICA_TABLE_FIELD_AUTHOR . ", 
            " . CPAMATICA_TABLE_FIELD_URL . ", 
            " . CPAMATICA_TABLE_FIELD_URL_A_KEY . ",
            " . CPAMATICA_TABLE_FIELD_URL_A_VAL . ", 
            " . CPAMATICA_TABLE_FIELD_URL_POST_TYPE . ",
            " . CPAMATICA_TABLE_FIELD_API_PHRASE . "
            )
            VALUES (%s, %s, %s, %s, %s, %s)",
            AUTHOR,
            CPAMATICA_AP_DEF_URL_POSTS,
            CPAMATICA_AP_DEF_URL_AUTH_K,
            CPAMATICA_AP_DEF_URL_AUTH_V,
            CPAMATICA_AP_DEF_TYPE_POST,
            CPAMATICA_AP_SECRET_API_PHRASE
        );

        $wpdb->query($defaultSettings);

        if ($wpdb->last_error) {
            throw new ExceptionDatabaseSettings("Database Settings: Default data for table {$this->db_name} not created.");
        }
    }

    /**
     * Get data Setting from table
     *
     * @return array|void
     * @throws ExceptionDatabaseSettings
     */
    public function get(): array
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->db_name;

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            return [];
        }

        $response =  $wpdb->get_results("SELECT * FROM {$table_name}");
        if ($wpdb->last_error) {
            throw new ExceptionDatabaseSettings("Database Settings: Table {$this->db_name} not deleted.");
        }
        return $response ? $response : [];
    }
}
