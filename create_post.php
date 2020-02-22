<?php 
	ob_start();
	session_start();
	require 'php/pdoconnectOnline.inc';

	if (!isset($_SESSION['userID'])) {
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
	<title>SNAP CREATE A POST</title>
	<!--	CSS	-->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/postPreview.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

</head>
<body class="wrapper">
	<!--
	<div id="errorMSG">
		Please Enter a comment.
	</div>	-->

	<header>
        <button class="button" id="post_back_btn" onclick="backBtn()" onkeydown="postBtnBack(event)" tabindex="1">BACK</button>
        <div id="user_profile">
            <img src="<?php echo $_SESSION['userPic'] ?>" alt="User profile image"></img>
            <p><?php echo $_SESSION['userFullName']; ?></p>
        </div>
        <h2>CREATE A POST</h2>
    </header>

	<div id="mainBox" tabindex="-1">
		<div id="boxBackground">
			<img src="#" id="selectedPicture" alt="No picture selected">
			<div class="modal hideModal">
				<?php include "php/post_images.php" ?>
				<button id="cancelPicButton">Cancel</button>
				<button id="selectPicButton">Select</button>
			</div>
			<form action="php/savePost.php" id="postSubmit" method="POST" enctype="multipart/form-data">
				<textarea id="postComment" name="userPostContent" placeholder="Add a picture or text to create a post!" class="textBig"></textarea>

				<!--This one is for sending pre-uploaded pictures *DON'T TOUCH*	-->
				<input id="picM" type="hidden" name="pic">

				<!-- This one is for sending the uploadURL *DON'T TOUCH*	-->
				<input type="text" name="uploadURL" id="hiddenUploadURL">

				<!-- This is the upload button at the bottom, it's inside the form instead of outside because it's too complicated to program in IE11	-->
				<input type="file" name="uploadLocal" id="uploadLocal" class="uploadVisibility">

				<!--	Submit which is hidden, it will be triggered when the submit button is clicked 	-->
				<input type="submit" name="post" id="hiddenSubmit">
			</form>

			<div class="boxUserPost">
				<img src="<?php echo $_SESSION['userPic']; ?>" id="boxUserImage">
				<div id="boxDate">
					<?php echo $_SESSION['userFullName'] . "  " . date("d-m-Y"); ?>
				</div>
			</div>

		</div>
	</div>

	<div class="upload uploadVisibility">
		Insert URL to Upload Pictures or Videos<br>
		<input type="text" class="uploadURL" placeholder="http://" id="uploadURL"><br>
		<div id="uploadLocalTitle">Upload Pictures or Videos Locally</div>
	</div>


		<div id="postButtons">
			<button class="button" id="postCommentButton" onkeydown="postCommentButton(event)" tabindex="2" name="postloop">Comment</button>
			<button class="button" id="pictureBtn" onkeydown="postpictureButton(event)" tabindex="3" name="postloop">Picture</button>
			<button class="button" id="reactButtonPost" onkeydown="postSubmitButton(event)" tabindex="4" name="postloop">Submit</button>
        </div>
        
        <script>
         
         document.getElementById("pictureBtn").focus();
         document.getElementById("user_home_btn").blur();
        
        </script>


</body>
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="js/postPreview.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</html>