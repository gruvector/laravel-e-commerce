<?php

namespace Modules\Slider\Http\Controllers\Admin;

use Modules\Slider\Entities\Slider;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Slider\Http\Requests\SaveSliderRequest;

class SliderController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'slider::sliders.slider';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'slider::admin.sliders';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveSliderRequest::class;
}
