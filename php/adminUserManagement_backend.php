<?php 

	if (!isset($_SESSION['adminLoggedIn'])) {
		header("Location: admin_home.php");
	} 	

	/**********************		BELOW IS FOR CREATING A user 	 *********************************************/
	/*********************************************************************************************************/
	if (isset($_POST['adminCreateNewUser'])) {
		$fName = "";
		$lName = "";
		$dob = "";
		$accType = "Student";
		$pass = "";
		$confPass = "";
		$profilePic = "";
		$error = array();	// error array

		$fName = strip_tags($_POST['firstName']);	// removes html tags i.e. <a>
		//$fName = str_replace(' ', '', $fName);		// removes spaces
		$fName = ucfirst(strtolower($fName));		// turns first letter into capital

		$lName = strip_tags($_POST['lastName']);
		//$lName = str_replace(' ', '', $lName);
		$lName = ucfirst(strtolower(($lName)));

		/************** Inside is the process of turning DD-MM-YYYY into YYYY-MM-DD ***************/
		$dob = strip_tags($_POST['dob']);
		$dob = str_replace(' ', '', $dob);
		$dob = str_replace('/', '-', $dob);		

		$dob = explode('-', $dob, 2);
		$dobDay = $dob[0];

		$dob = strtolower(end($dob));			
		$dob = explode('-', $dob);
		$dobMonth = $dob[0];
		$dobYear = strtolower(end($dob));
		
		$dob = $dobYear . "-" . $dobMonth . "-" . $dobDay;
		/*****************************************************************************************/

		// If checkbox is not checked, meaning it's not an admin account, but a student account
		if (!isset($_POST['checkBox'])) {
			$checkQuery = "SELECT * FROM users WHERE firstName=:fName AND lastName=:lName AND dob=:dob";
	        $checkQueryRes = $conn->prepare($checkQuery);
	        $checkQueryRes->execute(array(":fName"=>$fName, ":lName"=>$lName, ":dob"=>$dob));
	        $checkNum = $checkQueryRes->fetchColumn();

	        // Checks if the user entered is already in the database
	        if ($checkNum > 0) {
	        			$checkQuery = "SELECT * FROM users WHERE firstName=? AND lastName=? AND dob=? AND accountType='Student'";
	        			$checkQueryRes = $conn->prepare($checkQuery);
        				$checkQueryRes->execute(array($fName, $lName, $dob));
        				$row = $checkQueryRes->fetch(PDO::FETCH_ASSOC);	
        				$dataPassword = $row['password'];

        				if (password_verify($pass, $dataPassword)) {
        					array_push($error, "User is already registered!");

        				} else {
        					/********************************************************/
        					/** If the firstname, lastname, dob, and account type are in the database, but the password is not the same, execute below to create the user**/
			        		$pass = password_hash($pass, PASSWORD_DEFAULT);

				        	// If the file upload is emtpy give it a default picture
				        	if (empty($_FILES['file']['name'])) 
				        	{

				        		$profilePic = "img/profile-placeholder.png";
										insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
				        		array_push($error, 'Created a user successfully');


				        	// this else means file upload is not empty, so inside it uploads the picture uploaded and uses that picture to create the user.
				        	} 
				        	else 
				        	{

				        		$fileName = $_FILES['file']['name'];
				        		$fileTempName = $_FILES['file']['tmp_name'];
				        		$fileSize = $_FILES['file']['size'];
				        		$fileError = $_FILES['file']['error'];
				        		$fileType = $_FILES['file']['type'];

				        		$fileExt = explode('.', $fileName);
				        		$fileActualExt = strtolower(end($fileExt));

				        		$allowed = array('jpg', 'jpeg', 'png', 'tiff', 'gif');

				        		if (in_array($fileActualExt, $allowed)) {
				        			if ($fileError == 0) {
				        				if ($fileSize < 10485760) {
				        					$fileNameNew = uniqid('', true) . "." . $fileActualExt;
				        					$profilePic = "img/" . $fileNameNew;

				        				//	move_uploaded_file($fileTempName, $profilePic);
											 resize_image($fileTempName, $profilePic);
											 insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
						        			array_push($error, 'Created a user successfully');
				        				} else {
				        					array_push($error, 'File was too big!');	//
				        				}

				        			} else {
				        				array_push($error, 'There was an error uploading your file!');	//
				        			}
				        		} else {
				        			array_push($error, 'You cannot upload files of this type');	//
				        		}
				        	}
        				}

        	/*	This else statement means, if there are no users with the same credentials, then create the user below.													*/
       		} else {
      			$pass = password_hash($pass, PASSWORD_DEFAULT);
	        	// If the file upload is empty, give it a default picture, and create the user
	        	if (empty($_FILES['file']['name'])) {
	        		$profilePic = "img/profile-placeholder.png";
					insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
	        		array_push($error, 'Created a user successfully');


	        	// this else means file upload is not empty, so inside it uploads the picture uploaded and uses that picture to create the user.
	        	} else {

	        		$fileName = $_FILES['file']['name'];
	        		$fileTempName = $_FILES['file']['tmp_name'];
	        		$fileSize = $_FILES['file']['size'];
	        		$fileError = $_FILES['file']['error'];
	        		$fileType = $_FILES['file']['type'];

	        		$fileExt = explode('.', $fileName);
	        		$fileActualExt = strtolower(end($fileExt));

	        		$allowed = array('jpg', 'jpeg', 'png', 'tiff', 'gif');

	        		if (in_array($fileActualExt, $allowed)) {
	        			if ($fileError == 0) {
	        				if ($fileSize < 10485760) {
	        					$fileNameNew = uniqid('', true) . "." . $fileActualExt;
	        					$profilePic = "img/" . $fileNameNew;

								resize_image($fileTempName, $profilePic);
								insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
			        			array_push($error, 'Created a user successfully');
	        				} else {
	        					array_push($error, 'File was too big!');	//
	        				}

	        			} else {
	        				array_push($error, 'There was an error uploading your file!');	//
	        			}
	        		} else {
	        			array_push($error, 'You cannot upload files of this type');	//
	        		}
	        	}
      		}


      	// BELOW
      	// This 'else if' creates the user if the admin checkbox is ticked
		} else if (isset($_POST['checkBox'])) {
        		$accType = $_POST['checkBox'];
        		$pass = strip_tags($_POST['password']);
        		$confPass = strip_tags($_POST['confirmPassword']);

        		if ($pass == $confPass) {
        			// If both passwords are the same we check
        			// If the admin account is already in the database
        			$tempQuery = "SELECT * FROM users WHERE firstName=? AND lastName=? AND dob=? AND accountType='Admin'";
        			$checkTempQuery = $conn->prepare($tempQuery);
        			$checkTempQuery->execute(array($fName, $lName, $dob));
        			$numBer = $checkTempQuery->fetchColumn();

        			$dataPassword = "";
        			if ($numBer > 0) {
        				$checkTempQuery = $conn->prepare($tempQuery);
        				$checkTempQuery->execute(array($fName, $lName, $dob));
        				$row = $checkTempQuery->fetch(PDO::FETCH_ASSOC);	
        				$dataPassword = $row['password'];
        			}

        			if (password_verify($pass, $dataPassword)) {
        				array_push($error, "User is already registered!");		// if password is the same, push the error message and don't create the user


        			// Else meaning no errors, proceed below and create the user.
        			} else {
			        	// If the file upload is empty give it a default picture, then create the user
			        	$pass = password_hash($pass, PASSWORD_DEFAULT);
			        	if (empty($_FILES['file']['name'])) {
			        		$profilePic = "img/profile-placeholder.png";						
							insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
			        		array_push($error, 'Created a user successfully');


			        	// this else means file upload is not empty, so inside it uploads the picture uploaded and uses that picture to create the user.
			        	} else {
			        		$fileName = $_FILES['file']['name'];
			        		$fileTempName = $_FILES['file']['tmp_name'];
			        		$fileSize = $_FILES['file']['size'];
			        		$fileError = $_FILES['file']['error'];
			        		$fileType = $_FILES['file']['type'];

			        		$fileExt = explode('.', $fileName);
			        		$fileActualExt = strtolower(end($fileExt));

			        		$allowed = array('jpg', 'jpeg', 'png', 'tiff', 'gif');

			        		if (in_array($fileActualExt, $allowed)) {
			        			if ($fileError == 0) {
			        				if ($fileSize < 10485760) {
			        					$fileNameNew = uniqid('', true) . "." . $fileActualExt;
			        					$profilePic = "img/" . $fileNameNew;

				        		  echo '<script>';
										  echo 'console.log('. json_encode( $profilePic ) .');';
				        		  echo '</script>';


										resize_image($fileTempName, $profilePic);
										insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass);
					        			array_push($error, 'Created a user successfully');
			        				} else {
			        					array_push($error, 'File was too big!');	
			        				}

			        			} else {
			        				array_push($error, 'There was an error uploading your file!');	
			        			}
			        		} else {
			        			array_push($error, 'You cannot upload files of this type');	
			        		}
			        	}
        			}
        		}
        	}
	}
	//Inserts users into the database
	function insert_user($conn, $fName, $lName, $dob, $profilePic, $accType, $pass)
	{

		$statement = $conn->prepare("INSERT INTO users (firstName, lastName, DOB, profilePicture, accountType, password)
								VALUES(:fname, :lname, :dob, :profilePicture, :accType, :pass);");
		
	  echo '<script>';
	  echo 'console.log('. json_encode( $fName ) .');';
	  echo 'console.log('. json_encode( $dob ) .');';
	  echo 'console.log('. json_encode( $profilePic ) .');';
	  echo 'console.log('. json_encode( $accType ) .');';
	  echo 'console.log('. json_encode( $pass ) .');';
	  echo '</script>';		

		if($statement->execute(array(
			"fname" => $fName,
			"lname" => $lName,
			"dob" => $dob,
			"profilePicture" => $profilePic,
			"accType" => $accType,
			"pass" => $pass))	== true	)
		{
			  echo '<script>';
			  echo 'console.log("successfully inserted user");';
			  echo '</script>';		
		}
		else
		{
			  echo '<script>';
			  echo 'console.log("failure to insert");';
			  echo '</script>';		
		}



	}
	
	//Resize image and moves it to the images folder
	function resize_image($file_name, $profilePic){
			$maxDim = 100;
        list($width, $height, $type, $attr) = getimagesize($file_name);
        if ($width > $maxDim || $height > $maxDim) {
            $target_filename = $file_name;
            $ratio = $width / $height;
            if($ratio > 1) {
                $new_width = $maxDim;
                $new_height = $maxDim/$ratio;
            } else {
                $new_width = $maxDim*$ratio;
                $new_height = $maxDim;
            }
            $src = imagecreatefromstring(file_get_contents($file_name));
            $dst = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagedestroy($src);
            imagepng($dst, $target_filename);
            imagedestroy($dst);
        }

		move_uploaded_file($file_name, $profilePic);

    // this is to get around local apache server file upload restrictions
    //$profilePic = "img/profile-placeholder.png";

	}

 ?>

