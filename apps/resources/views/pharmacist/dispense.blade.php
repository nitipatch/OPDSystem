@extends('pharmacist.layouts.template')
@section('content')

{!! Form::open([
	"url" => "pharmacist/dispense/create",
	"method" => "POST",
	"files" => true,
	"class" => "form-register",
])	!!} 

	<div class="box-login">
        <h2 style="text-align:center;">จ่ายยา</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center" id="drugsTable"></table>
        <table align="center">
         	<tr><td><label></label></td></tr>
            <tr>
            	<td></td>
                <td style="align:right">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td></tr>
         	<tr><td><label></label></td></tr>
        </table>
    </div>

<script>
function f()
{	

	<?php
		$i=0;
		use Illuminate\Support\Facades\DB;
		use Illuminate\Support\Facades\Session;
		$drugs = DB::table('prescribedDrugs')->where('pharmacistEmpID',Session::get('username'))->where('checked',0)->get();
		foreach ($drugs as $drug)$i++;
	?>

	for(var c=1;c<=<?php echo $i;?>;c++)
	{
		$.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/pharmacist/Ajax.php',
                type: "post",
                data: {pharmacistEmpID:<?php echo Session::get('username');?> , count:c},
                success: function(data)
                {
                	$("#drugsTable").append(data);
                }
    	});
	}
}
</script>

@stop