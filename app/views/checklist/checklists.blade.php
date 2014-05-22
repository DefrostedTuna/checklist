@extends('layout.main')
@section('content')
<div class="page-header center">
		<h3>Welcome {{ Auth::user()->username }}!</h3>
</div>
<div>
	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('home') }}">{{ Auth::user()->username }}</a></li>
	  <li class="active">Lists</li>
	</ol>
</div>
@stop

@section('left-content')
<div class="panel panel-success">
	<div class="panel-heading">
		@if(count($user->checklists) !== 0)
			<p onClick="toggle_visibility('add_list');" class="pull-right btn btn-primary">New List</p>
		@endif	
		<h4>My lists</h4>
	</div>

	<div class="panel-body">
		@if($errors->has('name'))
			<div class="errors center">
				{{ $errors->first('name') }}
			</div>
		@endif
		<div id="add_list" class="center">
			<hr>
			{{ Form::open(array('url' => URL::route('list-create'))) }}
			<input type="text" name="name" id="name" placeholder="New List">
			<input type="submit" value="Submit" class="btn btn-primary">

			{{ Form::close() }}
			<hr>
		</div>
		@if(count($user->checklists) == 0) 
			<div class="col-md-12 text-center">
				<h3>You don't seem to have any lists available.</h3> 
				<h3>Perhaps try adding some?</h3>
				<hr>
				<p onClick="toggle_visibility('add_list');" class="btn btn-primary">New List</p>
			</div>
		@endif
		<ul>
			@foreach( $user->checklists as $list )
				<li class="clearfix">
					<h3 class="pull-left"><a href="{{ URL::route('list-items', $list->id) }}">{{ $list->name }}</a></h3>
					<h4 class="pull-right">
						{{ Form::open(array('url' => URL::route('list-remove', $list->id))) }}
							<label class="btn btn-danger text-right" onClick="this.form.submit()">X</label>
							<input type="hidden" name="checklist_id" id="checklist_id" value="{{$list->id}}">
						{{ Form::close() }}
					</h4>

				</li>
				<hr style="margin: 0px;">
			@endforeach
		</ul>
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