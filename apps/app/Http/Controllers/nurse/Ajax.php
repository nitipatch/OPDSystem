<?php
	$conn = new mysqli("localhost","root","","testdatabase");
	$conn->set_charset('utf8');
	
	$drugs = $conn->query("SELECT HN,allergicDrug FROM HN_allergicDrug");
	    $c = 0;
	    while($drug = $drugs->fetch_assoc()) 
	    {
	    	if(strcmp($drug['HN'] , $_POST['HN'])==0)
	    	{	    		
	    		if(++$c>1) echo ", ";
	    		echo $drug['allergicDrug'];
	    	}
	    }
 

	$conn->close();
?>