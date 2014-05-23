forgot password!

{{ Form::open(array('url' => URL::route('account-forgot-password'), 'method' => 'post')) }}

@if($errors->has('email'))
	<div class="errors center">
		{{ $errors->first('email') }}
	</div>
@endif
<input type="text" name="email" id="email">

<input type="submit" value="Submit">

{{ Form::close() }}