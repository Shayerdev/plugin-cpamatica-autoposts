<?php

namespace CAP\helpers;

class CreateEndpoint
{
    public $slug, $version, $endpoint, $callback, $args, $method;

    public function __construct($slug, $version, $endpoint, $callback, $args = [], $method = 'GET')
    {

        $this->slug = $slug;
        $this->version = $version;
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->callback = $callback;
        $this->args = $args;
    }

    public function registerRoute()
    {
        register_rest_route($this->slug . '/' . $this->version, '/' . $this->endpoint, array(
            'methods'  => $this->method,
            'callback' => array($this, "callback"),
            'args'     => $this->args
        ));
    }

    public function init()
    {
        add_action('rest_api_init', array($this, 'registerRoute'));
    }
}
