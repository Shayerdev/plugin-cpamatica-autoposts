<?php

namespace CAP\helpers;

use CAP\interfaces\helpers\ICreateFeatureImage;

require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

class CreateFeatureImage implements ICreateFeatureImage
{
    /**
     * Image Url
     *
     * @var string
     */
    public $imageUrl = '';

    /**
     * Post id
     *
     * @var int
     */
    public $postId;

    /**
     * Post title
     *
     * @var string
     */
    public $postTitle;

    /**
     * Return type html | src | id
     *
     * @var string
     */
    public $returnType;

    /**
     * @param int $postId
     * @param string $postTitle
     */
    public function __construct(int $postId, string $postTitle)
    {
        $this->postId = $postId;
        $this->postTitle = $postTitle;
        $this->returnType = 'id';
    }

    /**
     * @param $imageUrl
     * @return void
     */
    public function setImageUrl($imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
     */
    public function insert(): int
    {
        return (int) media_sideload_image($this->imageUrl, $this->postId, $this->postTitle, $this->returnType);
    }

    public function updateThumbPost($attachmentId)
    {
        $updatedPost = wp_update_post(array(
            "ID" => $this->postId,
            "post_thumbnail" => $attachmentId
        ));
        if (! is_wp_error($updatedPost)) {
            update_post_meta($updatedPost, '_thumbnail_id', $attachmentId);
        }
    }
}
