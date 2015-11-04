@extends('pharmacist.layouts.template')
@section('content')
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"requestNewDrugsList/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 
<h2 class="text-center">Request New Drugs List rev 0.1 alpha</h2>

<!-- header -->
<!-- <form action="" method="POST" class="form-horizontal" role="form">

	<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

</form> -->

<div class="row">
	<div class="col-lg-12">
		
		<form action="" method="POST" role="form">
			
			<!-- <legend>โปรดกรอกข้อมูลการขอรายการยาใหม่</legend> -->

			<div class="form-group">
				<!-- <label for="">Name</label> -->
				<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
				
				<p>รายการยาที่แพทย์สั่งให้</p>
				<div class="row">
					<div class="col-md-3 col-lg-3">
						HN<!--  (ดึงจาก db) -->
						<input type="text" name="HN" id="input" class="form-control" value=""  pattern="" title="">
					</div>
					<div class="col-md-5 col-lg-5">
						ชื่อผู้ป่วย<!--  (ดึงจาก db) -->
						<input type="text" name="patName" id="input" class="form-control" value=""  pattern="" title="">
					</div>
				</div>
				

				<p></p>

				<div class="row">
					<div class="col-md-8 col-lg-8">
						มีดังนี้ //ก็อปของหมอมา
					</div>
				</div>

				<br>

				<div class="row">
					<div class="col-md-8 col-lg-8">
					โปรดระบุว่าต้องการเปลี่ยนแปลงรายการยาอย่างไร พร้อมทั้งเหตุผล<font color="red">*</font>
					<textarea name="" id="input" class="form-control" rows="3" required="required"></textarea>
				</div>

			</div>
		
		<br>
		
		{!!
		Form::submit('ตกลง', ['class' => 'btn btn-primary'])
		!!}
		<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
		

		</form>
	</div>
</div>
@stop