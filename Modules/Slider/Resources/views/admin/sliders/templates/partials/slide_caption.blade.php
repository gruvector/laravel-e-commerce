<div class="slide-options caption-{{ $captionNumber }}">
    <h4>{{ trans("slider::sliders.slide.form.caption_{$captionNumber}") }}</h4>

    <div class="form-group">
        <div class="col-md-12 p-l-0">
            <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12 text-left p-l-0" for="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-delay">
                {{ trans("slider::attributes.caption_{$captionNumber}_delay") }}
            </label>

            <div class="col-lg-4 col-md-7 col-sm-6 col-xs-7 p-l-0">
                <input type="number"
                    name="slides[<%- slideNumber %>][options][caption_{{ $captionNumber }}][delay]"
                    class="form-control"
                    id="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-delay"
                    placeholder="{{ trans('slider::sliders.slide.form.' . ($captionNumber === 1 ? '0s' : '0_3s')) }}"
                    value="<%- slide.options.caption_{{ $captionNumber }}.delay %>"
                    step="0.01"
                >
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 p-l-0">
            <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12 text-left p-l-0" for="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-effect">
                {{ trans("slider::attributes.caption_{$captionNumber}_effect") }}
            </label>

            <div class="col-lg-4 col-md-7 col-sm-6 col-xs-7 p-l-0">
                <select name="slides[<%- slideNumber %>][options][caption_{{ $captionNumber }}][effect]"
                    class="form-control custom-select-black"
                    id="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-effect"
                >
                    @foreach (trans('slider::sliders.effects') as $effect => $name)
                        <option value="{{ $effect }}" <%= slide.options.caption_{{ $captionNumber }}.effect === '{{ $effect }}' ? 'selected' : '' %>>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
