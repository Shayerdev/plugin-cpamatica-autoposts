<?php

namespace CAP\metaboxes;

use CAP\CpamaticaAutoPosts;
use CAP\helpers\CreateMetabox;

class PostRating extends CreateMetabox
{
    /**
     * PostRating constructor.
     * @param $id
     * @param $title
     * @param $screen
     */
    public function __construct($id, $title, $screen)
    {
        parent::__construct($id, $title, array($this, "callback"), $screen);
    }

    /**
     * @param $post
     */
    public function callback($post)
    {
        $field_label = CpamaticaAutoPosts::getInstance()->settings["slug_meta"] . 'rating';
        $get_meta_rating = get_post_meta($post->ID, $field_label, true);
        if (empty($get_meta_rating)) {
            echo 'Rating empty';
            return;
        }

        ?>
        <input
            type="text"
            disabled
            value="<?php echo $get_meta_rating?>"
            name="<?php echo $field_label?>"
        />
        <?php
    }
}
