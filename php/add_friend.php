<?php

	//Inserts users into the database

	include 'pdoconnectOnline.inc';

//	if( isset($_POST['$userOneID']) && isset($_POST['$userTwoID']) )
	{
	// $userOne = '1';
	// $userTwo = '3';
	$userOne = $_POST['userOneID'];
	$userTwo = $_POST['userTwoID'];
	// echo $_POST['name'];

	$query = "INSERT INTO relationships (userOneID, userTwoID, relation) VALUES (".$userOne.",".$userTwo.",'Friends');";

	echo $query;
	//$statement = $conn->prepare("INSERT INTO relationships (userOneID, userTwoID, relation) VALUES (1,2,'Friends');");
	$statement = $conn->prepare($query);

		if($statement->execute()	== true	)
		{
			  echo '<script>';
			  echo 'console.log("successfully added friend");';
			  echo '</script>';		
		}
		else
		{
			  echo '<script>';
			  echo 'console.log("failure to friend");';
			  echo '</script>';		
		}
	}

?>