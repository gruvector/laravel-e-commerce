<div class="row">
    <div class="col-md-8">
        {{ Form::text('first_name', trans('user::attributes.users.first_name'), $errors, $currentUser, ['required' => true]) }}
        {{ Form::text('last_name', trans('user::attributes.users.last_name'), $errors, $currentUser, ['required' => true]) }}
        {{ Form::email('email', trans('user::attributes.users.email'), $errors, $currentUser, ['required' => true]) }}
    </div>
</div>
