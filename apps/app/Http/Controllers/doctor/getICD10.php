<?php 

	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');

	$diseases = $conn->query("SELECT ICD10,Disease FROM icd10_disease");
	
	if(strlen($_POST['searchICD10'])>=3)
	   	while($disease = $diseases->fetch_assoc()) 
	    {
	    	if(strpos(strtolower(".".$disease['Disease']) , strtolower($_POST['searchICD10']) ) >= 1)
	    	{
	    		echo $disease['ICD10']." ".$disease['Disease'].PHP_EOL;
	    	}
	    }
 

	$conn->close();
?>