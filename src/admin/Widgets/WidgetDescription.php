<?php

namespace CAP\admin\widgets;

use CAP\abstractions\widgets\AdminWidgets;

class WidgetDescription extends AdminWidgets
{
    /**
     * Widget title
     *
     * @var string
     */
    public $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }
    public function render(): string
    {
        return "<p>$this->description</p>";
    }
}
