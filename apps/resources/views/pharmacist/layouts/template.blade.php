<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="description" content="">
 	<meta name="author" content="">
 	<title>Hospital OPD System</title>
	<!-- Bootstrap Core CSS -->
 	@include('pharmacist.layouts.inc-stylesheet')
 	@yield('stylesheet')
</head>

<body onload="f()">
 	<div id="wrapper"><!-- Navigation -->
	 	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Hospital OPD System</a>
			</div>
	 		@include('pharmacist.layouts.inc-header')
	 		@include('pharmacist.layouts.inc-left-sidebar')
	 	</nav>

<!-- Page Content -->
		<div id="page-wrapper">
		<div class="container-fluid">
			@yield('content')<!-- /.row -->
		</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
 	</div><!-- /#wrapper --><!-- jQuery -->
 	@include('pharmacist.layouts.inc-scripts')
 	@yield('scripts')

</body>
</html>
