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
                        'required' => 'required',
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
                    <?php $i=1; $doctorsList = []; $dpm = [];
                    $departmentsList=['อายุรกรรม','ศัลยกรรม','ออร์โธปีดิกส์','กุมารเวชกรรม','สูตินรีเวช','ทันตกรรม','เวชปฏิบัติ','แพทย์เฉพาะทางอื่นๆ'];
                    $doctors = DB::table('users')->where('type','doctor')->get();
                    foreach($doctors as $doctor)
                    {
                        for($j=0;$j<count($departmentsList);$j++)
                        if(strcmp($departmentsList[$j],$doctor->department)==0)
                        {$dpm[$i] = $j; $i++; break;}
                        array_push($doctorsList,$doctor->name." ".$doctor->surname);
                    }
                    function withEmpty($selectList,$emptyLabel){return array('-1'=>$emptyLabel) + $selectList;} ?>
                    
                    {!! Form::select('doctor', withEmpty($doctorsList,'--เลือกแพทย์--'),null,[
                            'class'=>'form-control'
                            ,'id'=>'doctor'
                    ]) !!}
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
                    {!!Form::select('department',withEmpty($departmentsList,'--เลือกแผนก--'),null,[
                            'class'=>'form-control'
                            ,'id'=>'department'
                    ])!!}
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
                    <label>วันเวลานัด<font color="red">*</font></label></td>
                <td> 
                    <?php $datesList = [];?>
                    
                    {!! Form::select('apptDate', withEmpty($datesList,'--เลือกวันเวลานัด--'),null,[
                            'required' => 'required'
                            ,'class'=>'form-control'
                            ,'id'=>'apptDate'
                    ]) !!}
                    @if ($errors->has('apptDate'))
                        <p style="color:red;font-size:14px;margin:0;padding:10px 0px;">
                            {{ $errors->first('apptDate') }}
                        </p>
                    @endif
                </td>
            </tr>
        </table>
        <br><br>
        <table align="center">
            <tr>
                <td>{!! Form::submit('ตกลง', ['class' => 'btn btn-primary' , 'id' => 'test']) !!}{!! Form::close() !!}</td>
                <td><form action="loginsuccess"><input type="submit" class="btn" value="ยกเลิก"></form></td>
            </tr>
        </table>
    </div>

<script>
    var doctorDD = document.getElementById("doctor");
    var departmentDD = document.getElementById("department");
    doctorDD.addEventListener("change",f);
    departmentDD.addEventListener("change",g);
    var dpm = <?php echo json_encode($dpm);?>;

    function f()
    {
        $("#department").val(dpm[doctorDD.selectedIndex]);
        var fullname = doctorDD.options[doctorDD.selectedIndex].text;
        var department = departmentDD.options[departmentDD.selectedIndex].text;

        $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/getApptDate.php',
                type: "post",
                data: {fullname:fullname,department:department},
                success: function(data)
                {
                    var dates = data.split("\n");
                    $('#apptDate').empty();
                    
                    for(var i=0;i<=dates.length-2;i++)
                    {    
                        var ddl = document.getElementById('apptDate');
                        var option = document.createElement("option");
                        var cut = dates[i].indexOf(" ");
                        var text = dates[i].substring(0,cut);
                        if(dates[i][cut+1]=="0")text+=" เช้า";
                        else text+=" บ่าย";
                        option.text = text
                        option.value = text;
                        ddl.add(option);
                    }
                }
        });
    }

    function g()
    {   
        $("#doctor").val('-1');
        var fullname = doctorDD.options[doctorDD.selectedIndex].text;
        var department = departmentDD.options[departmentDD.selectedIndex].text;

        $.ajax({url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/getApptDate.php',
                type: "post",
                data: {fullname:fullname,department:department},
                success: function(data)
                {
                    var dates = data.split("\n");
                    $('#apptDate').empty();
                    
                    for(var i=0;i<=dates.length-2;i++)
                    {    
                        var ddl = document.getElementById('apptDate');
                        var option = document.createElement("option");
                        var cut = dates[i].indexOf(" ");
                        var text = dates[i].substring(0,cut);
                        if(dates[i][cut+1]=="0")text+=" เช้า";
                        else text+=" บ่าย";
                        option.text = text
                        option.value = text;
                        ddl.add(option);
                    }
                }
        });
    }
</script>
   
@stop