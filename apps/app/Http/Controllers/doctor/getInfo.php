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
	$c = 1;
	echo  '<tr><td><input value='.$_POST['HN'].' type="hidden" name="patientHN"></td></tr>';
	echo  '<tr><td><input value='.$_POST['appointmentDate'].' type="hidden" name="appointmentDate"></td></tr>';
	echo  '<tr><td><input value='.$_POST['morning'].' type="hidden" name="morning"></td></tr>';

	echo  '<tr><td><label></label></td></tr><tr><td><label></label></td></tr><tr><td><label></label></td></tr>';
	echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."ผู้ป่วย:  <font color='red'>".$_POST['HN']."</font> วันพบแพทย์: <font color='red'>".$_POST['appointmentDate'].'</font> ช่วง: <font color="red">'.$morning.'</font></label></td>';				
	echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."เวลาบันทึกการตรวจคัดกรอง:  <font color='red'>".$_POST['addScreeningRecordTime']."</font> น้ำหนัก:  <font color='red'>".$weight."</font> ส่วนสูง:  <font color='red'>".$height."</font> ความดันโลหิต:  <font color='red'>".$bloodPressure."</font> ชีพจร:  <font color='red'>".$pulse."</font> อุณหภูมิร่างกาย:  <font color='red'>".$bodyTemp.'</font></label></td></tr>';
	echo  '<tr><td colspan="2" style="text-align:left;" valign="top"><label>'."ยาที่ผู้ป่วยแพ้: <font color='red'>".$allergicDrugsList.'</font></label></td></tr>';
	
	echo  '<tr><td><label></label></td></tr><tr><td><label></label></td></tr>';
	echo '<tr><td colspan=2 style="width:100px;text-align:left;" valign="top"><label>อาการของโรค<font color="red">*</font></label></td></tr>
          <tr><td colspan=2><textarea required name="symptom" placeholder="กรอกอาการของโรค" class="form-control" maxlength="1000" rows="2" cols="50"></textarea></td></tr>';

	echo  '<tr><td><label></label></td></tr>';
    echo '<tr><td colspan=2 style="text-align:left;" valign="top"><label>ค้นหารหัสโรค ICD-10 ด้วยชื่อโรค<font color="red">*</font></label></td></tr>
          <tr><td colspan=2><input required id="searchICD10" type="text" class="form-control" placeholder="กรอกโรคที่ต้องการค้นหา" maxlength="8" onchange="searchICD(event)" ></td></tr>';

	echo  '<tr><td><label></label></td></tr>';    
    echo '<tr><td colspan=2 style="text-align:left;" valign="top"><label>รหัสโรค ICD-10<font color="red">*</font></label></td></tr>
          <tr><td colspan=2><select type="input" name="ICD10" required id="diseasesDD" class="form-control"></select></td></tr>';
	
	echo  '<tr><td><label></label></td></tr><tr><td><label></label></td></tr>';

	echo  '<tr id=d-'.$c.'-9><td><label></label></td></tr><tr id=d-'.$c.'-10><td><label></label></td></tr>';
	echo  '<tr><td><input value='.$_POST['HN'].' id=d-'.$c.'-1 type="hidden" name="D['.$c.'][1]"></td></tr>';
    echo  '<tr><td><input value='.$_POST['appointmentDate'].' id=d-'.$c.'-2 type="hidden" name="D['.$c.'][2]"></td></tr>';
    echo  '<tr><td><input value='.$_POST['morning'].' id=d-'.$c.'-3 type="hidden" name="D['.$c.'][3]"></td></tr>';
    echo  '<tr><td><input value='.$_POST['HN'].' id=d-'.$c.'-4 type="hidden" name="D['.$c.'][4]"></td></tr>';
    echo  '<tr><td><input value='.$_POST['HN'].' id=d-'.$c.'-5 type="hidden" name="D['.$c.'][5]"></td></tr>';
	echo  '<tr id=d-'.$c.'-6><p><td style="text-align:left;" valign="top"><label>ชื่อยา</label></td><td><input required type="text" class="form-control" name="D['.$c.'][6]" maxlength="100" placeholder="กรอกชื่อยา"></p></p></td></tr>'
		 .'<tr id=d-'.$c.'-7><p><td style="text-align:left;" valign="top"><label>ปริมาณ</label></td><td><input required type="text" class="form-control" name="D['.$c.'][7]" size="100" maxlength="20" placeholder="กรอกปริมาณยา"></p></td></tr>'
		 .'<tr id=d-'.$c.'-8><p><td style="text-align:left;" valign="top"><label>วิธีใช้</label></td><td><textarea required type="input" row="2" column="50" class="form-control" name="D['.$c.'][8]" maxlength="1000" placeholder="กรอกวิธีใช้ยา">'.$drug['description'].'</textarea></p></td>'
		 .'<td><button type="button" id=d-'.$c.' class="btn">ลบ</button></td></tr>';
	


	$conn->close();
?>