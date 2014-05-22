@extends('layout.main')

@section('title')
	Homepage
@stop

@section('content')
<div class="page-header center">
	<h3>Welcome {{ Auth::user()->username }}!</h3>
</div>
<div>
	<ol class="breadcrumb">
		<li><a href="{{ URL::route('home') }}">{{ Auth::user()->username }}</a></li>
		<li><a href="{{ URL::route('account-settings') }}">Account Settings</a></li>
	  <li class="active">Change Password</li>
	</ol>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="text-center">Change your password</h4>
	</div>
	<div class="panel-body">
		<div id="change_password" class="center">
			{{ Form::open(array('url' => URL::route('account-change-password'), 'method' => 'post')) }}

				@if($errors->has('current_password'))
					<div class="errors center">
						{{ $errors->first('current_password') }}
					</div>
				@endif
				<input type="password" name="current_password" id="current_password" placeholder="Current Password">

				@if($errors->has('new_password'))
					<div class="errors center">
						{{ $errors->first('new_password') }}
					</div>
				@endif
				<input type="password" name="new_password" id="new_password" placeholder="New Password">

				@if($errors->has('confirm_new_password'))
					<div class="errors center">
						{{ $errors->first('confirm_new_password') }}
					</div>
				@endif
				<input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">

				<input type="submit" value="Submit" class="btn btn-primary">

			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
