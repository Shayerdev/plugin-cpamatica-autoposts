<?php

namespace CAP;

use CAP\actions\CpamaticaAutoPostsActions;
use CAP\admin\pages\MainSettings;
use CAP\endpoint\ApiCreatePosts;
use CAP\interfaces\plugin\ICpamaticaAutoPostBase;
use CAP\metaboxes\PostLink;
use CAP\metaboxes\PostRating;
use CAP\shortcode\PostsList;

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
    public $description = "Cool plugin for auto posts!";

    private function __construct()
    {
    }

    /**
     * Singleton Pattern
     *
     * @return object|self
     */
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

    public function defines()
    {
        define("AUTHOR", get_current_user_id());
        define("CPAMATICA_AP_SLUG_META", 'cpamatica_meta_field_');
        define("CPAMATICA_AP_LOCALE", "cpamatica-auto-post");
        define("CPAMATICA_AP_SECRET_API_PHRASE", "weneedsomelove");
        define("CPAMATICA_AP_DEF_TYPE_POST", "post");
        define("CPAMATICA_AP_SHORTCODE_POSTS_TAG", "posts_list_shortcode");
        define("CPAMATICA_AP_DEF_URL_POSTS", "https://my.api.mockaroo.com/posts.json");
        define("CPAMATICA_AP_DEF_URL_AUTH_K", "X-API-Key");
        define("CPAMATICA_AP_DEF_URL_AUTH_V", "413dfbf0");

        // Table data
        define("CPAMATICA_TABLE_NAME", "cpamatica_settings");
        define("CPAMATICA_TABLE_FIELD_AUTHOR", "author");
        define("CPAMATICA_TABLE_FIELD_URL", "url_posts");
        define("CPAMATICA_TABLE_FIELD_URL_A_KEY", "auth_key");
        define("CPAMATICA_TABLE_FIELD_URL_A_VAL", "auth_val");
        define("CPAMATICA_TABLE_FIELD_URL_POST_TYPE", "post_type");
        define("CPAMATICA_TABLE_FIELD_API_PHRASE", "api_secret");
    }

    /**
     * Plugin Pages
     *
     * @return void
     */
    public function adminPages()
    {
        new MainSettings(
            'CPAM AutoPosts',
            'Auto Posts Settings',
            'manage_options',
            'cpamatica-autopost',
            'cpamatica_autopost_content_main_settings'
        );
    }

    /**
     * Plugin Endpoints
     *
     * @return void
     */
    public function apiEndpoints(): void
    {
        (new ApiCreatePosts('wp', 'v2', 'loadposts/(?P<key>[a-z-]*)'))->init();
    }

    /**
     * Plugin Metaboxes
     *
     * @return void
     */
    public function metaboxes(): void
    {
        (new PostRating('post_rating_metabox', 'Rating Metabox', 'post'))->init();
        (new PostLink('post_link_metabox', 'Link Metabox', 'post'))->init();
    }

    /**
     * Plugin Actions
     *
     * @return void
     */
    public function actions()
    {
        new CpamaticaAutoPostsActions();
    }

    /**
     * Plugin Shortcode`s
     *
     * @return void
     */
    public function shortcode(): void
    {
        (new PostsList())->init();
    }

    /**
     * Hook Activate Plugin
     *
     * @param $activateInstance
     * @return void
     */
    public function activate($activateInstance): void
    {
        $activateInstance->init();
    }

    /**
     * Hook deactivate plugin
     *
     * @param $deactivateInstance
     * @return void
     */
    public function diactivate($deactivateInstance): void
    {
        $deactivateInstance->init();
    }

    /**
     * Hook Uninstall plugin
     *
     * @param $uninstallInstance
     * @return void
     */
    public function uninstall($uninstallInstance): void
    {
        $uninstallInstance->init();
    }
}
