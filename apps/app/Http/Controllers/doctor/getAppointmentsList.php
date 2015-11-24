<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	$appointments = $conn->query("SELECT HN,doctorEmpID,appointmentDate,morning,symptomOrReason,addScreeningRecordTime,addMedicalRecordTime,prescribedTime,dispensedTime,pharmacistEmpID FROM appointments");
	
	echo '<tr><td colspan=5 height="35" align="center">เลือกรายการนัดที่ท่านต้องการดำเนินการบันทึกการรักษาและสั่งยา</td></tr>';
	echo '<tr><td align="center" height="25">ผู้ป่วย</td><td align="center" height="25">วันพบแพทย์</td><td align="center" height="25">ช่วง</td>';
	echo '<td align="center" height="25">เวลาบันทึกการตรวจคัดกรอง</td><td></td></tr>';
	$i = 0;
	while($appointment = $appointments->fetch_assoc()) 
	{
		if(strcmp($appointment['doctorEmpID'],$_POST['doctorEmpID'])==0 && isset($appointment['addScreeningRecordTime']) && !isset($appointment['addMedicalRecordTime']))
		{
	    	$i++;
			$D[1] = $appointment['HN'];
			$D[2] = $appointment['appointmentDate'];
			$D[3] = $appointment['morning'];
			$D[4] = $appointment['addScreeningRecordTime'];
			$morning="เช้า";if($D[3]==1)$morning="บ่าย";
			
			echo  '<tr><td align="center" height="25" id='.$i.'-1>'.$D[1]
				.'</td><td align="center" height="25" id='.$i.'-2>'.$D[2]
				.'</td><td align="center" height="25" id='.$i.'-3>'.$morning
				.'</td><td align="center" height="25" id='.$i.'-4>'.$D[4]
				.'</td><td align="center" height="25"><button type="button" id='.$i.' class="btn btn-primary" style="width:100%">รักษา</button></td></tr>';
		}
	}

?>