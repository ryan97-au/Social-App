<?php 
	ob_start();
	session_start();
	require 'php/logout.php';

	// If the adminID session is set, change the 3 session variables to be the admin credentials
	// This ensures that the admin is the one loggedin
	// If adminID session is not set (meaning a student is logged in), then the original sessions will not be touched.
	if (isset($_SESSION['adminID'])) {
		$_SESSION['userPic'] = $_SESSION['adminPic'];
		$_SESSION['userID'] = $_SESSION['adminID'];
		$_SESSION['userFullName'] = $_SESSION['adminFullName'];

	// If student userID session is not set, go to index.php to log in
	} else if (!isset($_SESSION['userID'])) {
		header("location: index.php");
		exit();
	}
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
<!-- Include Menu -->
<?php include "./menu.php"; ?>
<!-- Include Menu -->

<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/user_home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <title>SNAP HOME</title>
</head>
<body class="wrapper">
	<header>
        
                
        
	<!-- <form action="user_home.php" method="POST"> -->
		<button class="button" id="logout_btn" onkeyup=logout(event) onclick="window.location.href = 'http://nrsss-snap.atwebpages.com/'" name="looped">LOGOUT</button>
	</form>
	<div id="user_profile">
		<img src="<?php echo $_SESSION['userPic']; ?>" alt="User profile image"></img>
		<p><?php echo $_SESSION['userFullName']; ?>&nbsp;&nbsp;</p>
	</div>
	<h2>HOME</h2>
                <button class="button" id="back_btn" onclick="backBtn()" onkeyup="homeBtnBack(event)" name="looped">BACK</button>
	</header>
	<section>
		<button class="button btnsquare" id="view_feed_btn" onclick="location.href='view_feed.php';" onkeyup="view_feed(event)" name="looped" autofocus>VIEW<br>FEED</button>
		<button class="button btnsquare" id="create_post_btn" onclick="location.href='create_post.php';" onkeyup="create_post(event)" name="looped">CREATE<br>POST</button>
		<button class="button btnsquare" id="friends_btn" onclick="location.href='<?php echo"friends.php?userID="; echo $_SESSION['userID']; ?>';" name="looped" onkeyup="friends(event)">FRIENDS</button>
	</section>
		<script src="js/user_home.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>

</html>