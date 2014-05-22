<div class="panel panel-info">
	<div class="panel-heading center">
		<h4>User Info</h4>
	</div>

	<div class="panel-body center">
		<h4>Username</h4>
		<p>{{ Auth::user()->username }}</p>
		<hr>

		<h4>Name</h4>
		<p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
		<hr>

		<h4>Email</h4>
		<p>{{ Auth::user()->email }}</p>
		<hr>

		<h4>Joined</h4>
		<p>{{ date_format(Auth::user()->created_at, 'D, M d, Y') }}</p>

	</div>
</div>