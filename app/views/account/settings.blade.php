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
	  <li class="active">Account Settings</li>
	</ol>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="text-center">Account settings</h4>
	</div>
	<div class="panel-body">
		<div class="col-md-6 text-center extra-padding">
			<a href="{{ URL::route('account-change-password') }}">
				{{ HTML::image('assets/img/change-password.png') }}
			<h3>Change Password</h3>
			</a>
		</div>
		<div class="col-md-6 text-center extra-padding">
			<a href="{{ URL::route('account-update') }}">
			{{ HTML::image('assets/img/user-information.png') }}
			<h3>Edit User Info</h3>
			</a>
		</div>
	</div>
</div>
@stop
