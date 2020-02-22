<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';
	require 'php/adminUserManagement_backend.php';
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
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/admin_user_management.css">
	<script src="js/jquery-3.2.1.js"></script>
	<title>SNAP USER MANAGEMENT</title>
</head>
<body class="wrapper">
	<header>
		<button id="back_btn2" onclick="window.location='admin_home.php';">BACK</button>
		<div id="user_profile">
			<img src="<?php echo $_SESSION['adminPicture']; ?>" alt="User profile image"></img>
			<p><?php echo $_SESSION['adminLoggedIn']; ?></p>
		</div>
		<h2>USER MANAGEMENT</h2>
	</header>

	<section>
		<div id="editingBody">
			<div class="midBody">
				<p>To edit an existing user, search by first or last name, then hit 'Load User'</p>

				<!--	This is the picture on the side of the left side of the search form when a user is selected from the search	-->
					<div id="editUserPicture"></div>
				<!--	This is the picture on the side of the left side of the search form when a user is selected from the search	-->

				<form action="#" method="POST">
					<label for="editUserForm" id="editUserFormPosition">Edit User:</label>
					<input id="editUserForm" class="onlyForEditUser" type="text" placeholder="Search ... " name="search">
					<button class="adminButtons" id="searchButton" name="searchButton">Search</button>
					<button class="adminButtons" id="loadUserButton" type="button" name="loadUser" >Load User</button>
				</form>

				<!--	DIV that shows search results	-->
				<div id="searchResults">
					<?php 
						if (isset($_POST['searchButton'])) {
							$searchq = $_POST['search'];

							$query = $conn->prepare("SELECT * FROM users WHERE concat(firstName, ' ', lastName) LIKE concat('%', :name, '%') OR lastName LIKE concat('%', :name, '%') LIMIT 20");
							$query->execute(array(':name'=>$searchq));
							$queryNum= $query->fetchColumn();

							if ($queryNum <= 0) {
								echo "No Results Found";
								echo "<style type='text/css'>
										#searchResults {
											display: block;
											height: 20px;
											color: red;
										}
									  </style>";	
							} else {
								$query = $conn->prepare("SELECT * FROM users WHERE concat(firstName, ' ', lastName) LIKE concat('%', :name, '%') OR lastName LIKE concat('%', :name, '%') LIMIT 20");
								$query->execute(array(':name'=>$searchq));

								while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
									$name = $row['firstName'];
									$lastName = $row['lastName'];
									$accT = $row['accountType'];
									//$picture = $row['profilePicture'];
									$dob = $row['DOB'];
									$usrID = $row['userID'];
									echo "<div class='userResults'>";
									echo $usrID . " ";
									//echo "<img src='" . $picture . "' class='smallPic'>" . "  ";
									echo $name . " " . $lastName . " ". $dob . " " . $accT . "<br><br>";
									echo "</div>";	
								}
								echo "<style type='text/css'>
										#searchResults {
											display: block;
										}
									  </style>";	
								}
							}
					 ?>
				</div>

				<p>To add a new user, fill in the below fields and hit 'Save User'</p>
				<div id="showUser">
					<form action="#" id="showUserForm" method="POST" enctype="multipart/form-data" name="registerUser" onsubmit="return validate()">
						<!--	First name label and form	-->
						<label for="firstNameForm" id="firstNameFormPosition">First name:</label>
						<input id="firstNameForm" class="formSize" type="text" placeholder="First name ... " name="firstName">
						<div id="firstNameError"></div>

						<!--	Last name label and form	-->
						<br><br>
						<label for="lastNameForm" id="lastNameFormPosition">Last name:</label>
						<input id="lastNameForm" class="formSize" type="text" placeholder="Last name ... " name="lastName">
						<div id="lastNameError"></div>

						<!--	Date label and form	-->
						<br><br>
						<label for="dateForm" id="dateFormPosition">DOB:</label>
						<input id="dateForm" class="formSize" type="text" placeholder="DD-MM-YYYY" name="dob">
						<div id="dobError"></div>

						<!--	Admin Checkbox label and form	-->
						<br>
						<p>Check the below box to create an Admin user</p>
						<label for="aCheckBox" id="checkBoxPosition">Admin:</label>
						<input id="aCheckBox" type="checkbox" value="Admin" name="checkBox">
						
						<!--	Password label and form	-->
						<p id="password_text">A password is required for an Admin user</p>
						<label for="password" id="passwordPosition">Password:</label>
						<input id="password" class="formSize" type="password" placeholder="Password ..." name="password">
						<div id="passwordError1"></div>

						<!--	Confirm password label and form	-->
						<br><br>
						<label for="password" id="confirmPasswordPosition">Confirm Password:</label>
						<input id="confirmPassword" class="formSize" type="password" placeholder="Confirm Password ..." name="confirmPassword">
						<div id="passwordError"></div>

						<!--	This is the stuff on the side (Picture, label, file upload)	-->
						<img src="img/profile-placeholder.png" id="pictureForUpload" alt="Profile Pic">
						<label id="labelForBrowse">Profile Image:</label>
						<label for="uploadPicture" id="chooseAFile">&nbsp;<i class="fa fa-upload" aria-hidden="true"></i> &nbsp;Choose a file...</label>
						<input type="file" name="file" id="uploadPicture">
						<span id="fileTypeError"></span>

						<input type="submit" name="adminCreateNewUser" id="registerHiddenSubmitButton">
					</form>
				</div>
			</div>

			<!--	This is the button at the very bottom of the page, and it will be the one that triggers the button inside the register user	-->
			<button id="saveUser" class="adminButtons">Save User</button>
			<div id="createUserReport"><?php 
				if (in_array('Created a user successfully', $error)) {
					echo "<style type='text/css'>
							#createUserReport {
								visibility: visible;
							}
						  </style>
					";
					echo 'Created a user successfully';
				} 

			 ?></div>
			<div id="createUserReportError">
				<div id="errorMessage"><?php 
					if (in_array("User is already registered!", $error)) {
						echo "User is already registered!";
						echo "<style type='text/css'>
								#createUserReportError {
									visibility: visible;
								}
							   </style>";
					} else if (in_array('You cannot upload files of this type', $error)) {
						echo 'You cannot upload files of this type';
						"<style type='text/css'>
								#createUserReportError {
									visibility: visible;
								}
							   </style>";

					} else if (in_array('There was an error uploading your file!', $error)) {
						echo 'There was an error uploading your file!';
						echo "<style type='text/css'>
								#createUserReportError {
									visibility: visible;
								}
							   </style>";
					} else if (in_array('File was too big!', $error)) {
						echo 'File was too big!';
						echo "<style type='text/css'>
								#createUserReportError {
									visibility: visible;
								}
							   </style>";
					}
				 ?></div>
			</div>


			<p>Manage friends for existing users</p>
			<div id="friendList">
				<button  id="add_friend_btn">Add Friend</button>
				<button  id="remove_friend_btn">Remove Friend</button>
				<div id="friendListInnerDiv">
				<table>
					<!--	This is done using ajax	-->
				</table>
				</div>
			</div>
		</div>
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>	<!--	jQuery	-->
	<script type="text/javascript" src="js/adminUserManagement.js"></script>
	
</body>
</html>
