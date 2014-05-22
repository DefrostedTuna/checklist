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
	  <li class="active">{{ Auth::user()->username }}</li>
	</ol>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="text-center">What would you like to do?</h4>
	</div>
	<div class="panel-body">
		<div class="col-md-6 text-center extra-padding">
			<a href="{{ URL::route('list') }}">
			{{ HTML::image('assets/img/checklist.png') }}
			<h3>Manage Lists</h3>
			</a>
		</div>
		<div class="col-md-6 text-center extra-padding">
			<a href="{{ URL::route('account-settings') }}">
			{{ HTML::image('assets/img/settings.png') }}
			<h3>Account Settings</h3>
			</a>
		</div>
	</div>
</div>
@stop
