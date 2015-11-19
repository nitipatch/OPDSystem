@extends('nurse.layouts.template')
@section('content')

{!! Form::open([
    "url" => "nurse/addScreeningRecord/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
])  !!}
    <div class="box-login">
        <h2 style="text-align:center;">บันทึกการตรวจคัดกรอง</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6"> 
                <td style="text-align:left;" valign="top">
                    <label>HN ของผู้ป่วย<font color="red">*</font></label></td>
                <td>
                    <input required id="HN" onchange="c(event)" type="text" class="form-control" name="HN" maxlength="8" placeholder="กรอก HN ของผู้ป่วย">
                    @if ($errors->has('HN'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('HN') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <td style="text-align:left;" valign="top">
                    <label>อาการเบื้องต้น<font color="red">*</font></label></td>
                <td>
                    {!! Form::textarea('symptom', Input::old('กรอกอาการเบื้องต้น'), [
                        'placeholder' => 'กรอกอาการเบื้องต้น',
                        'class' => 'form-control',
                        'maxlength' => 1000,
                        'required' => 'required',
                        'size' => '50x2'
                    ]) !!}
                    
                    @if ($errors->has('symptom'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('symptom') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>น้ำหนัก<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('weight', Input::old('กรอกน้ำหนักของผู้ป่วย'), [
                        'placeholder' => 'กรอกน้ำหนักของผู้ป่วย',
                        'required' => 'required',
                        'class' => 'form-control',
                        'maxlength' => 3
                    ]) !!}
                    
                    @if ($errors->has('weight'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>ส่วนสูง<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('height', Input::old('กรอกส่วนสูงของผู้ป่วย'), [
                        'placeholder' => 'กรอกส่วนสูงของผู้ป่วย',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('height'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('height') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>ชีพจร<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('pulse', Input::old('กรอกชีพจรของผู้ป่วย'), [
                        'placeholder' => 'กรอกชีพจรของผู้ป่วย',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('pulse'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('pulse') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>
            
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>ความดันโลหิต Systolic<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bloodPressureS', Input::old('กรอกความดันโลหิต Systolic'), [
                        'placeholder' => 'กรอกความดันโลหิต Systolic',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('bloodPressureS'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bloodPressureS') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>ความดันโลหิต Diastolic<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bloodPressureD', Input::old('กรอกความดันโลหิต Diastolic'), [
                        'placeholder' => 'กรอกความดันโลหิต Diastolic',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('bloodPressureD'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bloodPressureD') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
            <div class="col-md-3">
                <td style="text-align:left;" valign="top">
                    <label>อุณหภูมิร่างกาย<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bodyTemp', Input::old('กรอกอุณหภูมิร่างกายของผู้ป่วย'), [
                        'placeholder' => 'กรอกอุณหภูมิร่างกายของผู้ป่วย',
                        'required' => 'required',
                        'class' => 'form-control',
                        'maxlength' => 3
                    ]) !!}
                    
                    @if ($errors->has('bodyTemp'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bodyTemp') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>
        <div class="row">
            <tr><td></td><td id="allergicDrugs"></td></tr>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <td style="text-align:left;" valign="top">
                    <label>ยาที่ผู้ป่วยแพ้</label></td>
                <td>
                    {!! Form::text('allergicDrug', Input::old('กรอกชื่อยาที่ผู้ป่วยแพ้ คั่นด้วย , ถ้ามากกว่า 1'), [
                        'placeholder' => 'กรอกชื่อยาที่ผู้ป่วยแพ้ คั่นด้วย , ถ้ามากกว่า 1',
                        'class' => 'form-control',
                        'maxlength' => 1000
                    ]) !!}
                    
                    @if ($errors->has('allergicDrug'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('allergicDrug') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>

        <!-- <table align="center" id="drugsList">
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>HN ของผู้ป่วย<font color="red">*</font></label></td>
                <td>
                    <input required id="HN" onchange="c(event)" type="text" class="form-control" name="HN" maxlength="8" placeholder="กรอก HN ของผู้ป่วย">
                    @if ($errors->has('HN'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('HN') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>อาการเบื้องต้น<font color="red">*</font></label></td>
                <td>
                    {!! Form::textarea('symptom', Input::old('กรอกอาการเบื้องต้น'), [
                        'placeholder' => 'กรอกอาการเบื้องต้น',
                        'class' => 'form-control',
                        'maxlength' => 1000,
                        'required' => 'required',
                        'size' => '50x2'
                    ]) !!}
                    
                    @if ($errors->has('symptom'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('symptom') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>น้ำหนัก<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('weight', Input::old('กรอกน้ำหนักของผู้ป่วย'), [
                        'placeholder' => 'กรอกน้ำหนักของผู้ป่วย',
                        'required' => 'required',
                        'class' => 'form-control',
                        'maxlength' => 3
                    ]) !!}
                    
                    @if ($errors->has('weight'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ส่วนสูง<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('height', Input::old('กรอกส่วนสูงของผู้ป่วย'), [
                        'placeholder' => 'กรอกส่วนสูงของผู้ป่วย',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('height'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('height') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ชีพจร<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('pulse', Input::old('กรอกชีพจรของผู้ป่วย'), [
                        'placeholder' => 'กรอกชีพจรของผู้ป่วย',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('pulse'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('pulse') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ความดันโลหิต Systolic<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bloodPressureS', Input::old('กรอกความดันโลหิต Systolic'), [
                        'placeholder' => 'กรอกความดันโลหิต Systolic',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('bloodPressureS'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bloodPressureS') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ความดันโลหิต Diastolic<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bloodPressureD', Input::old('กรอกความดันโลหิต Diastolic'), [
                        'placeholder' => 'กรอกความดันโลหิต Diastolic',
                        'class' => 'form-control',
                        'required' => 'required',
                        'maxlength' => 3,
                    ]) !!}
                    
                    @if ($errors->has('bloodPressureD'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bloodPressureD') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>อุณหภูมิร่างกาย<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('bodyTemp', Input::old('กรอกอุณหภูมิร่างกายของผู้ป่วย'), [
                        'placeholder' => 'กรอกอุณหภูมิร่างกายของผู้ป่วย',
                        'required' => 'required',
                        'class' => 'form-control',
                        'maxlength' => 3
                    ]) !!}
                    
                    @if ($errors->has('bodyTemp'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('bodyTemp') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><td></td><td id="allergicDrugs"></td></tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ยาที่ผู้ป่วยแพ้</label></td>
                <td>
                    {!! Form::text('allergicDrug', Input::old('กรอกชื่อยาที่ผู้ป่วยแพ้ คั่นด้วย , ถ้ามากกว่า 1'), [
                        'placeholder' => 'กรอกชื่อยาที่ผู้ป่วยแพ้ คั่นด้วย , ถ้ามากกว่า 1',
                        'class' => 'form-control',
                        'maxlength' => 1000
                    ]) !!}
                    
                    @if ($errors->has('allergicDrug'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('allergicDrug') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
        </table> -->
        <br><br>
        <table align="center">
            <tr>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
        </table>
    </div>

<script>
function c(e){  
                var v = $('#HN').val();
                $.ajax({    url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/nurse/Ajax.php',
                            type: "post",
                            data: {HN:v},
                            success: function(data)
                            {
                                $('#allergicDrugs').html('<font color="red">'+data+'</font>');
                            }
                      });
            }
</script>

@stop