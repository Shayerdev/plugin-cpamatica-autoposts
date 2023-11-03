<?php

namespace CAP\helpers;

class CreateMetabox
{
    public $id, $title, $screen, $callback;

    /**
     * MetaBox constructor.
     * @param $id
     * @param $title
     * @param $callback
     * @param $screen
     */
    public function __construct($id, $title, $callback, $screen)
    {
        $this->id = $id;
        $this->title = $title;
        $this->screen = $screen;
        $this->callback = $callback;
    }
    public function add()
    {
        add_meta_box(
            $this->id,
            $this->title,
            array($this, "callback"), // Append Callback Function from Child
            $this->screen,
            'advanced',
            'low'
        );
    }
    public function init()
    {
        add_action('add_meta_boxes', array($this, "add"));
    }
}
