@extends('patient.layouts.template')
@section('content')
<?php echo csrf_field(); ?>
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
            <tr>
                <td style="text-align:right;" valign="top"><label>สาเหตุหรืออาการที่ต้องการพบแพทย์</label></td>
                <td>
                    {!! Form::textarea('cause', Input::old('กรอกสาเหตุหรืออาการ'), [
                        'placeholder' => 'สาเหตุหรืออาการที่ต้องการพบแพทย์',
                        'class' => 'form-control',
                        'maxlength' => 1000
                    ]) !!}
                    @if ($errors->has('cause'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('cause') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top"><label>ชื่อแพทย์</label></td>
                <td>
                    {!! Form::text('doctor', Input::old('กรอกชื่อแพทย์'), [
                        'placeholder' => 'ชื่อแพทย์',
                        'class' => 'form-control',
                        'maxlength' => 100
                    ]) !!}
                    @if ($errors->has('doctor'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('doctor') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top"><label>แผนก</label></td>
                <td>
                    {!! Form::select('department', ['','อายุรกรรม','ศัลยกรรม','ออร์โธปีดิกส์','กุมารเวชกรรม','สูตินรีเวช'
                    ,'ทันตกรรม','เวชปฏิบัติ','แพทย์เฉพาะทางอื่นๆ']) !!}
                    @if ($errors->has('doctor'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('doctor') }}
                        </p>
                    @endif
                </td>
            </tr>  
            <tr>
                <td style="text-align:right;" valign="top"><label>วันนัด</label></td>
                <td>
                    {!! Form::date('apptDate', \Carbon\Carbon::now()) !!}
                    @if ($errors->has('apptDate'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('apptDate') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top"><label>ช่วงเวลา</label></td>
                <td>
                    {!! Form::radio('morning',1) !!}เช้า
                    {!! Form::radio('morning',0) !!}บ่าย
                    @if ($errors->has('morning'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('morning') }}
                        </p>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td style="text-align:right;"></td>
                <td>{!! Form::submit('Create', ['class' => 'btn']) !!}</td>
            </tr>
        </table>
    </div>
{!! Form::close() !!}
@stop