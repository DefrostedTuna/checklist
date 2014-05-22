@extends('layout.base')

@section('content')
<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4 class="center">Register</h4>
		</div>
	
		<div class="panel-body">
			<div id="register" class="center">
				{{ Form::open(array('route' => 'account-create', 'method' => 'post', 'autocomplete' => 'off')) }}
					
					<!--fake inputs for google chrome workaround-->
					<input type="text" name="prevent_autofill" id="prevent_autofill" value="" style="display:none;" />
					<input type="password" name="password_fake" id="password_fake" value="" style="display:none;" />
					<!--fake inputs for google chrome workaround-->

					<input type="text" name="email" id="email" placeholder="Email">
					<input type="text" name="username" id="username" placeholder="Username">
					<input type="text" name="first_name" id="first_name" placeholder="First Name">
					<input type="text" name="last_name" id="last_name" placeholder="Last Name">
					<input type="password" name="password" id="password" placeholder="Password">
					<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
					<input type="submit" value="Register" class="btn btn-primary">
				{{ Form::close() }}	
			</div>
		</div>
	
	</div>
</div>

@stop