@extends('doctor.layouts.template')
@section('content')

{!! Form::open([
	"url" => "doctor/changePrescribedDrugs/create",
	"method" => "POST",
	"files" => true,
	"class" => "form-register",
])	!!} 

	<div class="box-login">
        <h2 style="text-align:center;">เปลี่ยนรายการยา</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <br>
    
        <table width="800" Border=2 Bordercolor=Blue align="center" id="appointmentsTable"></table>
        <table align="left" id="drugsTable"></table>
        <input type="hidden" value=2 id="status" name="status">
        <table align="center">
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td></tr>
            <tr>
                <td></td>
                <td id="ok" style="display:none;align:center">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td style="align:center"><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
                <td id="add" style="display:none;align:center"><button onclick=clicked(event) type="button" class="btn btn-primary">เพิ่มยาใหม่</button></td>                
            </tr>
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td></tr>
        </table>
    </div>

<script>
var c=0,d1;
function f()
{	

	<?php
		use Illuminate\Support\Facades\DB;
		use Illuminate\Support\Facades\Session;
		$appointments = DB::table('appointments')->where('doctorEmpID',Session::get('username'))->where('dispensedStatus',1)->get();
    ?>
    $("#requestButton").click(function(){$("#status").val(1);});

    $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/doctor/getRequestList.php',
                type: "post",
                data: {doctorEmpID:<?php echo Session::get('username');?>},
                success: function(data)
                {
                	$("#appointmentsTable").append(data);
                   
                    for(var i=1;i<=<?php echo count($appointments);?>;i++)
                        $('#'+i).click(function(){  $('#ok').css('display','inline');
                                                    $('#add').css('display','inline');
                                                    var ID = this.id;
                                                    d1 = $('#'+ID+'-1').html();
                                                    var d2 = $('#'+ID+'-2').html();
                                                    var d3 = $('#'+ID+'-3').html();
                                                    var d4 = $('#'+ID+'-4').html();
                                                    var d5 = $('#'+ID+'-5').html();
                                                    var d6 = $('#'+ID+'-6').html();
                                                    var d7 = $('#'+ID+'-7').html();
                                                    var d8 = $('#'+ID+'-8').html();
                                                    $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/doctor/getDrugsList.php',
                                                            type: "post",
                                                            data: {doctorEmpID:<?php echo Session::get('username');?>
                                                                    ,HN:d1
                                                                    ,appointmentDate:d2
                                                                    ,morning:d3
                                                                    ,addScreeningRecordTime:d4
                                                                    ,addMedicalRecordTime:d5
                                                                    ,prescribedTime:d6
                                                                    ,dispensedTime:d7
                                                                    ,comment:d8},
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
    $('#drugsTable').append('<tr><td><input value='+d1+' id=d-'+c+'-1 type="hidden" name="D['+c+'][1]"></td></tr>'
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
    $('#d-'+c).click(function(){ var v = this.id;for(var i=1 ;i<=10; i++)document.getElementById(v+"-"+i).remove();});
}
</script>

@stop