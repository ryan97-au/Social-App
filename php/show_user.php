<?php 
	// Connect to the database
	include 'pdoconnectOnline.inc';

	if(isset($_POST['userID']))
	{
		$sql = $conn->prepare("SELECT * FROM users WHERE userID=?");
		$sql->execute(array($_POST['userID']));
		$row = $sql->fetch(PDO::FETCH_ASSOC);

		echo '<label for="firstNameForm" id="firstNameFormPosition">First name:</label>
			<input id="firstNameForm" class="formSize" type="text" value="';
		echo $row['firstName'];

		echo '" name="firstName">
			<div id="firstNameError"></div>
			<br><br>
			<label for="lastNameForm" id="lastNameFormPosition">Last name:</label>
			<input id="lastNameForm" class="formSize" type="text" value="';
		echo $row['lastName'];

		echo '" name="lastName">
			<div id="lastNameError"></div>
			<br><br>
			<label for="dateForm" id="dateFormPosition">DOB:</label>
			<input id="dateForm" class="formSize" type="text" value="';
		echo $row['DOB'];
		


	}else
	{


			echo '<label for="firstNameForm" id="firstNameFormPosition">First name:</label>
			<input id="firstNameForm" class="formSize" type="text" placeholder="First name ... " name="firstName">
			<div id="firstNameError"></div>
			<br><br>
			<label for="lastNameForm" id="lastNameFormPosition">Last name:</label>
			<input id="lastNameForm" class="formSize" type="text" placeholder="Last name ... " name="lastName">
			<div id="lastNameError"></div>
			<br><br>
			<label for="dateForm" id="dateFormPosition">DOB:</label>
			<input id="dateForm" class="formSize" type="text" placeholder="DD-MM-YYYY';


	 }

	echo '" name="dob">
	<div id="dobError"></div>
	<br>
	<p>Check the below box to create an Admin user</p>
	<label for="aCheckBox" id="checkBoxPosition">Admin:</label>';

	if($row['accountType']=='Admin')
	{
		echo '<input id="aCheckBox" type="checkbox" checked="checked" value="';
		echo $row['accountType'];
		echo '" name="checkBox" >';
	}
	else
	{
		echo '<input id="aCheckBox" type="checkbox" value="';
		echo $row['accountType'];
		echo '" name="checkBox" >';
	}
	

	echo '<br>
	<p>A password is required for an Admin user</p>
	<label for="password" id="passwordPosition">Password:</label>
	<input id="password" class="formSize" type="password" placeholder="Password ..." name="password">
	<div id="passwordError1"></div>
	<br><br>
	<label for="password" id="confirmPasswordPosition">Confirm Password:</label>
	<input id="confirmPassword" class="formSize" type="password" placeholder="Confirm Password ..." name="confirmPassword">
	<div id="passwordError"></div><img src="';


	if(isset($_POST['userID']))
	{
		// this needs to be changed to a blob.
		// $fileName = $_FILES['file']['name'];

		// $fileNameNew = uniqid('', true) . "." . $fileActualExt;
	 //  $profilePic = "img/" . $fileNameNew;		
		echo $row['profilePicture'];

	}else
	{

		echo 'img/profile-placeholder.png';
	}

	echo '" id="pictureForUpload" alt="Profile Pic">
	<label id="labelForBrowse">Profile Image:</label>
	<label for="uploadPicture" id="chooseAFile">&nbsp;<i class="fa fa-upload" aria-hidden="true"></i> &nbsp;Choose a file...</label>
	<input type="file" name="file" id="uploadPicture">
	<span id="fileTypeError"></span>
	<input type="submit" name="adminCreateNewUser" id="registerHiddenSubmitButton">';
	
?>


