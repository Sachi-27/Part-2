<?php 

	//connect to database
	$conn = mysqli_connect('localhost','Sachi','test1234',"SIMS"); 

	//check connection
	if(!$conn){
		echo "Connection error: ". mysqli_connect_error();
	}

?>