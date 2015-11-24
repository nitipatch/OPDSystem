<?php 
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	// echo "...";
	$diseases = $conn->query("SELECT ICD10,Disease FROM icd10_disease");
	    //$ = 0;
	    while($disease = $diseases->fetch_assoc()) 
	    {
	    	echo $disease['Disease']." \"".strpos($disease['Disease'] , $_POST['searchICD10'] )." \"".PHP_EOL;
	    	// if(strlen($_POST['searchICD10']) >= 3 
	    	// 	&& strpos($disease['Disease'] , $_POST['searchICD10'] ) !== NULL)
	    	// {
	    	// 	echo $disease['Disease'].PHP_EOL;
	    	// }
	    }
 

	$conn->close();
?>