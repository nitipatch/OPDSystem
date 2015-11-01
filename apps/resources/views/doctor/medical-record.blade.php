<!DOCTYPE html>
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"prescribe/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 

<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Prescribe | Hospital OPD System</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	</head>
	<body>
		<h2 class="text-center">Prescribe rev 0.1 alpha</h2>
		
		<!-- header -->
		<!-- <form action="" method="POST" class="form-horizontal" role="form">

				<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

		</form> -->


		<!-- old -->
		<div class="container">
			<div class="row">
					
				<form action="" method="POST" role="form">
					<legend>โปรดกรอกข้อมูลการสั่งยา</legend>

					<div class="form-group">
						<!-- <label for="">Name</label> -->
						<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
						
						
						<div class="row">
							<div class="col-lg-5">
								ชื่อยา<font color="red">*</font>
								<input type="text" name="name" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						
						<p></p>

						<div class="row">
							<div class="col-lg-5">
								จำนวน<font color="red">*</font>
								<input type="text" name="quantity" id="input" class="form-control" value="" required="required" pattern="" title="">
							</div>
						</div>
						
						

						<p></p>

						<div class="row">
							<div class="col-lg-5">
								วิธีใช้<font color="red">*</font>
								<textarea name="usage" id="input" class="form-control" rows="0" required="required"></textarea>
							</div>
						</div>
						
						<p></p>

					</div>
				
				
				
				{!!
				Form::submit('สั่งยา', ['class' => 'btn btn-primary'])
				!!}
				<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				

				</form>
			</div>
			
		</div>




		
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
	</body>
</html>