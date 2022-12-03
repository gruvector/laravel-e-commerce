<?php

namespace Modules\Admin\Ui;

use Illuminate\Support\ViewErrorBag;

class Tab
{
    /**
     * Active state of the tab.
     *
     * @var bool
     */
    private $active = false;

    /**
     * Name of the tab.
     *
     * @var string
     */
    private $name;

    /**
     * Label of the tab.
     *
     * @var string
     */
    private $label;

    /**
     * Weight of the tab.
     *
     * @var int
     */
    private $weight = 0;

    /**
     * Available fields on the tab.
     *
     * @var array
     */
    private $fields = [];

    /**
     * View of the tab.
     *
     * @var string|\Closure
     */
    private $view;

    /**
     * Data for the tab view.
     *
     * @var array
     */
    private $data;

    /**
     * Error message bag.
     *
     * @var \Illuminate\Support\ViewErrorBag
     */
    private $errors;

    /**
     * Create a new Tab instance.
     *
     * @param string $name
     * @param string $label
     * @return void
     */
    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
        $this->errors = request()->session()->get('errors') ?: new ViewErrorBag;
    }

    /**
     * Set tab as active.
     *
     * @return self
     */
    public function active()
    {
        $this->active = true;

        return $this;
    }

    /**
     * Set weight of tab.
     *
     * @param int $weight
     * @return self
     */
    public function weight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight of the tab.
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get nav of the tab.
     *
     * @param array $data
     * @return string
     */
    public function getNav()
    {
        return "<li class='{$this->activeClass()} {$this->errorClass()}'>
            <a href='#{$this->name}' data-toggle='tab'>{$this->label}</a>
        </li>";
    }

    /**
     * Return active class if tab is active.
     *
     * @return string
     */
    private function activeClass()
    {
        return $this->active ? 'active' : '';
    }

    /**
     * Return error class if tab fields has any error.
     *
     * @return string
     */
    private function errorClass()
    {
        return $this->errors->hasAny($this->fields) ? 'has-error' : '';
    }

    /**
     * Set fields of the tab.
     *
     * @param array|string $fields
     * @return self
     */
    public function fields($fields)
    {
        $this->fields = is_array($fields) ? $fields : func_get_args();

        return $this;
    }

    /**
     * Get fields of the tab.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set view of the tab.
     *
     * @param \Closure|string $view
     * @param array $data
     * @return self
     */
    public function view($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;

        return $this;
    }

    /**
     * Get view of the tab.
     *
     * @param array $data
     * @return string
     */
    public function getView($data = [])
    {
        $html = "<div class='tab-pane fade in {$this->activeClass()}' id='{$this->name}'>";
        $html .= "<h3 class='tab-content-title'>{$this->label}</h3>";

        if (is_callable($this->view)) {
            $html .= call_user_func($this->view, array_merge($this->data, $data));
        } else {
            $html .= view($this->view)->with(array_merge($this->data, $data))->render();
        }

        return $html .= '</div>';
    }
}
