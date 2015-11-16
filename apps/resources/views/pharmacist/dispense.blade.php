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
    
        <table width="500" Border=2 Bordercolor=Blue align="center" id="appointmentsTable"></table>
        <table align="center" id="drugsTable"></table>
        
        <table align="center">
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td></tr>
            <tr>
                <td></td>
                <td id="ok" style="display:none;align:center">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td style="align:center"><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
                <td id="add" style="display:none;align:center"><button onclick=clicked(event) type="button" class="btn btn-primary">เพิ่มยา</button></td>                
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
                                                    $('#add').css('display','inline');
                                                    var ID = this.id;
                                                    var d1 = $('#'+ID+'-1').html();
                                                    var d2 = $('#'+ID+'-2').html();
                                                    var d3 = $('#'+ID+'-3').html();
                                                    var d4 = $('#'+ID+'-4').html();
                                                    var d5 = $('#'+ID+'-5').html();
                                                    $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/pharmacist/getDrugsList.php',
                                                            type: "post",
                                                            data: {pharmacistEmpID:<?php echo Session::get('username');?>
                                                                    ,HN:d1
                                                                    ,doctorEmpID:d2
                                                                    ,appointmentDate:d3
                                                                    ,prescribedTime:d4
                                                                    ,addMedicalRecordTime:d5},
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
    $('#drugsTable').append('<tr><td><input id=d-'+c+'-1 type="hidden" name="D['+c+'][1]"></td></tr>'
    +'<tr><td><input id=d-'+c+'-2 type="hidden" name="D['+c+'][2]"></td></tr>'
    +'<tr><td><input id=d-'+c+'-3 type="hidden" name="D['+c+'][3]"></td></tr>'
    +'<tr><td><input id=d-'+c+'-4 type="hidden" name="D['+c+'][4]"></td></tr>'
    +'<tr><td><input id=d-'+c+'-5 type="hidden" name="D['+c+'][5]"></td></tr>'
    +'<tr id=d-'+c+'-9><td><label></label></td></tr><tr id=d-'+c+'-10><td><label></label></td></tr>'
    +'<tr id=d-'+c+'-6><p><td style="text-align:left;" valign="top"><label>ชื่อยา<font color="red">*</font></label></td>'
    +'<td><input required type="text" class="form-control" name="D['+c+'][6]" maxlength="100" placeholder="กรอกชื่อยา"></p></p></td></tr>'
    +'<tr id=d-'+c+'-7><p><td style="text-align:left;" valign="top"><label>ปริมาณ<font color="red">*</font></label></td>'
    +'<td><input required type="text" class="form-control" name="D['+c+'][7]" size="100" maxlength="20" placeholder="กรอกปริมาณยา"></p></td></tr>'
    +'<tr id=d-'+c+'-8><p><td style="text-align:left;" valign="top"><label>วิธีใช้<font color="red">*</font></label></td>'
    +'<td><textarea required type="input" row="2" column="50" class="form-control" name="D['+c+'][8]" maxlength="1000" placeholder="กรอกวิธีใช้ยา"></textarea></p></td>'
    +'<td><button type="button" id=d-'+c+' class="btn">ลบ</button></td></tr>');
    $('#d-'+c).click(function(){ var v = this.id;
                                 for(var i=1 ;i<=10; i++)
                                document.getElementById(v+"-"+i).remove();
                            });
}
</script>

@stop