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
		<h2>MY FRIENDS</h2>
		<img src="<?php echo $_SESSION['userPic']; ?>" alt="User profile image"></img>
		<p><?php echo $_SESSION['userFullName']; ?>&nbsp;&nbsp;</p>
		</div>	
		<div id="topright">
		<button class="bigbutton" id="add_btn" onkeydown="friendBtnAdd(event,<?php echo $_GET['userID']; ?>)" onclick="friendBtnAdd(event,<?php echo $_GET['userID']; ?>)">Add Friends</button>
	
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
				<?php require "php/load_my_friends.php";?>
			</table>
		</div>	
	</div>

		<!-- The Regular Login Modal for Regular Users -->
		<div id="remove_popup" class="modal">
		  <span onclick="document.getElementById('remove_popup').style.display='none'" 
		class="close" title="Close Modal">&times;</span>

		  <!-- Modal Content -->
		  <form class="modal-content animate" id="remove_form" action="#" method="post">
 		    <div class="imgcontainer">
		      <img src="img/profile-placeholder.png" id="student_avatar" alt="Avatar" class="avatar">
		    
 				</div> 

		    <div class="container">
		      <label><b id="remove_username">Are you sure you want to remove ... </b></label>
		    </div>

		    <div class="container" style="background-color:#f1f1f1">
		      <button class="button" id="remove_confirm" onkeydown="removeFriendConfirm(event)" type="reset" name="studentLoginBtn">Remove</button>
		      <button class="button" id="remove_cancel" onkeydown="removeFriendCancel(event)" type="reset">Cancel</button>
		    </div>
		  </form>
		</div>

	</section>
	</body>

		<div id="friendNavigationButtons">
			<button class="button" id="previous_btn" onkeydown="friendBtnPrevious(event)" onclick="friendBtnPrevious(event)">Previous</button>
			<button class="button" id="next_btn" autofocus onkeydown="friendBtnNext(event)" onclick="friendBtnNext(event)">Next</button>
			<button class="bigbutton" id="select_btn" onkeydown="friendBtnSelect(event)" onclick="friendBtnSelect(event)">Remove Friend</button>
		</div>	

</html>