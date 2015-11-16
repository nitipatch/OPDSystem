<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');

	$medicalRecords = $conn->query("SELECT HN,doctorEmpID,date,time,symptom,ICD10 FROM medicalRecords");
	while($medicalRecord = $medicalRecords->fetch_assoc()) 
	{
		if(strcmp($medicalRecord['HN'],$_POST['HN'])==0
			&&strcmp($medicalRecord['doctorEmpID'],$_POST['doctorEmpID'])==0 
			&&strcmp($medicalRecord['date'],$_POST['appointmentDate'])==0
			&&strcmp($medicalRecord['time'],$_POST['addMedicalRecordTime'])==0)
		{
			$symptom = $medicalRecord['symptom'];
			$ICD10 = $medicalRecord['ICD10'];
			break;
		}
	}

	$drugs = $conn->query("SELECT HN,doctorEmpID,date,time,drugName,quantity,description FROM prescribedDrugs");
	$c = 0;
	while($drug = $drugs->fetch_assoc()) 
	{
		if(strcmp($drug['HN'],$_POST['HN'])==0
			&&strcmp($drug['doctorEmpID'],$_POST['doctorEmpID'])==0 
			&&strcmp($drug['date'],$_POST['appointmentDate'])==0
			&&strcmp($drug['time'],$_POST['prescribedTime'])==0)
		{			
	    	$c++;
			echo  '<tr><td><input id=d-'.$c.'-1 value='.$drug['HN'].' type="hidden" name="D['.$c.'][1]"></td></tr>'
				 .'<tr><td><input id=d-'.$c.'-2 value='.$drug['doctorEmpID'].' type="hidden" name="D['.$c.'][2]"></td></tr>'
				 .'<tr><td><input id=d-'.$c.'-3 value='.$drug['date'].' type="hidden" name="D['.$c.'][3]"></td></tr>'
				 .'<tr><td><input id=d-'.$c.'-4 value='.$drug['time'].' type="hidden" name="D['.$c.'][4]"></td></tr>'
				 .'<tr><td><input id=d-'.$c.'-5 value='.$drug['drugName'].' type="hidden" name="D['.$c.'][5]"></td></tr>';
			if($c==1)
			{	
				echo  '<tr><td><label></label></td></tr><tr><td><label></label></td></tr><tr><td><label></label></td></tr>';
				echo  '<tr><td><label></label></td><td style="text-align:center;" valign="top"><label>'."ผู้ป่วย: ".$drug['HN']."_____แพทย์สั่งยา: ".$drug['doctorEmpID']."_____วันเวลาสั่งยา: ".$drug['date']." ".$drug['time'].'</label></td></tr>';
				echo  '<tr><td><label></label></td><td style="text-align:center;" valign="top"><label>'."ผลสรุปอาการ: ".$symptom."_____รหัสโรค ICD-10: ".$ICD10.'</label></td></tr>';
			}			
			echo  '<tr id=d-'.$c.'-9><td><label></label></td></tr><tr id=d-'.$c.'-10><td><label></label></td></tr>';

			echo  '<tr id=d-'.$c.'-6><p><td style="text-align:left;" valign="top"><label>ชื่อยา<font color="red">*</font></label></td><td><input required value='.$drug['drugName'].' type="text" class="form-control" name="D['.$c.'][6]" maxlength="100" placeholder="กรอกชื่อยา"></p></p></td></tr>'
				 .'<tr id=d-'.$c.'-7><p><td style="text-align:left;" valign="top"><label>ปริมาณ<font color="red">*</font></label></td><td><input required value='.$drug['quantity'].' type="text" class="form-control" name="D['.$c.'][7]" size="100" maxlength="20" placeholder="กรอกปริมาณยา"></p></td></tr>'
				 .'<tr id=d-'.$c.'-8><p><td style="text-align:left;" valign="top"><label>วิธีใช้<font color="red">*</font></label></td><td><textarea required type="input" row="2" column="50" class="form-control" name="D['.$c.'][8]" maxlength="1000" placeholder="กรอกวิธีใช้ยา">'.$drug['description'].'</textarea></p></td>'
				 .'<td><button type="button" id=d-'.$c.' class="btn">ลบ</button></td></tr>';
		}
		
	}	
?>