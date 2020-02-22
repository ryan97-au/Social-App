<?php

	// Connect to the database
	include 'pdoconnectOnline.inc';

	$tempVar = $_GET['userID'];

	$sql = "SELECT * FROM users WHERE userID NOT IN
	(SELECT userTwoID from relationships WHERE userOneID = ?) ORDER BY users.firstName";
	$stmt = $conn->prepare($sql); 
  $stmt->execute(array($tempVar));

	// Fill a 2d array with post information
	while ($row = $stmt->fetch())
	{
		$name = $row['firstName'] . " " . $row['lastName'];
		$img = $row['profilePicture'];
		$userOne = $_GET['userID'];
		$userTwo = $row['userID'];
		//$userOne = 1;
		//$userTwo = 3;

	 echo "<tr onclick=\"addFriend('".$userOne."','".$userTwo."')\">";
//	echo "<tr>";

		
		echo "<td width=65px>";
			echo '<img src="img/blankpixel.png';
			echo '" class="checkBoxImage">';
		echo "</td>";

		echo "<td width=65px>";
		echo '<img src="';
		echo $row['profilePicture'];
		echo '" class="userPic">';
		echo "</td>";


		echo '<td class="rowName">  ';
		echo $name;
		echo "</td>";

		echo "<td width=65px>";
		if($row['accountType'] == 'Admin')
		{
			echo '<img src="img\lock.png';
			echo '" class="lockPick">';
		}
		echo "</td>";


		echo "</tr>";
	}
	
	$conn = null;


?>