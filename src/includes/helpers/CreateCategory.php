<?php

namespace CAP\helpers;

use CAP\interfaces\helpers\ICreateCategory;

class CreateCategory implements ICreateCategory
{
    /**
     * Category name
     *
     * @var string
     */
    public $name;

    /**
     * Category parent
     *
     * @var int
     */
    public $categoryParent = 0;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param $id
     * @return void
     */
    public function setCategoryParent($id): void
    {
        $this->categoryParent = $id;
    }

    /**
     * @return int
     */
    public function insert(): int
    {
        return (int) wp_create_category($this->name, $this->categoryParent);
    }
}
