{{ Form::text('name', trans('page::attributes.name'), $errors, $page, ['labelCol' => 2, 'required' => true]) }}
{{ Form::wysiwyg('body', trans('page::attributes.body'), $errors, $page, ['labelCol' => 2, 'required' => true]) }}

<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('is_active', trans('page::attributes.is_active'), trans('page::pages.form.enable_the_page'), $errors, $page) }}
    </div>
</div>
