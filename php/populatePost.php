<?php
	// Connect to the database
	include 'pdoconnectOnline.inc';
	
	// Execute SQL SELECT statement to select all posts inner joined to the user table of the person who posted it
	$sql = "SELECT * FROM posts INNER JOIN users ON posts.postedBy = users.userID ORDER BY postID DESC;";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
	
	// Fill a 2d array with post information
	while ($row = $stmt->fetch())
	{
		$posts[$row['postID']][0] = $row['firstName'] . ' ' . $row['lastName'];
		$posts[$row['postID']][1] = $postComment = $row['postContent'];
		$posts[$row['postID']][2] = $postImage = $row['postPicture'];
		$posts[$row['postID']][3] = $profileImage = $row['profilePicture'];
		$posts[$row['postID']][4] = $postTime = $row['postDate'];
	}
	
	// Call the function populate for each post
	foreach ($posts as &$post){ populate($post);}
	
	// Echo a div containing the post information into the post_view page
	function populate($current)
	{
		$postImage = $current[2];
		$userImage = $current[3];
		$postText = $current[1];
		$userName = $current[0];
		$postTime = $current[4];
		echo "<div class=\"post\">
				<img src=\"img/$postImage\" id =\"postImage\">
				<div class=\"userPost\">
				<img src=\"img/$userImage\" class=\"userPic\">
				<div class=\"userComment\" id = \"userComment\">
					$postText
				</div>
				<div class=\"userPostDate\" id = =\"userPostDate\">
					$userName $postTime
					</div>
				</div>
			</div>";
		return "ok";
	}
	$conn = null;
?>
