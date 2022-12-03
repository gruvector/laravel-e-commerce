@include('media::admin.image_picker.single', [
    'title' => trans('brand::brands.form.logo'),
    'inputName' => 'files[logo]',
    'file' => $brand->logo,
])

<div class="media-picker-divider"></div>

@include('media::admin.image_picker.single', [
    'title' => trans('brand::brands.form.banner'),
    'inputName' => 'files[banner]',
    'file' => $brand->banner,
])
