<?php

namespace CAP\helpers;

class CreateScript extends CreateAssets{
    /**
     * Script constructor.
     * @param $options
     */
    public function __construct($options)
    {
        parent::__construct('script', $options);
    }
}

