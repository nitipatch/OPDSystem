@extends('doctor.layouts.template')
@section('content')
<!DOCTYPE html>
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"prescribe/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 

		<h2 class="text-center">Add Medical Record rev 0.1 alpha</h2>
		
		<!-- header -->
		<!-- <form action="" method="POST" class="form-horizontal" role="form">

				<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

		</form> -->


		<!-- old -->

		<div class="row">
				
			<form action="" method="POST" role="form">
				<legend>โปรดกรอกข้อมูลบันทึกการรักษา</legend>

				<div class="form-group">
					<!-- <label for="">Name</label> -->
					<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
					
					
					<div class="row">
						<div class="col-lg-5">
							HN<font color="red">*</font><!--  (กรอกเอง หรือ ดึงจาก db) -->
							<input type="text" name="HN" id="input" class="form-control" value="" required="required" pattern="" title="">
						</div>
						<div class="col-lg-5">
							ชื่อผู้ป่วย<!--  (ดึงจาก db) -->
							<input type="text" name="patName" id="input" class="form-control" value="" required="required" pattern="" title="">
						</div>

					</div>
					
					<p></p>

					<div class="row">
						<div class="col-lg-5">
							อาการผู้ป่วย<font color="red">*</font>
							<textarea name="" id="input" class="form-control" rows="3" required="required"></textarea>
						</div>
						<div class="col-lg-5">
							การวินิจฉัยหลัก<font color="red">*</font>
							<select name="" id="input" class="form-control">
								<option value="">-- Select One --</option>
								<option value="">test1</option>
								<option value="">test2</option>
								<option value="">test3</option>
							</select>
							<!-- <input type="text" name="icd10" id="inputIcd10" class="form-control" value="" required="required" pattern="" title=""> -->
						</div>



					</div>
					
					<br>

				</div>
			
			
			
			{!!
			Form::submit('บันทึกการรักษา', ['class' => 'btn btn-primary'])
			!!}
			<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
			

<<<<<<< HEAD
			</form>
		</div>
		
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
=======
				</form>
			</div>
>>>>>>> 3fb78e23e307c044ce89bbc13bdd5d7c3cd58d99
@stop