<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';

	$tempName = "John";
	$tempLastName = "Doe";

	$query = "SELECT * FROM users WHERE firstName=? AND lastName=?";
	$queryStmt = $conn->prepare($query);
	$queryStmt->execute(array($tempName, $tempLastName));

	$row = $queryStmt->fetch(PDO::FETCH_ASSOC);		// fetch data

	$_SESSION['adminLoggedIn'] = $row['firstName'] . ' ' . $row['lastName'];
	$_SESSION['adminPicture'] = $row['profilePicture'];
	$conn = null;

 ?>
<!--
QUT Capstone Project 2018
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Jerusha Kolapudi
Author: Jessica Simpkins
Author: Laine Buraga
Author: Woong Adrian Jekal	
-->

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/friends.css">
	<script src="js/jquery-3.2.1.js"></script>	
	<script src="js/friends.js" type="text/javascript"></script>
	<title>FRIENDS</title>
</head>
<body class="wrapper">
	<header>
		<div id="topleft">
	<button class="button" id="back_btn" onclick="window.history.back()" onkeydown="friendBtnBack(event)">Back</button>
	</div>
	
		<div id="user_profile">
		<h2>ADD NEW FRIENDS</h2>
		<img src="<?php echo $_SESSION['userPic']; ?>" alt="User profile image"></img>
		<p><?php echo $_SESSION['userFullName']; ?>&nbsp;&nbsp;</p>
		</div>	
		<div id="topright">
		<button class="bigbutton" id="add_btn" onkeydown="friendBtnAdd(event,<?php echo $_GET['userID']; ?>)" onclick="friendBtnAdd(event,<?php echo $_GET['userID']; ?>)">My Friends</button>
	
		</div>

	
	</header>

	<section>


	<div id="tableDiv">
	<div id="searchDiv">
	<button id="search_btn" class="button" onclick="admin_search(event)">Search</button>
	<input type="text" id="searchBar" onkeyup="filter(event)" placeholder="Search for names..">
	</div>	

		<div id="scollDiv">
			<table id="userNameTable">
				<?php require "php/load_non_friends.php";?>
			</table>
		</div>	
	</div>


	</section>
	</body>

		<div id="friendNavigationButtons">
			<button class="button" id="previous_btn" onkeydown="friendBtnPrevious(event)" onclick="friendBtnPrevious(event)">Previous</button>
			<button class="button" id="next_btn" autofocus onkeydown="friendBtnNext(event)" onclick="friendBtnNext(event)">Next</button>
			<button class="bigbutton" id="select_btn" onkeydown="friendBtnSelect(event)" onclick="friendBtnSelect(event)">Add Friend</button>
		</div>	

</html>