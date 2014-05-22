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
	  <li class="active">Update</li>
	</ol>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="text-center">Update user information</h4>
	</div>
	<div class="panel-body">
		<div id="change_password" class="center">
			{{ Form::open(array('url' => URL::route('account-update'), 'method' => 'post')) }}

				@if($errors->has('first_name'))
					<div class="errors center">
						{{ $errors->first('first_name') }}
					</div>
				@endif
				<input type="text" name="first_name" id="first_name" placeholder="First Name">

				@if($errors->has('last_name'))
					<div class="errors center">
						{{ $errors->first('last_name') }}
					</div>
				@endif
				<input type="text" name="last_name" id="last_name" placeholder="Last Name">

				<input type="submit" value="Submit" class="btn btn-primary">

			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
