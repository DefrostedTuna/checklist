<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <title>
	    	@yield('title')
	    </title>

	    <!-- Bootstrap core CSS -->
	    {{ HTML::style('assets/css/bootstrap.min.css') }}
	    <!-- Bootstrap theme -->
	    {{ HTML::style('assets/css/bootstrap-theme.min.css') }}
	   	<!-- Custom styles -->
	   	{{ HTML::style('assets/css/common.css') }}

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div id="header">
			@include('layout.header')
			<div id="navigation-bar">
				@include('layout.navigation')
			</div>
		</div>
		
		<!--@if(Session::has('global'))
		<div class="container">
			<div id="global" class="col-md-6 col-md-offset-3 alert alert-{{{ (Session::has('alert')) ? Session::get('alert') : 'info' }}}">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>			
					<p>Text{{ Session::get('global') }}</p>								
			</div>
		</div>
		@endif-->

		<div class="container"><!--Global alert container-->
			@if(Session::has('global'))
				<div id="global" class="global col-md-6 col-md-offset-3 alert alert-{{{ (Session::has('alert')) ? Session::get('alert') : 'info' }}}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>{{ Session::get('global') }}</p>
				</div>
			@endif
		</div><!--end row/container-->		

		<div id="main-container" class="container bg">
			<div class="col-sm-12">
				@yield('content')
			</div>

			@yield('custom-content')

			<div class="col-sm-8">
				@yield('left-content')
			</div>
			@if(Auth::user())
			<div class="col-sm-4">
				@include('layout.user-bar')
			</div>
			@endif
		</div><!--main-container-->

		<div id="footer">
			@include('layout.footer')
	    </div>

	    @yield('script')

		<!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
	    {{ HTML::script("assets/jquery/1.11.0/jquery.min.js") }}
	    {{ HTML::script('assets/js/bootstrap.min.js') }}
	    {{ HTML::script('assets/js/doc.min.js') }}
	</body>
</html>