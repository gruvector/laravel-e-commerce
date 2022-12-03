<?php

namespace Modules\Admin\Sidebar;

use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Contracts\RepositoryInterface as Modules;

class AdminSidebar implements Sidebar
{
    /**
     * The menu instance.
     *
     * @var \Maatwebsite\Sidebar\Menu
     */
    protected $menu;

    /**
     * Create a new sidebar instance.
     *
     * @param \Maatwebsite\Sidebar\Menu $menu
     * @return void
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Get the built menu.
     *
     * @return \Maatwebsite\Sidebar\Menu
     */
    public function getMenu()
    {
        $this->build();

        return $this->menu;
    }

    /**
     * Build the sidebar menu.
     *
     * @return void
     */
    public function build()
    {
        $this->addActiveThemeExtender();
        $this->addModuleExtenders();
    }

    /**
     * Add active theme's sidebar extender.
     *
     * @return void
     */
    private function addActiveThemeExtender()
    {
        $theme = setting('active_theme');

        $this->add("Themes\\{$theme}\\Sidebar\\SidebarExtender");
    }

    /**
     * Add all enabled modules sidebar extender.
     *
     * @return void
     */
    private function addModuleExtenders()
    {
        foreach (Module::allEnabled() as $module) {
            $this->add("Modules\\{$module->getName()}\\Sidebar\\SidebarExtender");
        }
    }

    /**
     * Add sidebar extender to the menu.
     *
     * @param string $extender
     * @return void
     */
    private function add($extender)
    {
        if (class_exists($extender)) {
            resolve($extender)->extend($this->menu);
        }

        $this->menu->add($this->menu);
    }
}
