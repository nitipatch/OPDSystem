@extends('doctor.layouts.template')
@section('content')

{!! Form::open([
    "url" => "doctor/addMedicalRecord/create",
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
        <table align="center" id="drugsList">
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
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>อาการ<font color="red">*</font></label></td>
                <td>
                    {!! Form::textarea('symptom', Input::old('กรอกอาการ'), [
                        'placeholder' => 'กรอกอาการ',
                        'class' => 'form-control',
                        'maxlength' => 1000,
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
                    <label>รหัสโรค ICD-10<font color="red">*</font></label></td>
                <td>
                    <?php $diseasesList = [''];
                    $diseases = DB::table('ICD10_Disease')->get();
                    foreach($diseases as $disease){array_push($diseasesList,$disease->ICD10." ".$disease->Disease);}
                    function withEmpty($selectList,$emptyLabel){return array(''=>$emptyLabel) + $selectList;} ?>
                    
                    {!!Form::select('ICD10',withEmpty($diseasesList,'--เลือกรหัสโรค--'),null,['class'=>'form-control'])!!}
                    @if ($errors->has('ICD10'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('ICD10') }}
                        </p>
                    @endif
                    </p>  
                </td>
            </tr> 
         
       
            <tr>
                <td style="text-align:left;"></td>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
        </table>
    </div>
@stop