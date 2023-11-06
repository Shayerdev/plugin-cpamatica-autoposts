<?php

namespace CAP\admin\widgets;

use CAP\abstractions\widgets\AdminWidgets;
use CAP\actions\CpamaticaAutoPostsSettings;

class WidgetUpdateUrl extends AdminWidgets
{
    /**
     * Widget label
     *
     * @var string
     */
    public $label;

    public function __construct(string $label)
    {
        $this->label = $label;
    }
    public function render(): string
    {
        return sprintf(
            "<div class='widget-update-url'><div class='label'>%s</div><a target='_blank' rel='nofollow' href='%s'>%s</a></div>",
            $this->label,
            get_home_url() . '/wp-json/wp/v2/loadposts/' . CpamaticaAutoPostsSettings::getApiPhrase(),
            get_home_url() . '/wp-json/wp/v2/loadposts/' . CpamaticaAutoPostsSettings::getApiPhrase()
        );
    }
}
