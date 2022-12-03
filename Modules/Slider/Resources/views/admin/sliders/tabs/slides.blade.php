<div id="slides-wrapper" class="clearfix">
    {{-- Slides will be added here dynamically using JS --}}
</div>

<div class="form-group">
    <button type="button" class="add-slide btn btn-default m-l-15">
        {{ trans('slider::sliders.slide.add_slide') }}
    </button>
</div>

@include('slider::admin.sliders.templates.slide')

@push('globals')
    <script>
        FleetCart.data['slider.slides'] = {!! old_json('slides', $slider->slides) !!};
    </script>
@endpush
