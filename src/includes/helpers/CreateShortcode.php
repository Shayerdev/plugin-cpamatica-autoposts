<?php

namespace CAP\helpers;

class CreateShortcode
{
    /**
     * @var callable
     */
    public $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }
    public function init()
    {
        add_action('init', $this->callback);
    }
}
