<?php

namespace CAP\helpers;

class CreateAdminPage
{
    /**
     * Menu title
     *
     * @var string
     */
    public $menu_title;

    /**
     * Page title
     *
     * @var string
     */
    public $page_title;

    /**
     * Manage options
     *
     * @var string
     */
    public $capability;

    /**
     * Url slug
     *
     * @var string
     */
    public $menu_slug;

    /**
     * Name action
     *
     * @var
     */
    public $action;

    /**
     * @param string $menu_title
     * @param string $page_title
     * @param string $capability
     * @param string $menu_slug
     * @param string $action
     */
    public function __construct(
        string $menu_title,
        string $page_title,
        string $capability,
        string $menu_slug,
        string $action
    ) {
        $this->menu_title = $menu_title;
        $this->page_title = $page_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;

        add_action('admin_menu', array($this, 'addAdminPage'));
    }

    /**
     * Init add menu hook
     *
     * @return void
     */
    public function addAdminPage()
    {
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            array($this, 'renderAdminPage')
        );
    }

    /**
     * Render wrapper content
     *
     * @return void
     */
    public function renderAdminPage()
    {
        ?>
        <div class="wrap">
            <main class="page-content-cpamatica">
                <?php do_action($this->action);?>
            </main>
        </div>
        <?php
    }

    /**
     * Adding widget method by action slug
     *
     * @param $widgetCallback
     * @return void
     */
    public function addWidget($widgetCallback)
    {
        add_action($this->action, $widgetCallback);
    }
}
