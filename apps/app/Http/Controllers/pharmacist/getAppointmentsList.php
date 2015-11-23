<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	$appointments = $conn->query("SELECT HN,doctorEmpID,appointmentDate,morning,symptomOrReason,addMedicalRecordTime,prescribedTime,dispensedTime,pharmacistEmpID FROM appointments");
	
	echo '<tr><td colspan=6 height="35" align="center">เลือกรายการสั่งยาที่ท่านต้องการดำเนินการจ่ายยา</td></tr>';
	echo '<tr><td height="25">ผู้ป่วย</td><td height="25">แพทย์</td><td height="25">วันพบแพทย์</td><td height="25">เวลาสั่งยา</td><td height="25">เวลาบันทึกการรักษา</td><td></td></tr>';
	$i = 0;
	while($appointment = $appointments->fetch_assoc()) 
	{
		if(strcmp($appointment['pharmacistEmpID'],$_POST['pharmacistEmpID'])==0 && !isset($appointment['dispensedTime']))
		{
	    	$i++;
			$D[1] = $appointment['HN'];
			$D[2] = $appointment['doctorEmpID'];
			$D[3] = $appointment['appointmentDate'];
			$D[4] = $appointment['prescribedTime'];
			$D[5] = $appointment['addMedicalRecordTime'];
			echo  
				'<tr><td height="25" id='.$i.'-1>'.$D[1]
				.'</td><td height="25" id='.$i.'-2>'.$D[2]
				.'</td><td height="25" id='.$i.'-3>'.$D[3]
				.'</td><td height="25" id='.$i.'-4>'.$D[4]
				.'</td><td height="25" id='.$i.'-5>'.$D[5]
				.'</td><td height="25"><button type="button" id='.$i.' class="btn btn-primary" style="width:100%">จ่ายยา</button></td></tr>';
		}
	}

?>