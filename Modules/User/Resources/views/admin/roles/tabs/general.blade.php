<div class="row">
    <div class="col-sm-8">
        {{ Form::text('name', trans('user::attributes.roles.name'), $errors, $role, ['required' => true]) }}
    </div>
</div>
