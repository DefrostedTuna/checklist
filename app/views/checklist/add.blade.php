@extends('layout.main')

@section('content')
<div class="page-header center">
		<h3>Welcome {{ Auth::user()->username }}!</h3>
</div>
<div>
	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('home') }}">{{ Auth::user()->username }}</a></li>
	  <li><a href="{{ URL::route('list') }}">Lists</a></li>
	  <li><a href="{{ URL::route('list-items', $checklist->id) }}">{{ $checklist->name }}</a></li>
	  <li class="active">Add</li>
	</ol>
</div>
@stop

@section('left-content')


<div class="panel panel-success">
	<div class="panel-heading">
		<h4>{{ ucfirst($checklist->name) }}</h4>
	</div>

	<div class="panel-body">
		<div id="add_items_bulk" class="center"> 
			{{ Form::open(array('url' => URL::route('list-items-add-batch', $checklist->id)))}}

			@if($errors->has('first_item'))
				<div class="errors center">
					{{ $errors->first('first_item') }}
				</div>
			@endif
			<input type="text" name="first_item" id="first_item" placeholder="First item">

			@if($errors->has('second_item'))
				<div class="errors center">
					{{ $errors->first('second_item') }}
				</div>
			@endif
			<input type="text" name="second_item" id="second_item" placeholder="Second item (optional)">

			@if($errors->has('third_item'))
				<div class="errors center">
					{{ $errors->first('third_item') }}
				</div>
			@endif
			<input type="text" name="third_item" id="third_item" placeholder="Third item (optional)">

			@if($errors->has('fourth_item'))
				<div class="errors center">
					{{ $errors->first('fourth_item') }}
				</div>
			@endif
			<input type="text" name="fourth_item" id="fourth_item" placeholder="Fourth item (optional)">

			@if($errors->has('fifth_item'))
				<div class="errors center">
					{{ $errors->first('fifth_item') }}
				</div>
			@endif
			<input type="text" name="fifth_item" id="fifth_item" placeholder="Fifth item (optional)">

			<input type="hidden" name="checklist_id" id="checklist_id" value="{{ $checklist->id }}">
			<input type="submit" value="Submit" class="btn btn-primary">

			{{ Form::close() }}
		</div>
	</div>
</div>
@stop