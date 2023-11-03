<?php

namespace CAP\shortcode;

use CAP\helpers\CreateShortcode;

class PostsList extends CreateShortcode
{
    /**
     * Tag shortcode
     *
     * @var string
     */
    public $name;

    public function __construct()
    {
        $this->name = "posts_list_shortcode";
        parent::__construct(array($this, 'callback'));
    }
    public function callback()
    {
        add_shortcode($this->name, function ($attr) {
            $attr = shortcode_atts(array(
                'create_page_id' => '1',
                'link_label' => 'Create Post'
            ), $attr, $this->name);
        });
    }
}
