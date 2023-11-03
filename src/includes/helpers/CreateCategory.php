<?php

namespace CAP\helpers;

use CAP\interfaces\helpers\ICreateCategory;

class CreateCategory implements ICreateCategory
{
    public $name;
    public $categoryParent = 0;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setCategoryParent($id): void
    {
        $this->categoryParent = $id;
    }

    public function insert(): int
    {
        return (int) wp_create_category($this->name, $this->categoryParent);
    }
}
