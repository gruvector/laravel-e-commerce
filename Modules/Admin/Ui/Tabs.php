<?php

namespace Modules\Admin\Ui;

use InvalidArgumentException;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

abstract class Tabs
{
    /**
     * Array of all groups.
     *
     * @var array
     */
    protected $groups = [];

    /**
     * Current group name of the tabs.
     *
     * @var string
     */
    protected $group;

    /**
     * Array of all tabs.
     *
     * @var array
     */
    protected $tabs = [];

    /**
     * Indicate that submit button should add offset class.
     *
     * @var bool
     */
    protected $buttonOffset = true;

    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    abstract public function make();

    /**
     * Set group name.
     *
     * @param string $name
     * @param string $title
     * @return self
     */
    public function group($name, $title = null)
    {
        $this->group = $name;

        if (! is_null($title)) {
            $this->groups[$name]['title'] = $title;
        }

        return $this;
    }

    /**
     * Set current group as active group.
     *
     * @return self
     */
    public function active()
    {
        $this->groups[$this->group]['active'] = true;

        return $this;
    }

    /**
     * Add new tab.
     *
     * @param \Modules\Admin\Ui\Tab|null $tab
     * @return void
     */
    public function add($tab)
    {
        if (! is_null($tab)) {
            $this->tabs[$this->group][] = $tab;
        }

        return $this;
    }

    /**
     * Determine if tabs fields has any error.
     *
     * @return bool
     */
    public function hasError()
    {
        return $this->getErrors()->hasAny($this->getTabFields());
    }

    /**
     * Get error message bag.
     *
     * @return \Illuminate\Support\ViewErrorBag
     */
    protected function getErrors()
    {
        return request()->session()->get('errors') ?: new ViewErrorBag;
    }

    /**
     * Get all tabs fields.
     *
     * @return array
     */
    protected function getTabFields()
    {
        return array_reduce($this->getSortedTabs(), function ($fields, Tab $tab) {
            return array_merge($fields, $tab->getFields());
        }, []);
    }

    /**
     * Generate navs for the tabs.
     *
     * @param array $data
     * @return \Illuminate\Support\HtmlString
     */
    public function navs($data = [])
    {
        return new HtmlString($this->getTabsData('nav', $data));
    }

    /**
     * Render the tabs,
     *
     * @param array $data
     * @return void
     */
    public function render($data = [])
    {
        return view('admin::components.accordion', [
            'tabs' => $this,
            'name' => class_basename($this),
            'groups' => $this->groups(),
            'contents' => $this->contents($data),
            'buttonOffset' => $this->buttonOffset,
        ]);
    }

    /**
     * Get all groups with it's options.
     *
     * @return array
     */
    protected function groups()
    {
        $groups = [];

        foreach ($this->groups as $group => $options) {
            $groups[$group] = $options;
        }

        return $groups;
    }

    /**
     * Generate contents for the tabs.
     *
     * @param array $data
     * @return \Illuminate\Support\HtmlString
     */
    protected function contents($data = [])
    {
        $contents = '';

        foreach ($this->groups as $group => $options) {
            $contents .= $this->group($group)->getTabsData('view', $data);
        }

        return new HtmlString($contents);
    }

    /**
     * Get tabs data for the given type.
     *
     * @param string $type
     * @param array $data
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function getTabsData($type, $data = [])
    {
        if (! array_key_exists($this->group, $this->tabs)) {
            throw new InvalidArgumentException("Group [$this->group] is not registered.");
        }

        $html = '';

        foreach ($this->getSortedTabs() as $tab) {
            $method = 'get' . ucfirst($type);

            if (method_exists($tab, $method)) {
                $html .= call_user_func_array([$tab, $method], [$data]);
            }
        }

        return $html;
    }

    /**
     * Get sorted tabs.
     *
     * @return array
     */
    protected function getSortedTabs()
    {
        return collect($this->tabs[$this->group])->sortBy(function (Tab $tab) {
            return $tab->getWeight();
        })->all();
    }
}
