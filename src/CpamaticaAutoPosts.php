<?php

namespace CAP;

use CAP\interfaces\plugin\ICpamaticaAutoPostBase;

class CpamaticaAutoPosts implements ICpamaticaAutoPostBase
{
    /**
     * @var object
     */
    private static $instance;

    /**
     * The plugin version
     *
     * @var string
     */
    public $version = '1.0';

    /**
     * The Plugin Name
     *
     * @var string
     */
    public $name = 'Auto Posts by Cpamatica';

    /**
     * The plugin description
     *
     * @var string
     */
    public $description = 'Cool plugin for auto posts';

    /**
     * Initialize Settings
     *
     * @var array
     */
    public $settings = array();


    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Method: Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Method: Get version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Method get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Method: Set Default settings
     *
     * @return void
     */
    public function initializer()
    {
        $this->settings = array(
            "author" => get_current_user_id(),
            "url_posts" => "https://my.api.mockaroo.com/posts.json",
            "posts_url_auth" => array(
                "key" => "X-API-Key",
                "val" => "413dfbf0"
            )
        );
    }

    public function activate($activateInstance): void
    {
        $this->initializer(); // Set default settings
        $activateInstance->init();
    }

    public function diactivate($deactivateInstance): void
    {
        $deactivateInstance->init();
    }

    public function uninstall($uninstallInstance): void
    {
        $uninstallInstance->init();
    }
}
