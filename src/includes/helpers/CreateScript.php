<?php

namespace CAP\helpers;

class CreateScript extends CreateAssets
{
    /**
     * Script constructor.
     * @param array $options
     * @param bool $forAdmin
     */
    public function __construct($options, $forAdmin)
    {
        parent::__construct('script', $options, $forAdmin);
    }
}
