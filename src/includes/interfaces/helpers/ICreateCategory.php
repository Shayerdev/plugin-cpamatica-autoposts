<?php

namespace CAP\interfaces\helpers;

interface ICreateCategory
{
    public function setCategoryParent(int $id): void;
    public function insert(): int;
}
