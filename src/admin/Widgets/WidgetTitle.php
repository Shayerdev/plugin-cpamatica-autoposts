<?php

namespace CAP\admin\widgets;

use CAP\abstractions\widgets\AdminWidgets;

class WidgetTitle extends AdminWidgets
{
    /**
     * Widget title
     *
     * @var string
     */
    public $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }
    public function render(): string
    {
        return "<h2>$this->title</h2>";
    }
}
