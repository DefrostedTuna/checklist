{{ Form::open(array('url' => URL::route('list-create'))) }}

<input type="text" name="name" id="name">

<input type="submit" value="Submit!">

{{ Form::close() }}

@extends('layout.main')

@section('content')
<div class="page-header center">
		<h3>Welcome {{ Auth::user()->username }}!</h3>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		<h4>Create a new list</h4>
	</div>

	<div class="panel-body">
		{{ Form::open(array('url' => URL::route('list-create'))) }}

		<input type="text" name="name" id="name">

		<input type="submit" value="Submit!">

		{{ Form::close() }}
	</div>
</div>
@stop