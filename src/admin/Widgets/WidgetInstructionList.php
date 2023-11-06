<?php

namespace CAP\admin\widgets;

use CAP\abstractions\widgets\AdminWidgets;

class WidgetInstructionList extends AdminWidgets
{
    /**
     * Widget title
     *
     * @var string
     */
    public $listName;

    public function __construct(string $listName)
    {
        $this->listName = $listName;
    }
    public function render(): string
    {
        return sprintf(
            "<h3>%s</h3><ul class='widget-instruction-list'>%s %s %s %s</ul>",
            $this->listName,
            '<li><span>Title </span>Attribute fot display list title</li>',
            '<li><span>Count</span> Count display posts</li>',
            '<li><span>Sort</span> Sorting your post by date, reviews, title</li>',
            '<li><span>ids</span> Select posts by id</li>',
        );
    }
}
