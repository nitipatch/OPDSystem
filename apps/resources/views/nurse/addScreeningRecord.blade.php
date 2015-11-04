@extends('nurse.layouts.template')
@section('content')
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"addScreeningRecord/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 
<h2 class="text-center">Add Screening Record rev 0.1 alpha</h2>

<!-- header -->
<!-- <form action="" method="POST" class="form-horizontal" role="form">

		<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

</form> -->

<div class="row">
	<div class="col-lg-12">
		
		<form action="" method="POST" role="form">
			
			<legend>โปรดกรอกข้อมูลเพื่อบันทึกการตรวจคัดกรอง</legend>

			<div class="form-group">
				<!-- <label for="">Name</label> -->
				<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
				
				<div class="row">
					<div class="col-lg-3">
						HN<font color="red">*</font><!--  (กรอกเอง หรือ ดึงจาก db) -->
						<input type="text" name="HN" id="input" class="form-control" value="" required="required" pattern="" title="">
					</div>
					<div class="col-lg-5">
						ชื่อผู้ป่วย<!--  (กรอกเอง หรือ ดึงจาก db) -->
						<input type="text" name="patName" id="input" class="form-control" value="" required="required" pattern="" title="">
					</div>

				</div>
					
				<br>

				<div class="row">

					<div class="col-lg-6">
						อาการเบื้องต้น<font color="red">*</font>
						<textarea name="sign" id="input" class="form-control" rows="0" required="required"></textarea>
					</div>

					<div class="col-lg-2">
						น้ำหนัก<font color="red">*</font>
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" required="required" title="">
					</div>

					<div class="col-lg-2">
						ส่วนสูง<font color="red">*</font>
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" required="required" title="">
					</div>

					<div class="col-lg-2">
						ชีพจร
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" title="">
					</div>

				</div>
				
				<p></p>

				<div class="row">
					<div class="col-lg-4">
						ความดันโลหิต<font color="red">*</font> (กรอกให้ครบ 2 ช่อง)
					</div>


					<div class="col-lg-2">
						อุณหภูมิร่างกาย<font color="red">*</font>
					</div>

					<div class="col-lg-6">
						แพ้ยา (ถ้ามี)
					</div>
					
				</div>

				<div class="row">
					<div class="col-lg-2"> 
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" required="required" title="">
					</div>
					<!-- <div class="col-xs-1">/</div> -->
					<div class="col-lg-2"> 
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" required="required" title="">
					</div>
					
					<div class="col-lg-2">
						<input type="number" name="" id="input" class="form-control" value="" min="{5"} max="" step="" required="required" title="">
					</div>
					
					<div class="col-lg-6">
						<input type="text" name="" id="input" class="form-control" value=""  pattern="" title="">
					</div>

				</div>


					

				<!-- <p></p>

				<div class="row">
					
				</div> -->

			</div>
		
		<br>
		
		{!!
		Form::submit('บันทึกการตรวจคัดกรอง', ['class' => 'btn btn-primary'])
		!!}
		<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
		<!-- <button type="button" class="btn btn-default">ยกเลิก</button> -->
		
		</form>



	</div>
</div>
@stop