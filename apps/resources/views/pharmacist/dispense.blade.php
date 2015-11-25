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
        <br>
    
        <table width="800" Border=2 Bordercolor=Blue align="center" id="appointmentsTable"></table>
        <table align="left" id="drugsTable"></table>
        
        <input type="hidden" value=2 id="status" name="status">
        
        <table align="center">
            <tr><td><label></label></td></tr>
            <tr><tr colspan=6><textarea placeholder="รายละเอียดของยาที่ผิดกรณีขอรายการยาใหม่" rows="3" cols="50" type="input" name="comment" id="comment" style="display:none;" class="form-control"></textarea></td><tr>
            <tr>
                <td></td>
                <td id="ok" style="display:none;align:center">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td style="align:center"><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
                <td id="request" style="display:none;align:center"><button id="requestButton" class="btn btn-primary">ขอรายการยาใหม่</button></td>                
            </tr>
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td></tr>
        </table>
    </div>

<script>
var c=0;
function f()
{	

	<?php
		use Illuminate\Support\Facades\DB;
		use Illuminate\Support\Facades\Session;
		$appointments = DB::table('appointments')->where('pharmacistEmpID',Session::get('username'))->whereNull('dispensedTime')->get();
    ?>
    $("#requestButton").click(function(){$("#status").val(1);});

    $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/pharmacist/getAppointmentsList.php',
                type: "post",
                data: {pharmacistEmpID:<?php echo Session::get('username');?>},
                success: function(data)
                {
                	$("#appointmentsTable").append(data);
                    $('.btn btn-primary').each( function(index) {
                        $(this).click( function() {alert($(this).attr('id'));});
                    });
                    for(var i=1;i<=<?php echo count($appointments);?>;i++)
                        $('#'+i).click(function(){  $('#ok').css('display','inline');
                                                    $('#request').css('display','inline');
                                                    $('#comment').css('display','inline');
                                                    var ID = this.id;
                                                    var d1 = $('#'+ID+'-1').html();
                                                    var d2 = $('#'+ID+'-2').html();
                                                    var d3 = $('#'+ID+'-3').html();
                                                    var d4 = $('#'+ID+'-4').html();
                                                    var d5 = $('#'+ID+'-5').html();
                                                    var d6 = $('#'+ID+'-6').html();
                                                    var d7 = $('#'+ID+'-7').html();
                                                    $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/pharmacist/getDrugsList.php',
                                                            type: "post",
                                                            data: {pharmacistEmpID:<?php echo Session::get('username');?>
                                                                    ,HN:d1
                                                                    ,doctorEmpID:d2
                                                                    ,appointmentDate:d3
                                                                    ,morning:d4
                                                                    ,addScreeningRecordTime:d5
                                                                    ,addMedicalRecordTime:d6
                                                                    ,prescribedTime:d7},
                                                                success: function(data)
                                                                {
                                                                    $("#drugsTable").empty();
                                                                    $("#drugsTable").append(data);
                                                                    c = $('.btn').size();
                                                                    for(var i=1 ;i<=c; i++)
                                                                        $('#d-'+i).click(function(){ var v = this.id;
                                                                                                    for(var j=1 ;j<=10; j++)
                                                                                                    document.getElementById(v+"-"+j).remove();
                                                                                                 });
                                                                }
                                                          });
                                                });
                    
                }
    	});
}

function clicked(e)
{
    c++;
    e.preventDefault();
    alert("...");
}
</script>

@stop