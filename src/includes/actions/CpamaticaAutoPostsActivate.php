<?php

namespace CAP\actions;

use CAP\Exception\ExceptionDatabaseSettings;
use CAP\interfaces\model\IDatabaseSettings;
use CAP\model\settings\DatabaseSettings;
use CAP\interfaces\actions\ICpamaticaAutoPostsActions;

class CpamaticaAutoPostsActivate implements ICpamaticaAutoPostsActions
{
    /**
     * File string
     *
     * @var string
     */
    public $file_plugin;

    /**
     * @param string $file_plugin
     */
    public function __construct(string $file_plugin)
    {
        $this->file_plugin = $file_plugin;
    }
    public function init(): void
    {
        register_activation_hook($this->file_plugin, function () {
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
        try {
            if (!empty($dbSettings->get())) {
                return;
            }
            $dbSettings->createSettingsTable();
            $dbSettings->append();
        } catch (ExceptionDatabaseSettings $e) {
            $e->displayErrorNotice();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
