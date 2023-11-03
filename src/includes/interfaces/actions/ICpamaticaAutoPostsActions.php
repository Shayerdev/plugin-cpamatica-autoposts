<?php

namespace CAP\interfaces\actions;

use CAP\interfaces\model\IDatabaseSettings;

interface ICpamaticaAutoPostsActions
{
    public function init(): void;
    public function callback_action(IDatabaseSettings $dbSettings): void;
}
