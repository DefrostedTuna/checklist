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
	   	{{ HTML::style('assets/css/cover.css') }}

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="inner cover">
            <h1 class="cover-heading">Welcome to my checklist demo app!</h1>
            <p class="lead">This is intended to be a functional applicaton used to demonstrate my understanding of database relationships.</p>
            <p class="lead">Please Log In or Register to continue.</p>
            <p class="lead">
              <a href="{{ URL::route('account-log-in') }}" class="btn btn-lg btn-primary">Log In</a>
              <a href="{{ URL::route('account-create') }}" class="btn btn-lg btn-success">Register</a>
            </p>
          </div>

        </div>

      </div>

    </div>

		<!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
	    {{ HTML::script("assets/jquery/1.11.0/jquery.min.js") }}
	    {{ HTML::script('assets/js/bootstrap.min.js') }}
	    {{ HTML::script('assets/js/doc.min.js') }}
  </body>
</html>