<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';

	// If adminLoggedIn is not set, go to index.php to log in
	if (!isset($_SESSION['adminLoggedIn'])) {
		header("location: index.php");
		exit();
	}
 ?>
<!--
QUT Capstone Project 2017
Project Owner: Nursery Road State Special School

SNAP - Social Networking Action Platform

Author: Robert Piper
Author: Heath Mayocchi
Author: Levinard Hugo
Author: David MacKenzie	
-->

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/admin_feed_management.css">
	<title>SNAP FEED MANAGEMENT</title>
</head>
<body class="wrapper">
	<header>
		<button class="admin_button" id="back_btn2" onclick="window.location='admin_home.php';">BACK</button>
		<div id="user_profile">
			<!-- <img src="<?php echo $_SESSION['adminPicture']; ?>" alt="User profile image"></img>
			<p><?php echo $_SESSION['adminLoggedIn']; ?></p> -->
			<img src="<?php echo $_SESSION['adminPicture'] ?>" alt="User profile image"></img>
			<p><?php echo $_SESSION['adminLoggedIn']; ?></p>
		</div>
		<h2>FEED MANAGEMENT</h2>
	</header>
	
	<section>
	<!-- Filter box -->
		<div id="filter_post">
				<p id="filter_post_title">Search by:<br><br>Username or<br>Keyword</p>
				<input id="user_keyword" type="text" placeholder="Username or Keyword ... " name="user_keyword">
				<p>Date From:</p>
				<!-- type="date" is not supported in Firefox, Internet Explorer 11 and earlier versions -->
				<input id="from_date" type="date" placeholder="DD-MM-YYYY" name="from_date">
				<p>Date To:</p>
				<input id="to_date" type="date" placeholder="DD-MM-YYYY" name="to_date">
				<br><br>
				<button id="filter_post_btn" class="admin_button" name="filter_post_btn">Search</button>
		</div>
	</section>
	
	<aside>
	<!-- Post display -->
		<div id="post_list_header">
			<table id="post_list_header_table">
				<tr>
					<th>From</th><th>Title</th><th>Date</th>	
				</tr>
			</table>
		</div>
		<div id="post_list_box">
			<table id="post_list">	
				<?php 
					$query = $conn->prepare("SELECT posts.postID,posts.postContent, posts.postedBy, posts.postDate, users.userID, users.firstName, users.lastName FROM users, posts WHERE posts.postedBy=users.userID ORDER BY posts.postID DESC");
					$query->execute();
					$rowCount = 1;

					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
						$postID = $row['postID'];
						$name = $row['firstName'] . " " . $row['lastName'];
						$content = $row['postContent'];
						$date = date('d/m/Y', strtotime($row['postDate']));

						echo "<tr id='" . "post_row" . $rowCount . "'>";
						echo "<td><input id='checkbox' type='checkbox' name='box' value='". $postID . "' onclick=\"selected('post_row" . $rowCount . "')\"/></td><td width=150px>". $name . "</td><td width=250px>";
						echo $content . "</td><td width=100px>" . $date . "</td>";
						echo "</tr>";
						$rowCount++;
					}
				 ?>
			</table>
		</div>
		<div id="post_preview">
			<!--	Contents only show when the load button is clicked	-->
		</div>
	</aside>
	
	<footer>
		<button class="load_button" id="load_post" name="load_post" type="button">Load<br>Post</button>
		<button class="delete_button" id="delete_post" name="delete_post" type="button">Delete<br>Post</button>
		<button class="delete_button" id="delete_comment" name="delete_comment" type="button">Delete<br>Comment</button>	
	</footer>
	
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script src="js/feed_management.js" type="text/javascript"></script>
</body>
</html>