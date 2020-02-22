<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';
	require 'php/login_handler.php';
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
	<link rel="stylesheet" type="text/css" href="css/user_home.css">	
	<link rel="stylesheet" type="text/css" href="css/user_login.css">
    <script src="js/user_login.js" type="text/javascript"></script>
	<title>SNAP SELECT USER</title>
</head>
<body class="wrapper">
	<header>
	<button class="button" id="back_btn" name="looped" onclick="window.history.back()" onkeydown="loginBtnBack(event)">Back</button>

	<h2>SELECT USER</h2>
	</header>
	<section>


	<div id="tableDiv">
	<div id="searchDiv">
	<button id="search_btn" class="button" onclick="admin_search(event)">Search</button>
	<input type="text" id="searchBar" onkeyup="filter(event)" placeholder="Search for names..">
	</div>	

		<div id="scollDiv">
			<table id="userNameTable">
				<?php require "php/load_users.php";?>
			</table>
		</div>	
	</div>






		<!-- The Regular Login Modal for Regular Users -->
		<div id="student_popup" class="modal">
		  <span onclick="document.getElementById('student_popup').style.display='none'" 
		class="close" title="Close Modal">&times;</span>

		  <!-- Modal Content -->
		  <form class="modal-content animate" id="student_form" action="#" method="post">
<!-- 		    <div class="imgcontainer">
		      <img src="img/profile-placeholder.png" id="student_avatar" alt="Avatar" class="avatar">
		    
 				</div> -->

		    <div class="container">
		      <label><b id="student_username">Log in as </b></label>
		    </div>

		    <div class="container" style="background-color:#f1f1f1">
		      <button class="button" id="student_login" onkeyup="loginBtnStudentLogin(event)" type="submit" name="studentLoginBtn">Login</button>
		      <button class="button" id="student_cancel" onkeyup="loginBtnStudentCancel(event)" onclick="loginClickStudentCancel()" name="studentLoginBtn">Cancel</button>
		    </div>
		  </form>
		</div>

		<!-- The Password Entry Modal for Admin Users -->
		<div id="admin_popup" class="modal">
		  <span onclick="document.getElementById('admin_popup').style.display='none'" 
		class="close" title="Close Modal">&times;</span>

		  <!-- Modal Content -->
		  <form class="modal-content animate" id="admin_form" action="#" method="post">
<!-- 		    <div class="imgcontainer">
		      <img src="img/profile-placeholder.png" id="admin_avatar" alt="Avatar" class="avatar">
		    
 				</div> -->

		    <div class="container">

		      <label><b id="admin_username">Please enter the password for </b></label>
		      <input type="password" id="admin_password" placeholder="Enter Password" name="psw" required>

		    </div>

		    <div class="container" style="background-color:#f1f1f1">
		      <button class="button" id="admin_login" onkeydown="loginBtnAdminLogin(event)" type="submit" name="adminLoginBtn">Login</button>
		      <button class="button" id="admin_cancel" onkeydown="loginBtnAdminCancel(event)" onclick="loginClickStudentCancel()">Cancel</button>
		    </div>
		  </form>
		</div>



	</section>
	</body>

		<div id="loginNavigationButtons">
			<button class="button" id="previous_btn" name="looped" onkeydown="loginBtnPrevious(event)" onclick="loginClickPrevious()">Previous</button>
			<button class="button" id="next_btn" name="looped" autofocus onkeydown="loginBtnNext(event)" onclick="loginClickNext()">Next</button>
			<button class="button" id="select_btn" name="looped" onkeydown="loginBtnSelect(event)" onclick="loginClickSelect()">Choose</button>
		</div>	

</html>