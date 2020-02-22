<?php

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

require_once 'php/pdoconnectOnline.inc';
function view_feed()
{
	console_log("view_feed");	

	global $errors;
	global $conn;
	try
	{
		$query = 
			"select 
			posts.postContent, 
			posts.postDate, 
			posts.postPicture, 
			posts.likes, posts.emojiOne, 
			posts.emojiTwo, posts.emojiThree, 
			posts.emojiFour, posts.emojiFive,
			users.firstName, users.lastName, 
			users.profilePicture
			from 
			posts, users
			where
			users.userID = posts.postedBy
			order by posts.postDate desc;";

		console_log($query);	

		$stmt = $conn->prepare($query);
		console_log("prepared");	

		$stmt->execute();
		console_log("executed");	
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$result = $stmt->fetchAll();
		console_log("fetched");	

		if($stmt->rowCount()>0)
		{
			console_log("found");	
			echo '<div id="post_view">';
			foreach ($result as $post)
			{
				echo '<div class="post">';
				echo '<img src="';
				echo $post->postPicture;
				echo '">';
				echo '<div class="userPost">';

				echo '<img src="';
				echo $post->profilePicture;
				echo '" class="userPic">';

				echo '<div class="userComment">';

				echo $post->postContent;

				echo '</div>';
				echo '<div class="userPostDate">';
				echo $posts->firstName.' '.$posts->lastName;
				echo '&nbsp;';
				echo $posts->postDate;
				echo '&nbsp;';
				
				echo '</div></div></div>';
			}
		}
		else
		{
			console_log("not found");	

		}
	} catch (PDOException $e)
	{
		die($e->getMessage());		
	}
}

?>