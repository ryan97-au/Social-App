<?php
	// Connect to the database
	include 'pdoconnectOnline.inc';
	
	if($_GET['letter_group'] == 'ABC')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('A','B','C') OR LEFT(firstName,1) IN ('A','B','C') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'DEF')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('D','E','F') OR LEFT(firstName,1) IN ('D','E','F') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'GHI')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('G','H','I') OR LEFT(firstName,1) IN ('G','H','I') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'JKL')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('J','K','L') OR LEFT(firstName,1) IN ('J','K','L') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'MNO')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('M','N','O') OR LEFT(firstName,1) IN ('M','N','O') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'PQRS')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('P','Q','R','S') OR LEFT(firstName,1) IN ('P','Q','R','S') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'TUV')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('T','U','V') OR LEFT(firstName,1) IN ('T','U','V') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == 'WXYZ')
	{
		$sql = "SELECT * FROM users 
		WHERE LEFT(lastName,1) IN ('W','X','Y','Z') OR LEFT(firstName,1) IN ('W','X','Y','Z') ORDER BY firstName, lastName";
	}
	if($_GET['letter_group'] == '' || $_GET['letter_group'] == 'all')
	{
		$sql = "SELECT * FROM users ORDER BY firstName, lastName";
	}
	    $stmt = $conn->prepare($sql); 
    $stmt->execute();
	
	// Fill a 2d array with post information
	while ($row = $stmt->fetch())
	{
		$name = $row['firstName'] . " " . $row['lastName'];
		$img = $row['profilePicture'];
		$id = $row['userID'];

		if($row['accountType'] == 'Student')
		{
		 echo "<tr onclick=\"student_popup('$name','$img', '$id')\">";
		}
		else
		{
		 echo "<tr onclick=\"admin_popup('$name','$img', '$id')\">";
		}

		
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