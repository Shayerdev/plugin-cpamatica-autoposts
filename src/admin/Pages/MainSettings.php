<?php

namespace CAP\admin\pages;

use CAP\admin\widgets\WidgetDescription;
use CAP\admin\widgets\WidgetInstructionList;
use CAP\admin\widgets\WidgetShortcode;
use CAP\admin\widgets\WidgetTitle;
use CAP\admin\widgets\WidgetUpdateUrl;
use CAP\CpamaticaAutoPosts;
use CAP\helpers\CreateAdminPage;
use CAP\helpers\CreateStyle;

class MainSettings extends CreateAdminPage
{
    /**
     * @param $menu_title
     * @param $page_title
     * @param $capability
     * @param $menu_slug
     * @param $action
     */
    public function __construct($menu_title, $page_title, $capability, $menu_slug, $action)
    {
        parent::__construct($menu_title, $page_title, $capability, $menu_slug, $action);
        $this->styles();
        $this->widgets();
    }

    /**
     * Widgets page
     *
     * @return void
     */
    protected function widgets()
    {
        $this->addWidget(array($this, 'widgetTitle'));
        $this->addWidget(array($this, 'widgetDescription'));
        $this->addWidget(array($this, 'widgetShortcode'));
        $this->addWidget(array($this, 'widgetListInstruction'));
        $this->addWidget(array($this, 'widgetUpdateUrl'));
    }

    public function styles()
    {
        new CreateStyle(array(
            'name' => "cpamatica-ap-admin-style",
            'src'  => plugin_dir_url(CPAMATICA_AUTO_POSTS_PLUGIN_DIR) . 'assets/build/css/admin_styles.css',
            'deps' => array(),
            'version' => '',
            'media' => 'all'
        ), true);
    }

    /**
     * Add title widget
     *
     * @return void
     */
    public function widgetTitle(): void
    {
        echo (new WidgetTitle($this->page_title))->render();
    }

    public function widgetDescription(): void
    {
        echo (new WidgetDescription(CpamaticaAutoPosts::getInstance()->getDescription()))->render();
    }
    public function widgetShortcode(): void
    {
        echo (new WidgetShortcode(CPAMATICA_AP_SHORTCODE_POSTS_TAG))->render();
    }
    public function widgetListInstruction()
    {
        echo (new WidgetInstructionList('Instructions'))->render();
    }

    public function widgetUpdateUrl()
    {
        echo (new WidgetUpdateUrl('Update posts url'))->render();
    }
}
