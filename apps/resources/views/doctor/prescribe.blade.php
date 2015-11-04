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

<h2 class="text-center"></h2>

<!-- header -->
<!-- <form action="" method="POST" class="form-horizontal" role="form">

		<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

</form> -->


<!-- old -->
<div class="row">
		
	<form action="" method="POST" role="form">
		<legend>โปรดกรอกข้อมูลการสั่งยา</legend>

		<div class="form-group">
			<!-- <label for="">Name</label> -->
			<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
			
			
			<div class="row">
				<div class="col-md-5 col-lg-5">
					ชื่อยา<font color="red">*</font>
					<input type="text" name="name" id="input" class="form-control" value="" required="required" pattern="" title="">
				</div>
			</div>
			
			<p></p>

			<div class="row">
				<div class="col-md-5 col-lg-5">
					จำนวน<font color="red">*</font>
					<input type="text" name="quantity" id="input" class="form-control" value="" required="required" pattern="" title="">
				</div>
			</div>
			
			

			<p></p>

			<div class="row">
				<div class="col-md-5 col-lg-5">
					วิธีใช้<font color="red">*</font>
					<textarea name="usage" id="input" class="form-control" rows="0" required="required"></textarea>
				</div>
			</div>
			
			<p></p>

		</div>
	
	
	
	<tr>
	    <td style="text-align:left;"></td>
	    <td>
		{!!
		Form::submit('สั่งยา', ['class' => 'btn btn-primary'])
		!!}
		{!!
		Form::button('ยกเลิก', ['class' => 'btn'])
		!!}
		</td>
	</tr>
	<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
	

	</form>
</div>
@stop