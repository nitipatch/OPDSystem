@extends('patient.layouts.template')
@section('content')

{!! Form::open([
    "url" => "patient/makeAppointment/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
])  !!}
    <div class="box-login">
        <h2 style="text-align:center;">ทำนัด</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center">
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>สาเหตุหรืออาการที่ต้องการพบแพทย์<font color="red">*</font></label></td>
                <td>
                    {!! Form::textarea('cause', Input::old('กรอกสาเหตุหรืออาการ'), [
                        'placeholder' => 'กรอกสาเหตุหรืออาการ',
                        'class' => 'form-control',
                        'maxlength' => 1000,
                        'size' => '50x2'
                    ]) !!}
                    
                    @if ($errors->has('cause'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('cause') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ชื่อแพทย์ที่ต้องการพบ<font color="red">*</font></label></td>
                <td>
                    <?php $doctorsList = [''];
                    $doctors = DB::table('users')->where('type','doctor')->get();
                    foreach($doctors as $doctor){array_push($doctorsList,$doctor->name." ".$doctor->surname);}
                    function withEmpty($selectList,$emptyLabel){return array(''=>$emptyLabel) + $selectList;} ?>
                    
                    {!! Form::select('doctor', withEmpty($doctorsList,'--เลือกแพทย์--'),null,['class'=>'form-control']) !!}
                    @if ($errors->has('doctor'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('doctor') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>แผนกของแพทย์ที่ต้องการพบ<font color="red">*</font></label></td>
                <td>
                    <?php $departmentsList=['','อายุรกรรม','ศัลยกรรม','ออร์โธปีดิกส์','กุมารเวชกรรม','สูตินรีเวช','ทันตกรรม','เวชปฏิบัติ','แพทย์เฉพาะทางอื่นๆ'];?>
                    
                    {!!Form::select('department',withEmpty($departmentsList,'--เลือกแผนก--'),null,['class'=>'form-control'])!!}
                    @if ($errors->has('department'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('department') }}
                        </p>
                    @endif
                    </p>  
                </td>
            </tr>  
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>วันนัด<font color="red">*</font></label></td>
                <td>
                    {!! Form::date('apptDate', \Carbon\Carbon::now()) !!}
                    @if ($errors->has('apptDate'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('apptDate') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ช่วงเวลา<font color="red">*</font></label></td>
                <td>
                    {!! Form::radio('morning',1) !!}เช้า
                    {!! Form::radio('morning',0) !!}บ่าย
                    @if ($errors->has('morning'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('morning') }}
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