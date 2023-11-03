<?php

    namespace CAP\actions;

    use CAP\Exception\ExceptionDatabaseSettings;
    use CAP\interfaces\model\IDatabaseSettings;
    use CAP\model\settings\DatabaseSettings;
    use CAP\interfaces\actions\ICpamaticaAutoPostsUninstall;

class CpamaticaAutoPostsUninstall implements ICpamaticaAutoPostsUninstall
{
    public $file_plugin;

    public $settings;

    public function __construct(string $file_plugin)
    {
        $this->file_plugin = $file_plugin;
    }
    public function init(): void
    {
        register_uninstall_hook($this->file_plugin, array($this, 'callback_action'));
    }

    public function callback_action(): void
    {
        $db = new DatabaseSettings();
        try {
            $db->deleteTable();
        } catch (ExceptionDatabaseSettings $e) {
            $e->displayErrorNotice();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
