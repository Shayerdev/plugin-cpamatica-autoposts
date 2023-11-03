<?php

namespace CAP;

use CAP\actions\CpamaticaAutoPostsActions;
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
            "slug_meta" => "cpmatica_meta_field_",
            "locale" => "cpamatica-auto-post",
            "secret_api_phrase" => "weneedsomelove",
            "post_type" => "post",
            "url_posts" => "https://my.api.mockaroo.com/posts.json",
            "posts_url_auth" => array(
                "key" => "X-API-Key",
                "val" => "413dfbf0"
            )
        );
    }

    public function apiEndpoints(): void
    {
        (new ApiCreatePosts('wp', 'v2', 'loadposts/(?P<key>[a-z-]*)'))->init();
    }

    public function metaboxes(): void
    {
        (new PostRating('post_rating_metabox', 'Rating Metabox', 'post'))->init();
        (new PostLink('post_link_metabox', 'Link Metabox', 'post'))->init();
    }

    public function actions()
    {
        new CpamaticaAutoPostsActions();
    }

    public function shortcode(): void
    {
        (new PostsList())->init();
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
