<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	$appointments = $conn->query("SELECT HN,doctorEmpID,appointmentDate,morning,symptomOrReason,addScreeningRecordTime,addMedicalRecordTime,prescribedTime,dispensedTime,dispensedStatus,comment,pharmacistEmpID FROM appointments");
	
	echo '<tr><td colspan=8 height="35" align="center">เลือกรายการนัดที่ท่านต้องการดำเนินการบันทึกการรักษาและสั่งยา</td></tr>';
	echo '<tr><td align="center" height="25">ผู้ป่วย</td><td align="center" height="25">วันพบแพทย์</td><td align="center" height="25">ช่วง</td>';
	echo '<td align="center" height="25">เวลาบันทึกการตรวจคัดกรอง</td><td align="center" height="25">เวลาบันทึกการรักษา</td><td align="center" height="25">เวลาสั่งยา</td><td align="center" height="25">เวลาขอรายการยาใหม่</td><td></td></tr>';
	$i = 0;
	while($appointment = $appointments->fetch_assoc()) 
	{
		if(strcmp($appointment['doctorEmpID'],$_POST['doctorEmpID'])==0 && $appointment['dispensedStatus']==1)
		{
	    	$i++;
			$D[1] = $appointment['HN'];
			$D[2] = $appointment['appointmentDate'];
			$D[3] = $appointment['morning'];
			$D[4] = $appointment['addScreeningRecordTime'];
			$D[5] = $appointment['addMedicalRecordTime'];
			$D[6] = $appointment['prescribedTime'];
			$D[7] = $appointment['dispensedTime'];
			$D[8] = $appointment['comment'];
			$morning="เช้า";if($D[3]==1)$morning="บ่าย";
			
			echo '<td style="display:none" id='.$i.'-8>'.$D[8].'</td>';
			echo  '<tr><td align="center" height="25" id='.$i.'-1>'.$D[1]
				.'</td><td align="center" height="25" id='.$i.'-2>'.$D[2]
				.'</td><td align="center" height="25" id='.$i.'-3>'.$morning
				.'</td><td align="center" height="25" id='.$i.'-4>'.$D[4]
				.'</td><td align="center" height="25" id='.$i.'-5>'.$D[5]
				.'</td><td align="center" height="25" id='.$i.'-6>'.$D[6]
				.'</td><td align="center" height="25" id='.$i.'-7>'.$D[7]
				.'</td><td align="center" height="25"><button type="button" id='.$i.' class="btn btn-primary" style="width:100%">สั่งยาใหม่</button></td></tr>';
		}
	}

?>