<?php 
	if (isset($_POST['studentLoginBtn'])) {
		$id = $_POST['thisUser'];

		$query = $conn->prepare("SELECT * FROM users WHERE userID=?");
		$query->execute(array($id));
		$row = $query->fetch(PDO::FETCH_ASSOC);

		$_SESSION['userID'] = $id;
		$_SESSION['userFullName'] = $row['firstName'] . " " . $row['lastName'];
		$_SESSION['userPic'] = $row['profilePicture'];

		header("location: user_home.php");
		exit();

	} else if (isset($_POST['adminLoginBtn'])) {
		$id = $_POST['adminUser'];
		$pwd = strip_tags($_POST['psw']);

		$query = $conn->prepare("SELECT * FROM users WHERE userID=:id");
		$query->execute(array(":id"=>$id));
		$row = $query->fetch(PDO::FETCH_ASSOC);

		$userPwd = $row['password'];

		if (password_verify($pwd, $userPwd)) {
			$_SESSION['adminID'] = $id;
			$_SESSION['adminFullName'] = $row['firstName'] . " " . $row['lastName'];
			$_SESSION['adminPic'] = $row['profilePicture'];

			header("location: admin_home.php");
			exit();
		}
	}
 ?>