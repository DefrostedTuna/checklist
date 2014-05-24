@extends('layout.base')

@section('content')
<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4 class="center">Please Log In</h4>
		</div>
	
		<div class="panel-body">
			<div id="login" class="center">
				{{ Form::open(array('url' => URL::route('account-log-in'), 'method' => 'post')) }}

				@if($errors->has('email'))
					<div class="errors center">
						{{ $errors->first('email') }}
					</div>
				@endif
				<input type="text" name="email" id="email" placeholder="Email">

				@if($errors->has('password'))
					<div class="errors center">
						{{ $errors->first('password') }}
					</div>
				@endif
				<input type="password" name="password" id="password" placeholder="Password">

				<input type="submit" value="Log In" class="btn btn-primary">

				{{ Form::close() }}
			</div>
		</div>
	
	</div>
</div>

@stop