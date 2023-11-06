<?php

namespace CAP\interfaces\model;

interface IDatabaseSettings
{
    public function createSettingsTable(): void;
    public function deleteTable(): void;
    public function append(): void;
    public function get(): array;
}
