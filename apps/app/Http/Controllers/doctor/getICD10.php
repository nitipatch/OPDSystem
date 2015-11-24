<?php 

	

	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	// echo "...";
	$diseases = $conn->query("SELECT ICD10,Disease FROM icd10_disease");
	    //$ = 0;
	    while($disease = $diseases->fetch_assoc()) 
	    {
	    	if(strpos($disease['Disease'] , $_POST['searchICD10'] ) != NULL && strlen($_POST['searchICD10']))
	    	{
	    		//if(++$c>1) echo ", ";
	    		echo $disease['Disease'].PHP_EOL;

	    	}
	    }
 

	$conn->close();
?>