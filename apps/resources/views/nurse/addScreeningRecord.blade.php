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
                    <input required id="HN" onKeyPress='return isHN("HN",this,event)' onchange="showAllergicDrugs(event)" type="text" class="form-control" placeholder="เลข5หลัก/เลข2ตัวท้ายของปีพ.ศ.ที่สมัครสมาชิก" name="HN" maxlength="8" >
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
                    <textarea required name='symptom' placeholder='กรอกอาการเบื้องต้น' class='form-control' maxlength='1000' rows="2" cols="50"></textarea>
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
                    <input required id='1' onKeyPress='return isDouble(1,this,event,3,1)' type="text" name='weight' placeholder='จำนวนไม่เกิน3หลัก ทศนิยม1หลัก' class='form-control' maxlength='5'>
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
                    <input required id='2' onKeyPress='return isInt(2,this,event,3)' type="text" name='height' placeholder='จำนวนเต็มไม่เกิน3หลัก' class='form-control' maxlength='3'>
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
                    <input required id='3' onKeyPress='return isInt(3,this,event,3)' type="text" name='pulse' placeholder='จำนวนเต็มไม่เกิน3หลัก' class='form-control' maxlength='3'>
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
                    <input required id='4' onKeyPress='return isInt(4,this,event,3)' type="text" name='bloodPressureS' placeholder='จำนวนเต็มไม่เกิน3หลัก' class='form-control' maxlength='3'>
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
                    <input required id='5' onKeyPress='return isInt(5,this,event,3)' type="text" name='bloodPressureD' placeholder='จำนวนเต็มไม่เกิน3หลัก' class='form-control' maxlength='3'>
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
                    <input required id='6' onKeyPress='return isDouble(6,this,event,2,1)' type="text" name='bodyTemp' placeholder='จำนวนไม่เกิน2หลัก ทศนิยม1หลัก' class='form-control' maxlength='4'>
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
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <td style="text-align:left;" valign="top"><label id="oldAllergicDrugs">ยาที่ผู้ป่วยแพ้</label></td>
                <td>
                    <input type="text" name='allergicDrugs' placeholder='กรอกยาที่ผู้ป่วยแพ้ ถ้ามีหลายยาให้คั่นด้วยคอมม่า' class='form-control' maxlength='1000'>
                    @if ($errors->has('allergicDrugs'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('allergicDrugs') }}
                        </p>
                    @endif
                    </p>
                </td>
            </div>
        </div>

        <br><br>
        <table align="center">
            <tr>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
        </table>
    </div>

@stop