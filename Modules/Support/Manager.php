<?php

namespace Modules\Support;

abstract class Manager
{
    private $drivers = [];

    public function all()
    {
        return collect($this->drivers);
    }

    public function names()
    {
        return array_keys($this->drivers);
    }

    public function get($name)
    {
        return array_get($this->drivers, $name);
    }

    public function register($name, $driver)
    {
        $this->drivers[$name] = is_callable($driver) ? call_user_func($driver) : $driver;

        return $this;
    }

    public function count()
    {
        return count($this->drivers);
    }

    public function isEmpty()
    {
        return empty($this->drivers);
    }

    public function isNotEmpty()
    {
        return ! $this->isEmpty();
    }
}
