@extends('login.layouts.template')
@section('content')
<?php echo csrf_field(); ?>
{!! Form::open([
    "url" => "login/register/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
])  !!}
    <div class="box-login">
        <h2 style="text-align:center;">สมัครสมาชิก</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center">
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>เลขบัตรประจำตัวประชาชน<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('idenCardNo', Input::old('idenCardNo'), [
                        'placeholder' => 'เลขบัตรประจำตัวประชาชน',
                        'class' => 'form-control',
                        'maxlength' => 13,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('idenCardNo'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('idenCardNo') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ชื่อ<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('name', Input::old('name'), [
                        'placeholder' => 'ชื่อ',
                        'class' => 'form-control',
                        'maxlength' => 100,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('name'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>นามสกุล<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('surname', Input::old('surname'), [
                        'placeholder' => 'นามสกุล',
                        'class' => 'form-control',
                        'maxlength' => 200,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('surname'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('surname') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>ที่อยู่<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('address', Input::old('address'), [
                        'placeholder' => 'ที่อยู่',
                        'class' => 'form-control',
                        'maxlength' => 1000,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('address'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>เบอร์โทรศัพท์<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('phoneNo', Input::old('phoneNo'), [
                        'placeholder' => 'เบอร์โทรศัพท์',
                        'class' => 'form-control',
                        'maxlength' => 10,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('phoneNo'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('phoneNo') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>อีเมล<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('emailAddr', Input::old('emailAddr'), [
                        'placeholder' => 'อีเมล',
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'required' => 'required'
                    ]) !!}
                    @if ($errors->has('emailAddr'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('emailAddr') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>วันเดือนปีเกิด<font color="red">*</font></label></td>
                <td>
                    {!! Form::date('birthdate' ,'', ['required' => 'required']) !!}
                    @if ($errors->has('birthdate'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('birthdate') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            
            <tr>
                <td style="text-align:left;"></td>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}</td>
            </tr>
        </table>
    </div>
{!! Form::close() !!}
@stop