<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');

	$morning="เช้า";if($_POST['morning']==1)$morning="บ่าย";
	
	$screeningRecords = $conn->query("SELECT HN,date,time,weight,height,bloodPressureS,bloodPressureD,bodyTemp,pulse FROM screeningRecords");
	while($screeningRecord = $screeningRecords->fetch_assoc()) 
	{
		if(strcmp($screeningRecord['HN'],$_POST['HN'])==0
			&&strcmp($screeningRecord['date'],$_POST['appointmentDate'])==0
			&&strcmp($screeningRecord['time'],$_POST['addScreeningRecordTime'])==0)
		{
			$weight = $screeningRecord['weight'];
			$height = $screeningRecord['height'];
			$bloodPressure = $screeningRecord['bloodPressureS']."/".$screeningRecord['bloodPressureD'];
			$bodyTemp = $screeningRecord['bodyTemp'];
			$pulse = $screeningRecord['pulse'];
			break;
		}
	}

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
	$allergicDrugsList = "";
	$allergicDrugs = $conn->query("SELECT HN,allergicDrug FROM HN_allergicDrug");
	while($allergicDrug = $allergicDrugs->fetch_assoc()) 
	{
	   	if(strcmp($allergicDrug['HN'] , $_POST['HN'])==0)
	    {	    		
	    	if(++$c>1) $allergicDrugsList .= ", ";
	    	$allergicDrugsList .= $allergicDrug['allergicDrug'];
	    }
	}


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
				echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."ผู้ป่วย:  <font color='red'>".$drug['HN']."</font> แพทย์: <font color='red'>".$drug['doctorEmpID']."</font> วันพบแพทย์: <font color='red'>".$drug['date'].'</font> ช่วง: <font color="red">'.$morning.'</font></label></td>';				
				echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."เวลาบันทึกการตรวจคัดกรอง:  <font color='red'>".$_POST['addScreeningRecordTime']."</font> น้ำหนัก:  <font color='red'>".$weight."</font> ส่วนสูง:  <font color='red'>".$height."</font> ความดันโลหิต:  <font color='red'>".$bloodPressure."</font> ชีพจร:  <font color='red'>".$pulse."</font> อุณหภูมิร่างกาย:  <font color='red'>".$bodyTemp.'</font></label></td></tr>';
				echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."เวลาบันทึกการรักษา:  <font color='red'>".$_POST['addMedicalRecordTime']."</font> ผลสรุปอาการ:  <font color='red'>".$symptom."</font> รหัสโรค ICD-10:  <font color='red'>".$ICD10.'</font></label></td></tr>';
				echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."เวลาสั่งยา:  <font color='red'>".$drug['time']."</font> ยาที่ผู้ป่วยแพ้: <font color='red'>".$allergicDrugsList.'</font></label></td></tr>';
			}			
			echo  '<tr id=d-'.$c.'-9><td><label></label></td></tr><tr id=d-'.$c.'-10><td><label></label></td></tr>';

			echo  '<tr id=d-'.$c.'-6><p><td style="text-align:left;" valign="top"><label>ชื่อยา</label></td><td><input readonly required value='.$drug['drugName'].' type="text" class="form-control" name="D['.$c.'][6]" maxlength="100" placeholder="กรอกชื่อยา"></p></p></td></tr>'
				 .'<tr id=d-'.$c.'-7><p><td style="text-align:left;" valign="top"><label>ปริมาณ</label></td><td><input readonly required value='.$drug['quantity'].' type="text" class="form-control" name="D['.$c.'][7]" size="100" maxlength="20" placeholder="กรอกปริมาณยา"></p></td></tr>'
				 .'<tr id=d-'.$c.'-8><p><td style="text-align:left;" valign="top"><label>วิธีใช้</label></td><td><textarea readonly required type="input" row="2" column="50" class="form-control" name="D['.$c.'][8]" maxlength="1000" placeholder="กรอกวิธีใช้ยา">'.$drug['description'].'</textarea></p></td>';
				 //.'<td><button type="button" id=d-'.$c.' class="btn">ลบ</button></td></tr>';
		}
		
	}	


	$conn->close();
?>