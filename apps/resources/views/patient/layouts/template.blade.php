<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="description" content="">
 	<meta name="author" content="">
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 	
 	<title>Hospital OPD System</title>
 	<style>
 		.event {
    			background-color: #42B373 !important;
    			background-image :none !important;
    			color: #ffffff !important;
				}	
	</style>
	<script>
    var availableDates = ['2014-11-10','2014-11-20','2014-11-30'];
    function availableFunction(date) {
    availday = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
    if (jQuery.inArray(availday, availableDates) > -1) {return [true,"eventday",""];} 
    else {return [true,"other",""];}
    }
    jQuery("#eventpicker").datepicker({beforeShowDay: availableFunction});

</script>

	<!-- Bootstrap Core CSS -->
 	@include('patient.layouts.inc-stylesheet')
 	@yield('stylesheet')
</head>

<body>
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
	 		@include('patient.layouts.inc-header')
	 		@include('patient.layouts.inc-left-sidebar')
	 	</nav>

<!-- Page Content -->
		<div id="page-wrapper">
		<div class="container-fluid">
			@yield('content')<!-- /.row -->
		</div><!-- /.container-fluid -->
		</div><!-- /#page-wrapper -->
 	</div><!-- /#wrapper --><!-- jQuery -->
 	@include('patient.layouts.inc-scripts')
 	@yield('scripts')

</body>
</html>
