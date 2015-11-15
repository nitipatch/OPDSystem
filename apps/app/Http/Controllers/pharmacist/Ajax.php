<?php
	use Illuminate\Support\Facades\Session;
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	
	$i = 0;
	$c = $_POST['count'];
	
	$drugs = $conn->query("SELECT HN,doctorEmpID,date,time,drugName,quantity,description,pharmacistEmpID,checked FROM prescribedDrugs");
	while($drug = $drugs->fetch_assoc()) 
	{
		if(strcmp($drug['pharmacistEmpID'],$_POST['pharmacistEmpID'])==0 && $drug['checked']==0)
		{
	    	$i++;
			$D[$i][1] = $drug['HN'];
			$D[$i][2] = $drug['doctorEmpID'];
			$D[$i][3] = $drug['date'];
			$D[$i][4] = $drug['time'];
			$D[$i][5] = $drug['drugName'];
			$D[$i][6] = $drug['drugName'];
			$D[$i][7] = $drug['quantity'];
			$D[$i][8] = $drug['description'];
		}
	}

	echo '<tr><td><input value='.$D[$c][1].' type="hidden" name="D['.$c.'][1]"></td></tr>'
		 .'<tr><td><input value='.$D[$c][2].' type="hidden" name="D['.$c.'][2]"></td></tr>'
		 .'<tr><td><input value='.$D[$c][3].' type="hidden" name="D['.$c.'][3]"></td></tr>'
		 .'<tr><td><input value='.$D[$c][4].' type="hidden" name="D['.$c.'][4]"></td></tr>'
		 .'<tr><td><input value='.$D[$c][5].' type="hidden" name="D['.$c.'][5]"></td></tr>'
		 .'<tr><td><label></label></td></tr><tr><td><label></label></td><td style="text-align:center;" valign="top"><label>'."ผู้ป่วย: ".$D[$c][1]."_____แพทย์สั่งยา: ".$D[$c][2]."_____วันเวลาสั่งยา: ".$D[$c][3]." ".$D[$c][4].'</label></td></tr>'
		 .'<tr><p><td style="text-align:left;" valign="top"><label>ชื่อยา<font color="red">*</font></label></td><td><input required value='.$D[$c][6].' type="text" class="form-control" name="D['.$c.'][6]" maxlength="100" placeholder="กรอกชื่อยา"></p></p></td></tr>'
		 .'<tr><p><td style="text-align:left;" valign="top"><label>ปริมาณ<font color="red">*</font></label></td><td><input required value='.$D[$c][7].' type="text" class="form-control" name="D['.$c.'][7]" size="100" maxlength="20" placeholder="กรอกปริมาณยา"></p></td></tr>'
		 .'<tr><p><td style="text-align:left;" valign="top"><label>วิธีใช้<font color="red">*</font></label></td><td><textarea required type="input" row="2" column="50" class="form-control" name="D['.$c.'][8]" maxlength="1000" placeholder="กรอกวิธีใช้ยา">'.$D[$c][8].'</textarea></p></td></tr>';
?>