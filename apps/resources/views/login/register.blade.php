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
                <td style="text-align:right;" valign="top">
                    <label>เลขบัตรประจำตัวประชาชน<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('idenCardNo', Input::old('idenCardNo'), [
                        'placeholder' => 'เลขบัตรประจำตัวประชาชน',
                        'class' => 'form-control',
                        'maxlength' => 13
                    ]) !!}
                    @if ($errors->has('idenCardNo'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('idenCardNo') }}
                        </p>
                    @endif
                </p>
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>ชื่อ<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('name', Input::old('name'), [
                        'placeholder' => 'ชื่อ',
                        'class' => 'form-control',
                        'maxlength' => 100
                    ]) !!}
                    @if ($errors->has('name'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>นามสกุล<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('surname', Input::old('surname'), [
                        'placeholder' => 'นามสกุล',
                        'class' => 'form-control',
                        'maxlength' => 200
                    ]) !!}
                    @if ($errors->has('surname'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('surname') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>ที่อยู่<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('address', Input::old('address'), [
                        'placeholder' => 'ที่อยู่',
                        'class' => 'form-control',
                        'maxlength' => 1000
                    ]) !!}
                    @if ($errors->has('address'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>เบอร์โทรศัพท์<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('phoneNo', Input::old('phoneNo'), [
                        'placeholder' => 'เบอร์โทรศัพท์',
                        'class' => 'form-control',
                        'maxlength' => 10
                    ]) !!}
                    @if ($errors->has('phoneNo'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('phoneNo') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>อีเมล<font color="red">*</font></label></td>
                <td>
                    {!! Form::text('emailAddr', Input::old('emailAddr'), [
                        'placeholder' => 'อีเมล',
                        'class' => 'form-control',
                        'maxlength' => 255
                    ]) !!}
                    @if ($errors->has('emailAddr'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('emailAddr') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top">
                    <label>วันเดือนปีเกิด<font color="red">*</font></label></td>
                <td>
                    {!! Form::date('birthdate', \Carbon\Carbon::now()) !!}
                    @if ($errors->has('birthdate'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('birthdate') }}
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