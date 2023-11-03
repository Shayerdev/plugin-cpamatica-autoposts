<?php

namespace CAP\model\settings;

use CAP\CpamaticaAutoPosts;
use CAP\Exception\ExceptionDatabaseSettings;
use CAP\interfaces\model\IDatabaseSettings;

class DatabaseSettings implements IDatabaseSettings
{

    /**
     * Database name
     *
     * @var string
     */
    private $db_name = 'cpamatica_settings';

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
            author varchar(255),
            url_posts varchar(255),
            auth_key varchar(255),
            auth_val varchar(255)
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
            throw new ExceptionDatabaseSettings("Database Settings: Table {$this->db_name} not deleted.");
        }
    }

    /**
     * @return void
     * @throws ExceptionDatabaseSettings
     */
    public function append(): void
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->db_name;
        $pluginInitializerData = CpamaticaAutoPosts::getInstance()->settings;
        $author = $pluginInitializerData['author'];
        $url_posts = $pluginInitializerData['url_posts'];
        $auth_key = $pluginInitializerData['posts_url_auth']['key'];
        $auth_val = $pluginInitializerData['posts_url_auth']['val'];

        $defaultSettings = $wpdb->prepare(
            "INSERT INTO {$table_name}
            (author, url_posts, auth_key, auth_val)
            VALUES (%s, %s, %s, %s)",
            $author,
            $url_posts,
            $auth_key,
            $auth_val
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

    public function updateSettings(): void
    {
    }
}
