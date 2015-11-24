@extends('doctor.layouts.template')
@section('content')

{!! Form::open([
    "url" => "doctor/prescribe/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register"
])  !!}
    <div class="box-login">
        <h2 style="text-align:center;">สั่งยา</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center" id="drugsTable">
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>HN ของผู้ป่วย<font color="red">*</font></label></td>
                <td>
                    <input required id="HN" onKeyPress='return isHN("HN",this,event)' onchange="showAllergicDrugs(event)" type="text" class="form-control" placeholder="เลข5หลัก/เลข2ตัวท้ายของปีพ.ศ.ที่สมัครสมาชิก" name="HN" maxlength="8" >
                    @if ($errors->has('HN'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('HN') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><td></td><td style="text-align:left;" valign="top"><label id="oldAllergicDrugs"></label></td></tr>
            <tr id='1x'><td><label></label></td></tr>
            <tr id='1y'><td><label></label></td>
            	<td style="text-align:center;" valign="top"><label>รายการยา</label></td>
            </tr>
            <tr id='1a'><p>
                <td style="text-align:left;" valign="top">
                    <label>ชื่อยา<font color="red">*</font></label></td>
                <td>
                    <input required type="text" class="form-control" name="D[1][1]" maxlength="100" placeholder="กรอกชื่อยา">
                    @if ($errors->has('D[1][1]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][1]') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr id='1b'><p>
                <td style="text-align:left;" valign="top">
                    <label>ปริมาณ<font color="red">*</font></label></td>
                <td>
                    <input required type="text" class="form-control" name="D[1][2]" size="100" maxlength="20" placeholder="กรอกปริมาณยา">
                    @if ($errors->has('D[1][2]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][2]') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr id='1c'><p>
                <td style="text-align:left;" valign="top">
                    <label>วิธีใช้<font color="red">*</font></label></td>
                <td>
                    <textarea required type="input" row="2" column="50" class="form-control" name="D[1][3]" maxlength="1000" placeholder="กรอกวิธีใช้ยา"></textarea>
                    @if ($errors->has('D[1][3]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][3]') }}
                        </p>
                    @endif
                    </p>
                </td>
                <td><button type="button" id='1' class="btn">ลบ</button></td>
            </tr>
        </table>
        <table align="center">
         	<tr><td><label></label></td></tr>
            <tr>
            	<td></td>
                <td style="align:right">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
                <td><button onclick=clicked(event) type="button" class="btn btn-primary">เพิ่มยา</button></td>                
            </tr>
            <tr><td><label></label></td></tr>
        </table>
    </div>

<script>
var c = 1;
function f1()
{               $('.btn').click(function(){var v = this.id;
                                document.getElementById(v+"x").remove();
                                document.getElementById(v+"y").remove();
                                document.getElementById(v+"a").remove();
                                document.getElementById(v+"b").remove();
                                document.getElementById(v+"c").remove();
                            });
}
function clicked(e)
{
    c++;
	e.preventDefault();
    $("#drugsTable").append('<tr id='+c+'x><td><label></label></td></tr><tr id='+c+'y><td><label></label></td><td style="text-align:center;" valign="top"><label>รายการยา</label></td></tr><tr id='+c+'a><p><td style="text-align:left;" valign="top"><label>ชื่อยา<font color="red">*</font></label></td><td><input required type="text" class="form-control" name="D['+c+'][1]" maxlength="100" placeholder="กรอกชื่อยา">@if ($errors->has("D['+c+'][1]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D['+c+'][1]") }}</p>@endif</p></td></tr><tr id='+c+'b><p><td style="text-align:left;" valign="top"><label>ปริมาณ<font color="red">*</font></label></td><td><input required type="text" class="form-control" name="D['+c+'][2]" size="100" maxlength="20" placeholder="กรอกปริมาณยา">@if ($errors->has("D['+c+'][2]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D['+c+'][2]") }}</p>@endif</p></td></tr><tr id='+c+'c><p><td style="text-align:left;" valign="top"><label>วิธีใช้<font color="red">*</font></label></td><td><textarea required type="input" row="2" column="50" class="form-control" name="D['+c+'][3]" maxlength="1000" placeholder="กรอกวิธีใช้ยา"></textarea>@if ($errors->has("D['+c+'][3]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D['+c+'][3]") }}</p>@endif</p></td><td><button type="button" id='+c+' class="btn">ลบ</button></td></tr>');
    $('.btn').click(function(){var v = this.id;
                                document.getElementById(v+"x").remove();
                                document.getElementById(v+"y").remove();
                                document.getElementById(v+"a").remove();
                                document.getElementById(v+"b").remove();
                                document.getElementById(v+"c").remove();
                            });
}
</script>

@stop