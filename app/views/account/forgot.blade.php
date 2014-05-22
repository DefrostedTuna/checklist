forgot password!

{{ Form::open(array('url' => URL::route('account-forgot-password'), 'method' => 'post')) }}

<input type="text" name="email" id="email">

<input type="submit" value="Submit">

{{ Form::close() }}