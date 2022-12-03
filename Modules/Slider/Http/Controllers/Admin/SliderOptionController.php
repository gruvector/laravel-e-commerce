<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Slider\Entities\SliderOption;
use Modules\Slider\Http\Requests\SaveSliderOptionRequest;

class SliderOptionController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = SliderOption::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'slider::slider_options.slider_option';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'slider::admin.slider_options';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveSliderOptionRequest::class;
}
