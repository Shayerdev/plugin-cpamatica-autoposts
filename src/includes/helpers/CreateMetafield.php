<?php

namespace CAP\helpers;

use CAP\CpamaticaAutoPosts;

class CreateMetafield
{
    /**
     * Meta prefix
     *
     * @var string
     */
    protected $prefix;

    /**
     * @var int
     */
    protected $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
        $this->prefix = CpamaticaAutoPosts::getInstance()->settings["slug_meta"];
    }
    public function update(string $field, float $value): bool
    {
        return update_post_meta($this->postId, $this->prefix . $field, $value);
    }
}
