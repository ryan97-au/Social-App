<?php

session_start();
  
/*
 * To avoid cross-site scripting:
 * Trim any extra characters
 * Remove any slashes 
 * Remove special HTML characters  
 */
function PrepData($data){
	$data = trim($data);
	$data = htmlspecialchars($data);
	return $data;
}
	
	if($_POST['content'] != "") {
	require_once 'pdoconnectOnline.inc';
	
	if(isset($_SESSION['userID']))
	{
		$user = $_SESSION['userID'];
	} else 
	{
		$user = 1;
	}

	$postID = $_POST['comment_post_id'];
	$_SESSION['postID'] = $postID;

	$content = PrepData($_POST["content"]);
		
	$statement = $conn->prepare("INSERT INTO post_comments(commentContent, commentBy, commentDate, postID)
    VALUES(:content, :user, NOW(), :postID);");
	
	$statement->execute(array(
    "content" => $content,
    "user" => $user,
	"postID" => $postID
	));
	}

	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	header("Location: ../view_feed.php");
	exit;
?>