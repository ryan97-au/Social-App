<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';
	require 'php/logout.php';

	if (!isset($_SESSION['adminFullName'])) {
		header("location: index.php");
		exit();
	}

	$_SESSION['adminLoggedIn'] = $_SESSION['adminFullName'];
	$_SESSION['adminPicture'] = $_SESSION['adminPic'];

 ?>
<!--
QUT Capstone Project 2017
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Robert Piper
Author: Heath Mayocchi
Author: Levinard Hugo
Author: David Mackenzie	
-->
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/admin_home.css">
	<script src="js/user_home.js" type="text/javascript"></script>
	<title>SNAP ADMIN HOME</title>
</head>
<body class="adminwrapper">
	<header>
	<form method="POST" action="admin_home.php">
		<button class="button" id="logout_btn" onkeyup="logout(event)" type="submit" name="adminLogout">LOGOUT</button>
	</form>
	
	<div id="user_profile">
		<img src="<?php echo $_SESSION['adminPicture']; ?>" alt="User profile image"></img>
		<p><?php echo $_SESSION['adminLoggedIn']; ?></p>
	</div>
	<h2>ADMIN HOME</h2>
	</header>
	<section>
	<button class="button btnsquare" id="manage_users_btn" onclick="location.href='admin_user_management.php';"><div id="view_feed_text">MANAGE<br>USERS</div></button>
	<button class="button btnsquare" id="manage_pictures_btn" onclick="location.href='admin_feed_management.php';"><div id ="messages_text">MANAGE</div><div id ="messages_text">FEED</div></button>
	<!-- <button class="button btnsquare" id="manage_pictures_btn" onclick="location.href='admin_picture_management.php';"><div id ="messages_text">MANAGE</div><div id ="messages_text">PICTURES</div></button> -->
	<button class="button btnsquare" id="view_snap_btn" onclick="location.href='user_home.php';"><div id ="friends_text">VIEW</div><div id ="messages_text">SNAP</div></button>
	</section>
	</body>
</html>