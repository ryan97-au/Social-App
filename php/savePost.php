<?php 
	ob_start();
	session_start();
	require_once 'pdoconnectOnline.inc';

	$postContent = $_POST['userPostContent'];

	$postedBy = $_SESSION['userID'];
	
	$myDate = date('Y-m-d h:i:s');

	/*	If URL upload is not empty execute below					*/
	if ("" != trim($_POST['uploadURL'])) {

		$pic = $_POST['uploadURL'];
		$allowed = array('jpg', 'jpeg', 'png', 'tiff', 'gif');

		if (in_array(substr($pic, -3), $allowed) || in_array(substr($pic, -4))) {
			
			$file = "img/" . uniqid('', true) . "." . substr($pic, -3);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $pic);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
			$raw = curl_exec($ch);
			$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
			curl_close($ch) ;
			
			if(file_exists($file)){
				unlink($file);
			}
			
			$fp = fopen($file, 'x');
			fwrite($fp, $raw);
			fclose($fp);
		} else {
			$file = "";
		}

	} else if ("" == trim($_POST['pic']) && "" == trim($_POST['uploadURL']) && "" != trim($_POST['uploadLocal'])) {
		$file = $_POST['uploadLocal'];

	} else if ("" == trim($_POST['uploadURL'])) {
		$file = $_POST['pic'];
	}


	$statement = $conn->prepare("INSERT INTO posts (postContent, postedby, postDate, postPicture)
	VALUES(:postContent, :postedby, :postDate, :postPicture);");

	$statement->execute(array(
	"postContent" => $postContent,
	"postedby" => $postedBy,
	"postDate" => $myDate,
	"postPicture" => $file
	));
	
	$_SESSION['postID'] = $conn->lastInsertId();
	header("location: ../view_feed.php");
	exit();
 ?>