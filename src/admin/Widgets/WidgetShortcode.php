<?php

namespace CAP\admin\widgets;

use CAP\abstractions\widgets\AdminWidgets;

class WidgetShortcode extends AdminWidgets
{
    /**
     * Widget title
     *
     * @var string
     */
    public $shortcode;

    public function __construct(string $shortcode)
    {
        $this->shortcode = $shortcode;
    }
    public function render(): string
    {
        return sprintf(
            "<div class='widget-shortcode'><span>[</span> %s %s %s %s %s<span>]</span></div>",
            $this->shortcode,
            '<span>title=</span>"News"',
            '<span>count=</span>"5"',
            '<span>sort=</span>"date"',
            '<span>ids </span>"12,34"',
        );
    }
}
