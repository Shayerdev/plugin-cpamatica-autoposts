<?php

namespace CAP\interfaces\plugin;

use CAP\interfaces\actions\ICpamaticaAutoPostsActions;
use CAP\interfaces\actions\ICpamaticaAutoPostsUninstall;

interface ICpamaticaAutoPostBase
{
    public function getVersion(): string;
    public function getName(): string;
    public function getDescription(): string;
    public function activate(ICpamaticaAutoPostsActions $activateInstance): void;
    public function diactivate(ICpamaticaAutoPostsActions $deactivateInstance): void;
    public function uninstall(ICpamaticaAutoPostsUninstall $uninstallInstance): void;
    public function apiEndpoints(): void;
}
