<?php 

	

	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	// echo "...";
	$diseases = $conn->query("SELECT ICD10,Disease FROM icd10_disease");
	    //$ = 0;
	    while($disease = $diseases->fetch_assoc()) 
	    {
	    	if(strpos($disease['Disease'] , $_POST['searchICD100'] ) > 0 && strlen($_POST['searchICD100']))
	    	{
	    		//if(++$c>1) echo ", ";
	    		echo $disease['Disease'];

	    	}
	    }
 

	$conn->close();
?>