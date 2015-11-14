<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');

	if(strcmp($_POST['fullname'],"--เลือกแพทย์--")!=0)
	{
		$users = $conn->query("SELECT name,surname,username FROM users");
	    while($user = $users->fetch_assoc()) 
	    {
	    	if(strcmp($user["name"]." ".$user["surname"] , $_POST['fullname'])==0)
	    	{
	    		$ondutySchedule = $conn->query("SELECT doctorEmpID,date,morning,appointed FROM ondutySchedule");
	    		while($Schedule = $ondutySchedule->fetch_assoc()) 
	    		{
	    			if($Schedule['appointed']==0 && strcmp($Schedule['doctorEmpID'],$user['username'])==0)
	    			echo $Schedule['date']." ".$Schedule['morning'].PHP_EOL;
	    		}
	    	}
	    }
    }
    else if(strcmp($_POST['department'],"--เลือกแผนก--")!=0)
	{
		$users = $conn->query("SELECT username,department FROM users");
	    while($user = $users->fetch_assoc()) 
	    {
	    	if(strcmp($user["department"] , $_POST['department'])==0)
	    	{
	    		$ondutySchedule = $conn->query("SELECT doctorEmpID,date,morning,appointed FROM ondutySchedule");
	    		while($Schedule = $ondutySchedule->fetch_assoc()) 
	    		{
	    			if($Schedule['appointed']==0 && strcmp($Schedule['doctorEmpID'],$user['username'])==0)
	    			echo $Schedule['date']." ".$Schedule['morning'].PHP_EOL;
	    		}
	    	}
	    }
    }

	$conn->close();
?>