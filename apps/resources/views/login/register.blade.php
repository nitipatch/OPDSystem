@extends('login.layouts.template')
@section('content')
<!DOCTYPE html>
<?php echo csrf_field(); ?>
{!! Form::open([
    "url" => "login/register/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
]) !!}
    <div class="box-login">
        <h2 style="text-align:center;">สมัครสมาชิก</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center">
            <tr>
                <td style="text-align:right;" valign="top"><label>Full Name</label></td>
                <td>
                    {!! Form::text('name', Input::old('name'), [
                        'placeholder' => 'Full Name',
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
                <td style="text-align:right;" valign="top"><label>Email</label></td>
                <td>
                    {!! Form::text('email', Input::old('email'), [
                        'placeholder' => 'Email',
                        'class' => 'form-control',
                        'maxlength' => 100
                    ]) !!}
                    @if ($errors->has('email'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top"><label>Password</label></td>
                <td>
                    {!! Form::password('password', [
                        'placeholder' => 'Password',
                        'class' => 'form-control',
                        'maxlength' => 15
                    ]) !!}
                    @if ($errors->has('password'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:right;" valign="top"><label>Confirm Password</label></td>
                <td>
                    {!! Form::password('password_confirmation', [
                        'placeholder' => 'Confirm Password',
                        'class' => 'form-control',
                        'maxlength' => 15
                    ]) !!}
                    @if ($errors->has('password_confirmation'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('password_confirmation') }}
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