<?php

namespace CAP\helpers;

use CAP\interfaces\helpers\ICreatePost;

class CreatePost implements ICreatePost
{
    /**
     * Title post
     *
     * @var string
     */
    public $title;

    /**
     * Content post
     *
     * @var string
     */
    public $content;

    /**
     * Category post
     *
     * @var string
     */
    public $category = 0;

    /**
     * Status post
     *
     * @var string
     */
    public $statusPost = 'publish';

    /**
     * Post Type
     *
     * @var string
     */
    public $typePost = 'post';

    /**
     * meta Fields post
     *
     * @var array
     */
    public $metaFields = [];

    public function setTitle($title): void
    {
        $this->title = wp_strip_all_tags($title);
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setCategory($id): void
    {
        $this->category = $id;
    }

    public function setStatusPost($status): void
    {
        $this->statusPost = $status;
    }

    public function setTypePost($typePost): void
    {
        $this->typePost = $typePost;
    }

    public function setMetaField($metaFields): void
    {
        $this->metaFields = array_push($this->metaFields, $metaFields);
    }

    public function insert(): int
    {
        $dataPost = array(
            'post_title' => $this->title,
            'post_content' => $this->content,
            'post_status' => $this->statusPost,
            'post_category' => [$this->category],
            'post_type' => $this->typePost
        );

        if (!empty($this->metaFields)) {
            $dataPost = array_merge($dataPost, array('meta_input' => $this->metaFields));
        }

        return wp_insert_post($dataPost);
    }
}
