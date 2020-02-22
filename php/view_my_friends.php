<?php

	// Connect to the database
	include 'pdoconnectOnline.inc';

	$tempVar = $_GET['userID'];

	$sql = "SELECT * FROM users WHERE userID IN
	(SELECT userTwoID from relationships WHERE relation = 'Friends' AND userOneID = ?) ORDER BY users.firstName";
	$stmt = $conn->prepare($sql); 
  $stmt->execute(array($tempVar));

	// Fill a 2d array with post information
	while ($row = $stmt->fetch()) {
		$name = $row['firstName'] . " " . $row['lastName'];
		$img = $row['profilePicture'];
		$userOne = $_GET['userID'];
		$userTwo = $row['userID'];

		echo "<tr>";

		echo "<td width=65px>";
		echo '<img src="';
		echo $row['profilePicture'];
		echo '" class="userPic">';
		echo "</td>";

		echo '<td class="rowName">  ';
		echo $name;
		echo "</td>";
		
		echo "</tr>";
	}	
	echo "<tr>";

	echo "<td width=65px>";
	echo '<img src="';
	echo "img/profile-placeholder.png";
	echo '" class="userPic">';
	echo "</td>";

	echo '<td class="rowName">  ';
	echo '<a href="new_friends.php?userID='; echo $userOne; echo '">Add some friends...</a>';
	echo "</td>";
	
	echo "</tr>";
	$conn = null;
?>