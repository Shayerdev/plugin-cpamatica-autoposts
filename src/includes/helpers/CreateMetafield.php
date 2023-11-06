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
        $this->prefix = CPAMATICA_AP_SLUG_META;
    }
    public function update(string $field, $value): bool
    {
        return update_post_meta($this->postId, $this->prefix . $field, $value);
    }
}
