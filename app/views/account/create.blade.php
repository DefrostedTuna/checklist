@extends('layout.base')

@section('content')
<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4 class="center">Register</h4>
		</div>
	
		<div class="panel-body">
			<div id="register" class="center">
				{{ Form::open(array('route' => 'account-create', 'method' => 'post')) }}
					
					<!--fake inputs for google chrome workaround-->
					<input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" />
					<input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />
					<!--fake inputs for google chrome workaround-->

					@if($errors->has('email'))
						<div class="errors center">
							{{ $errors->first('email') }}
						</div>
					@endif
					<input type="text" name="email" id="email" placeholder="Email" value="{{ Input::old('email') ? Input::old('email') : '' }}">
					
					@if($errors->has('username'))
						<div class="errors center">
							{{ $errors->first('username') }}
						</div>
					@endif
					<input type="text" name="username" id="username" placeholder="Username" value="{{ Input::old('username') ? Input::old('username') : '' }}">
					
					@if($errors->has('first_name'))
						<div class="errors center">
							{{ $errors->first('first_name') }}
						</div>
					@endif
					<input type="text" name="first_name" id="first_name" placeholder="First Name" value="{{ Input::old('first_name') ? Input::old('first_name') : '' }}">
					
					@if($errors->has('last_name'))
						<div class="errors center">
							{{ $errors->first('last_name') }}
						</div>
					@endif
					<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{ Input::old('last_name') ? Input::old('last_name') : '' }}">
					
					@if($errors->has('password'))
						<div class="errors center">
							{{ $errors->first('password') }}
						</div>
					@endif
					<input type="password" name="password" id="password" placeholder="Password">
					
					@if($errors->has('confirm_password'))
						<div class="errors center">
							{{ $errors->first('confirm_password') }}
						</div>
					@endif
					<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
					
					<input type="submit" value="Register" class="btn btn-primary">
				{{ Form::close() }}	
			</div>
		</div>
	
	</div>
</div>

@stop