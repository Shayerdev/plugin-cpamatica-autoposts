<?php

namespace CAP\actions;

use CAP\helpers\CreateStyle;

class CpamaticaAutoPostsActions
{
    public function __construct()
    {
        self::postListShortcode();
    }

    public static function postListShortcode()
    {
        add_action('init_postlist_shortcode', function () {
            new CreateStyle(array(
                'name' => 'cpamatica-shortcode-style',
                'src'  => plugin_dir_url(CPAMATICA_AUTO_POSTS_PLUGIN_DIR) . 'assets/build/css/frontend_styles.css',
                'deps' => array(),
                'version' => '',
                'media' => 'all'
            ));
        });
    }
}
