@extends('layout.main')

@section('content')
<div class="page-header center">
		<h3>Welcome {{ Auth::user()->username }}!</h3>
</div>
<div>
	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('home') }}">{{ Auth::user()->username }}</a></li>
	  <li><a href="{{ URL::route('list') }}">Lists</a></li>
	  <li class="active">{{ $checklist->name }}</li>
	</ol>
</div>
@stop

@section('left-content')


<div class="panel panel-success">
	<div class="panel-heading clearfix">
		<h4>{{ ucfirst($checklist->name) }}</h4>
	</div>

	<div class="panel-body">
		<!--Buttons for managing list items-->
		<div class="col-md-12">
			<div class="center">
				<p onClick="toggle_visibility('add_items');" class="btn btn-primary">Add Task</p>
				@if(count($checklist->items) !== 0)
					<a href="{{ URL::route('list-items-add-batch', $checklist->id) }}"><p class="btn btn-primary">Add multiple tasks</p></a>
				@endif
			</div>	
			<hr>
		</div>
		@if($errors->has('name'))
			<div class="errors center">
				{{ $errors->first('name') }}
			</div>
		@endif
		<!--Hidden add item displayed with button-->
		<div id="add_items" class="center">
			<hr>
			{{ Form::open(array('url' => URL::route('list-items-add', $checklist->id)))}}
			<input type="text" name="name" id="name" placeholder="New Item">

			<input type="hidden" name="checklist_id" id="checklist_id" value="{{ $checklist->id }}">
			<input type="submit" value="Submit" class="btn btn-primary">

			{{ Form::close() }}
			<hr>
		</div>
		<!--If no items in list, display text-->
		@if(count($checklist->items) == 0) 
		<div class="col-md-12 text-center">
			<h3>You don't seem to have any items in this list.</h3> 
			<h3>Perhaps try adding some?</h3>
			<hr>
			<a href="{{ URL::route('list-items-add-batch', $checklist->id) }}"><p class="btn btn-primary">Add multiple tasks</p></a>
		</div>
		@endif
		<!--List all items in current list-->
		<div id="items_list"> 
			<ul>
				@foreach($checklist->items as $item)
				{{ Form::open(array('url' => URL::route('list-items', $checklist->id))) }}
					<li class="clearfix">
						<h4 class="pull-left">
						<input 	type="checkbox" 
								name="item" 
								id="item_{{$item->id}}"
								onCLick="this.form.submit()" 
								style="display: none"
								{{ $item->done ? 'checked' : '' }}
						/>

						@if($item->done)
							{{HTML::image('assets/img/check.png')}}
						@else
							{{HTML::image('assets/img/uncheck.png')}}
						@endif

						<label for="item_{{$item->id}}" {{ $item->done ? 'class="btn btn-success"' : 'class="btn btn-danger"' }}>
								{{ $item->name }}
						</label>

						<span>{{ $item->done ? '- Done!' : '' }}</span>


						<input type="hidden" name="item_id" id="item_id" value="{{$item->id}}">
						{{ Form::close() }}
						</h4>
						<h4 class="pull-right">
						{{ Form::open(array('url' => URL::route('list-items-remove', $checklist->id))) }}
							<label class="btn btn-danger text-right" onClick="this.form.submit()">X</label>
							<input type="hidden" name="item_id" id="item_id" value="{{$item->id}}">
						{{ Form::close() }}
						</h4>
					</li>
					<hr style="margin: 0">
				
				@endforeach
			</ul>
		</div>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>
@stop