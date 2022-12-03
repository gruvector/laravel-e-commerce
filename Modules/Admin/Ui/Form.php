<?php

namespace Modules\Admin\Ui;

use Modules\Admin\Ui\Concerns\InputFields;

class Form
{
    use InputFields;

    protected $unnecessaryAttributes = ['disabled', 'readonly', 'checked'];

    public function text($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'text']));
    }

    public function password($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'password']));
    }

    public function number($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'number']));
    }

    public function email($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'email']));
    }

    public function file($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'file']));
    }

    public function color($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->input($name, $title, $errors, $entity, array_merge($options, ['type' => 'color']));
    }

    public function input($name, $title, $errors, $entity = null, $options = [])
    {
        return $this->field($name, $title, $errors, $entity, $options, [$this, 'inputField']);
    }

    public function textarea($name, $title, $errors, $entity = null, $options = [])
    {
        $options = array_merge(['rows' => 10, 'cols' => 10], $options);

        return $this->field($name, $title, $errors, $entity, $options, [$this, 'textareaField']);
    }

    public function wysiwyg($name, $title, $errors, $entity = null, $options = [])
    {
        $options['class'] = array_get($options, 'class', '') . ' wysiwyg';

        return $this->textarea($name, $title, $errors, $entity, $options);
    }

    public function checkbox($name, $title, $label, $errors, $entity = null, $options = [])
    {
        return $this->field($name, $title, $errors, $entity, $options, [$this, 'checkboxField'], $label);
    }

    public function select($name, $title, $errors, $list = [], $entity = null, $options = [])
    {
        return $this->field($name, $title, $errors, $entity, $options, [$this, 'selectField'], $list);
    }
}
