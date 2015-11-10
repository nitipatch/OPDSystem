@extends('doctor.layouts.template')
@section('content')
<?php if(isset($_POST["sb"])){$count=$_POST["count"];echo '<script type="text/javascript">alert("...");</script>';}?>
{!! Form::open([
    "url" => "doctor/prescribe/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
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
                    {!! Form::text('HN', Input::old('กรอก HN ของผู้ป่วย'), [
                        'placeholder' => 'กรอก HN ของผู้ป่วย',
                        'class' => 'form-control',
                        'maxlength' => 8,
                    ]) !!}
                    
                    @if ($errors->has('HN'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('HN') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><td><label></label></td></tr>
            <tr><td><label></label></td>
            	<td style="text-align:center;" valign="top"><label>ยาตัวที่ 1</label></td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ชื่อยา<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('D[1][1]', Input::old('กรอกชื่อยา'), [
                        'placeholder' => 'กรอกชื่อยา',
                        'class' => 'form-control',
                        'maxlength' => 100,
                    ]) !!}
                    
                    @if ($errors->has('D[1][1]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][1]') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ปริมาณ<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('D[1][2]', Input::old('กรอกปริมาณ'), [
                        'placeholder' => 'กรอกปริมาณ',
                        'class' => 'form-control',
                        'maxlength' => 100,
                    ]) !!}
                    
                    @if ($errors->has('D[1][2]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][2]') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>วิธีใช้<font color="red">*</font></label></td>
                <td>
                    {!! Form::textarea('D[1][3]', Input::old('กรอกวิธีใช้'), [
                        'placeholder' => 'กรอกวิธีใช้',
                        'class' => 'form-control',
                        'maxlength' => 1000,
                        'size' => '50x2'
                    ]) !!}
                    
                    @if ($errors->has('D[1][3]'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('D[1][3]') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
        </table>
        <table align="center">
         	<tr><td><label></label></td></tr>
            <tr>
            	<td></td>
                <td style="align:right">{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
                <td><form action="" method="POST"><input type="text" name="count" value=2><input name="sb" type="submit" class="btn btn-primary" value="เพิ่มยา"></form></td>
            </tr>
            <tr><td><label></label></td></tr>
        </table>
    </div>



<script>
/*
function clicked(e)
{
	e.preventDefault();
	$('#drugsTable').append('<?php if(isset($_POST["sb"]))$count=$_POST["count"];else $count=1;?><tr><td><label></label></td><td style="text-align:center;" valign="top"><label>ยาตัวที่ <?php echo $count;?></label></td></tr><tr><p><td style="text-align:left;" valign="top"><label>ชื่อยา<font color="red">*</font></label></td><td>{!! Form::text("D[$count][1]", Input::old("กรอกชื่อยา"), ["placeholder" => "กรอกชื่อยา","class" => "form-control","maxlength" => 100,]) !!}@if ($errors->has("D[$count][1]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D[$count][1]") }}</p>@endif</p></td></tr><tr><p><td style="text-align:left;" valign="top"><label>ปริมาณ<font color="red">*</font></label></td><td>{!! Form::text("D[$count][2]", Input::old("กรอกปริมาณ"), ["placeholder" => "กรอกปริมาณ","class" =>"form-control","maxlength" => 100,]) !!}@if ($errors->has("D[$count][2]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D[$count][2]") }}</p>@endif</p></td></tr><tr><p><td style="text-align:left;" valign="top"><label>วิธีใช้<font color="red">*</font></label></td><td>{!! Form::textarea("D[$count][3]", Input::old("กรอกวิธีใช้"), ["placeholder" => "กรอกวิธีใช้","class" => "form-control","maxlength" => 1000,"size" => "50x2"]) !!}@if ($errors->has("D[$count][3]"))<p style="color:red;font-size:14px;margin:0;padding:10px 0px;">{{ $errors->first("D[$count][3]") }}</p>@endif</p></td></tr><?php Session::put("c",$count);?>');
}*/
</script>

@stop