<?php

namespace Modules\Admin\Ui;

class TabManager
{
    /**
     * The array of all Tabs.
     *
     * @var array
     */
    private $tabs = [];

    /**
     * The array of all tabs extenders.
     *
     * @var array
     */
    private $extends = [];

    /**
     * Register a new Tabs.
     *
     * @param string $name
     * @param string $tabs
     * @return void
     */
    public function register($name, $tabs)
    {
        $this->tabs[$name] = $tabs;
    }

    /**
     * Add a new Tabs extender.
     *
     * @param string $name
     * @param string $extender
     * @return void
     */
    public function extend($name, $extender)
    {
        $this->extends[$name][] = $extender;
    }

    /**
     * Get tabs for the given name.
     *
     * @param string $name
     * @return \Modules\Admin\Ui\Tabs
     */
    public function get($name)
    {
        if (! array_key_exists($name, $this->tabs)) {
            return;
        }

        return tap(resolve($this->tabs[$name]), function (Tabs $tabs) use ($name) {
            $tabs->make();

            $this->extendTabs($tabs, array_get($this->extends, $name, []));
        });
    }

    /**
     * Extend the given tabs using the given extenders.
     *
     * @param \Modules\Admin\Ui\Tabs $tabs
     * @param array $extenders
     * @return void
     */
    private function extendTabs(Tabs $tabs, array $extenders)
    {
        foreach ($extenders as $extender) {
            resolve($extender)->extend($tabs);
        }
    }
}
