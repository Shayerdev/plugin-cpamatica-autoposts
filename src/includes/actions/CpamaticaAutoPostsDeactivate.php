<?php

namespace CAP\actions;

use CAP\interfaces\model\IDatabaseSettings;
use CAP\model\settings\DatabaseSettings;
use CAP\interfaces\actions\ICpamaticaAutoPostsActions;

class CpamaticaAutoPostsDeactivate implements ICpamaticaAutoPostsActions
{
    public $file_plugin;

    public $settings;

    /**
     * @param string $file_plugin
     */
    public function __construct(string $file_plugin)
    {
        $this->file_plugin = $file_plugin;
    }

    public function init(): void
    {
        register_deactivation_hook($this->file_plugin, function () {
            $db = new DatabaseSettings();
            $this->callback_action($db);
        });
    }

    /**
     * @param IDatabaseSettings $dbSettings
     * @return void
     */
    public function callback_action(IDatabaseSettings $dbSettings): void
    {
        // Some callback
    }
}
