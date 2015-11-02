@extends('patient.layouts.template')
@section('content')
<?php echo csrf_field(); ?>
{!!
	Form::open
		([
			"url"=>"appointment/create","method" => "POST","files" => true,"class" => "form-register"
		])
!!} 
		<h2 class="text-center">Make Appointment rev 0.4 alpha</h2>
		
		<!-- header -->
		<!-- <form action="" method="POST" class="form-horizontal" role="form">

				<img src="http://www.online-image-editor.com//styles/2014/images/example_image.png" class="img-responsive" alt="Image">

		</form> -->


		<!-- old -->
			<div class="row">
				<div class="col-lg-12">
					
					<form action="" method="POST" role="form">
						
						<legend>โปรดกรอกข้อมูลการทำนัด</legend>

						<div class="form-group">
							<!-- <label for="">Name</label> -->
							<!-- <input type="text" class="form-control" name="Name" id="input" required="required" title="Name" placeholder="Name"> -->
							
							
							<div class="row">
								<div class="col-lg-5">
									อาการหรือสาเหตุที่ต้องการพบแพทย์<font color="red">*</font>
									<textarea name="cause" id="input" class="form-control" rows="0" required="required"></textarea>
								</div>
							</div>
							
							<p></p>

							<div class="row">
								<div class="col-lg-5">
									แพทย์ที่ท่านต้องการเข้าพบ
									<select name="doctor" id="input" class="form-control">
										<option value="">แพทย์</option>
										<option value="A">หมอ A</option>
										<option value="B">หมอ B</option>
										<option value="C">หมอ C</option>
									</select>
								</div>
								
								<div class="col-lg-5">
									แผนกของแพทย์ที่ท่านต้องการเข้าพบ<font color="red">*</font>
									<select name="doctor" id="input" class="form-control" required="required">
										<option value="deptA" color="blue">แผนก</option>
										<option value="deptA">แผนก A</option>
										<option value="deptB">แผนก B</option>
									</select>
								</div>
							</div>
								

							<p></p>

							<div class="row">
								<div class="form-group">
									<label for="input" class="col-sm-0 control-label"></label>
									<div class="col-lg-3">
										วันที่ท่านต้องการพบแพทย์<font color="red">*</font>
										<input type="date" name="apptDate" id="input" class="form-control" value="" required="required" title="">
									</div>

									<div class="col-lg-3">
										<div class="radio">
											ช่วงเวลา<font color="red">*</font>
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
							</div>

						</div>
					
					
					
					{!!
					Form::submit('ทำนัด', ['class' => 'btn btn-primary'])
					!!}
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
					

					</form>
				</div>
			</div>
@stop