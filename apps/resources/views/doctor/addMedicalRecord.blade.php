@extends('doctor.layouts.template')
@section('content')

{!! Form::open([
    "url" => "doctor/addMedicalRecord/create",
    "method" => "POST",
    "files" => true,
    "class" => "form-register",
])  !!}
    <div class="box-login">
        <h2 style="text-align:center;">บันทึกการรักษา</h2>
        @if(Session::has('flash_notice'))
            <h3 style="color:red;text-align:center;">{{ Session::get('flash_notice') }}</h3>
        @endif
        <h3 style="color:red;text-align:center;"></h3>
        <table align="center" id="drugsList">
            <tr><p>
                <td style="text-align:left;" valign="top">
                    <label>HN ของผู้ป่วย<font color="red">*</font></label></td>
                <td>
                    <input required id="HN" onKeyPress='return isHN("HN",this,event)' type="text" class="form-control" placeholder="เลข5หลัก/เลข2ตัวท้ายของปีพ.ศ.ที่สมัครสมาชิก" name="HN" maxlength="8" >
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
                    <label>อาการของโรค<font color="red">*</font></label></td>
                <td>
                    <textarea required name='symptom' placeholder='กรอกอาการของโรค' class='form-control' maxlength='1000' rows="2" cols="50"></textarea>
                    @if ($errors->has('symptom'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('symptom') }}
                        </p>
                    @endif
                    </p>
                </td>
            </tr>
            <tr>
            	<td style="text-align:left;" valign="top">
                    <label>ค้นหา ICD-10 ด้วยชื่อโรค<font color="red">*</font></label></td>
                <td>
                    <input required id="searchICD10" type="text" class="form-control" placeholder="กรอกโรคที่ต้องการค้นหา" maxlength="8" onchange="searchICD(event)" >
                </td>
            </tr>
          	<tr><p>

                <td style="text-align:left;" valign="top">
                    <label>รหัสโรค ICD-10<font color="red">*</font></label></td>
                <td>
                    <?php $diseasesList = [];
                    $diseases = DB::table('ICD10_Disease')->get();
                    foreach($diseases as $disease){array_push($diseasesList,$disease->ICD10." ".$disease->Disease);}
                    function withEmpty($selectList,$emptyLabel){return array(''=>$emptyLabel) + $selectList;} ?>
                    
                    {!!Form::select('ICD10',withEmpty($diseasesList,'--เลือกรหัสโรค--'),null,['required' => 'required','class'=>'form-control'])!!}
                    @if ($errors->has('ICD10'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('ICD10') }}
                        </p>
                    @endif
                    </p>  
                </td>
            </tr> 
        </table>
        <br><br>
        <table align="center">
            <tr>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
        </table>
    </div>

<script>
    $('#ICD10').empty();
    var icd10DD = document.getElementById("ICD10");//แก้ด้วยครัช
    icd10DD.addEventListener("change",f);
    //departmentDD.addEventListener("change",g);
    

    function f()
    {
        
        var icd10 = icd10DD.options[icd10DD.selectedIndex].text;
        //var department = departmentDD.options[departmentDD.selectedIndex].text;

        $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/doctor/getICD10.php',
                type: "post",
                data: {icd10:icd10},
                success: function(data)
                {
                    var icd10s = data.split("\n");
                    $('#ICD10').empty();
                    
                    for(var i=0;i<icd10s.length;i++)
                    {    
                        echo $icd10s[i].PHP_EOL;
                        //echo "hello";
                        var disease = document.getElementById('ICD10');
                        disease.add(icd10s[i]);
                    }
                }
        });
    }

</script>

@stop