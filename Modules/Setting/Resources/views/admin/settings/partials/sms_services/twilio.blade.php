{{ Form::text('twilio_sid', trans('setting::attributes.twilio_sid'), $errors, $settings, ['required' => true]) }}
{{ Form::password('twilio_token', trans('setting::attributes.twilio_token'), $errors, $settings, ['required' => true]) }}
