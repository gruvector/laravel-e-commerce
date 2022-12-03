<div class="row">
    <div class="col-md-8">
        {{ Form::text('name', trans('tag::attributes.name'), $errors, $tag, ['required' => true]) }}

        @if ($tag->exists)
            {{ Form::text('slug', trans('tag::attributes.slug'), $errors, $tag, ['required' => true]) }}
        @endif
    </div>
</div>
