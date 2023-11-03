<?php

    namespace CAP\interfaces\actions;

    use CAP\interfaces\model\IDatabaseSettings;

interface ICpamaticaAutoPostsUninstall
{
    public function init(): void;
    public function callback_action(): void;
}
