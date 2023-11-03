<?php

namespace CAP\helpers;

use CAP\interfaces\helpers\ICreatePost;
use DateTime;

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

    /**
     * @param $title
     * @return void
     */
    public function setTitle($title): void
    {
        $this->title = wp_strip_all_tags($title);
    }

    /**
     * @param $content
     * @return void
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param $id
     * @return void
     */
    public function setCategory($id): void
    {
        $this->category = $id;
    }

    /**
     * @param $status
     * @return void
     */
    public function setStatusPost($status): void
    {
        $this->statusPost = $status;
    }

    /**
     * @param $typePost
     * @return void
     */
    public function setTypePost($typePost): void
    {
        $this->typePost = $typePost;
    }

    /**
     * @param $metaFields
     * @return void
     */
    public function setMetaField($metaFields): void
    {
        $this->metaFields = array_push($this->metaFields, $metaFields);
    }

    /**
     * @return int
     */
    public function insert(): int
    {
        $dataPost = array(
            'post_title' => $this->title,
            'post_content' => $this->content,
            'post_status' => $this->statusPost,
            'post_category' => [$this->category],
            'post_type' => $this->typePost,
            'post_date' => $this->randomMonthDate()
        );

        return wp_insert_post($dataPost);
    }

    private function randomMonthDate(): string
    {
        $currentDate = new DateTime();
        $monthAgo = new DateTime('-1 month');
        $randomDate = mt_rand($monthAgo->getTimestamp(), $currentDate->getTimestamp());
        $randomDateObj = new DateTime();
        $randomDateObj->setTimestamp($randomDate);
        return $randomDateObj->format('Y-m-d H:i:s');
    }
}
