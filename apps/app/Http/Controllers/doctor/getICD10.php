<?php 

	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');

	$diseases = $conn->query("SELECT ICD10,Disease FROM icd10_disease");
	
	if(strlen($_POST['searchICD10'])>=2)
	   	while($disease = $diseases->fetch_assoc()) 
	    {
	    	if(strpos($disease['Disease'] , $_POST['searchICD10'] ) != NULL)
	    	{
	    		echo $disease['ICD10']." ".$disease['Disease'].PHP_EOL;
	    	}
	    }
 

	$conn->close();
?>