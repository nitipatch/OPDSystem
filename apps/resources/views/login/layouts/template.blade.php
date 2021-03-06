<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="description" content="">
 	<meta name="author" content="">
 	<title>Hospital OPD System</title>

 	@include('login.layouts.inc-stylesheet')
 	@yield('stylesheet')
</head>

<body>
 	<div id="wrapper"><!-- Navigation -->
	 	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<a class="navbar-brand" id="text">Hospital OPD System</a>
			</div>
	 		@include('login.layouts.inc-left-sidebar')
	 	</nav>

<!-- Page Content -->
		<div id="page-wrapper">
		<div class="container-fluid">
			@yield('content')<!-- /.row -->
		</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
 	</div><!-- /#wrapper --><!-- jQuery -->
 	@include('login.layouts.inc-scripts')
 	@yield('scripts')

</body>
</html>