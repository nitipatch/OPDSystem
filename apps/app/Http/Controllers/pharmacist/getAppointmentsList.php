<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	$appointments = $conn->query("SELECT HN,doctorEmpID,appointmentDate,morning,symptomOrReason,addScreeningRecordTime,addMedicalRecordTime,prescribedTime,dispensedTime,pharmacistEmpID FROM appointments");
	
	echo '<tr><td colspan=8 height="35" align="center">เลือกรายการสั่งยาที่ท่านต้องการดำเนินการจ่ายยา</td></tr>';
	echo '<tr><td align="center" height="25">ผู้ป่วย</td><td align="center" height="25">แพทย์</td><td align="center" height="25">วันพบแพทย์</td><td align="center" height="25">ช่วง</td>';
	echo '<td align="center" height="25">เวลาบันทึกการตรวจคัดกรอง</td><td align="center" height="25">เวลาบันทึกการรักษา</td><td align="center" height="25">เวลาสั่งยา</td><td></td></tr>';
	$i = 0;
	while($appointment = $appointments->fetch_assoc()) 
	{
		if(strcmp($appointment['pharmacistEmpID'],$_POST['pharmacistEmpID'])==0 && !isset($appointment['dispensedTime']))
		{
	    	$i++;
			$D[1] = $appointment['HN'];
			$D[2] = $appointment['doctorEmpID'];
			$D[3] = $appointment['appointmentDate'];
			$D[4] = $appointment['morning'];
			$D[5] = $appointment['addScreeningRecordTime'];
			$D[6] = $appointment['addMedicalRecordTime'];
			$D[7] = $appointment['prescribedTime'];
			$morning="เช้า";if($D[4]==1)$morning="บ่าย";
			
			echo  '<tr><td align="center" height="25" id='.$i.'-1>'.$D[1]
				.'</td><td align="center" height="25" id='.$i.'-2>'.$D[2]
				.'</td><td align="center" height="25" id='.$i.'-3>'.$D[3]
				.'</td><td align="center" height="25" id='.$i.'-4>'.$morning
				.'</td><td align="center" height="25" id='.$i.'-5>'.$D[5]
				.'</td><td align="center" height="25" id='.$i.'-6>'.$D[6]
				.'</td><td align="center" height="25" id='.$i.'-7>'.$D[7]
				.'</td><td align="center" height="25"><button type="button" id='.$i.' class="btn btn-primary" style="width:100%">จ่ายยา</button></td></tr>';
		}
	}

?>