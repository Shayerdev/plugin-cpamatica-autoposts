<?php

namespace CAP\helpers;

class CreateStyle extends CreateAssets
{
    /**
     * Style constructor.
     * @param array $options
     * @param bool $forAdmin
     */
    public function __construct($options, $forAdmin = false)
    {
        parent::__construct('style', $options, $forAdmin);
    }
}
