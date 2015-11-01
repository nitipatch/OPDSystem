<!DOCTYPE html>
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"appointment/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 

<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Make Appointments | OPD Hospital System</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
	</head>
	<body>
		<h2 class="text-center">Make Appointment rev 0.2 alpha</h2>
		
		<!-- header -->
		<!-- <form action="" method="POST" class="form-horizontal" role="form">

				<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

		</form> -->


		<!-- old -->
		<div class="container">
			<div class="col-xs- col-sm- col-md- col-lg-5">
				
				<form action="" method="POST" role="form">
					<legend>โปรดกรอกข้อมูลการทำนัด</legend>
					
					<div class="form-group">
						<!-- <label for="">Name</label> -->
						<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
						
						
						<p>
							อาการหรือสาเหตุที่ต้องการพบแพทย์<font color="red">*</font>
							<textarea name="cause" id="input" class="form-control" rows="0" required="required"></textarea>
						</p>

						<p>
							แพทย์ที่ท่านต้องการเข้าพบ
							<select name="doctor" id="input" class="form-control">
								<option value="">แพทย์</option>
								<option value="A">หมอ A</option>
								<option value="B">หมอ B</option>
								<option value="C">หมอ C</option>
							</select>

							แผนกของแพทย์ที่ท่านต้องการเข้าพบ<font color="red">*</font>
							<select name="doctor" id="input" class="form-control" required="required">
								<option value="deptA" color="blue">แผนก</option>
								<option value="deptA">แผนก A</option>
								<option value="deptB">แผนก B</option>
							</select>
						</p>

						
						<p>
							<div class="form-group">
								<label for="input" class="col-sm-0 control-label"></label>
								<div class="col-sm-20">
									วันที่ท่านต้องการพบแพทย์<font color="red">*</font>
									<input type="date" name="apptDate" id="input" class="form-control" value="" required="required" title="">
									ช่วงเวลา<div class="radio">
										<label>
											<input type="radio" name="morning" id="inputMorning" value="">
											เช้า
										</label>
										<label>
											<input type="radio" name="morning" id="inputMorning" value="">
											บ่าย
										</label>
									</div>
								</div>
							</div>
						</p>
						
						
					</div>
					
					
					{!!
					Form::submit('ทำนัด', ['class' => 'btn btn-primary'])
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