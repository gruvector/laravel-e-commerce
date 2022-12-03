{{ Form::text('vonage_key', trans('setting::attributes.vonage_key'), $errors, $settings, ['required' => true]) }}
{{ Form::password('vonage_secret', trans('setting::attributes.vonage_secret'), $errors, $settings, ['required' => true]) }}
