<?php

// $current_post_id = 0;

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

require_once 'php/pdoconnectOnline.inc';

function view_feed()
{

	global $errors;
	global $conn;
	try
	{
		$query = 
			"select 
			posts.postID,
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


		$stmt = $conn->prepare($query);

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$result = $stmt->fetchAll();

		if($stmt->rowCount()>0)
		{
			echo '<div id="post_view">';
			foreach ($result as $post)
			{
				echo '<div class="post">';
					echo '<div class="post_id">';
							echo $post->postID;
					echo '</div>';
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
							echo $post->firstName.' '.$post->lastName;
							echo '&nbsp;';
							echo date( 'd/m/Y', strtotime( $post->postDate ) );
							echo '&nbsp;';
						echo '</div>';
					
					echo '</div><!-- userPost -->';

					$emojiCount = ($post->emojiOne + $post->emojiTwo + $post->emojiThree + $post->emojiFour + $post->emojiFive);
					echo '<table id="reacted_emojis">
					<tr>';
							if($post->emojiOne>0){
								echo '<th>';
								echo '<img class="emoji_img" id="emoji_like_reacted" src="img/emoji-like.png" alt="Like"></img>';
								//echo $post->emojiOne;
								echo '</th>';
							}
							if($post->emojiTwo>0){
								echo '<th>';
								echo '<img class="emoji_img" id="emoji_love_reacted" src="img/emoji-love.png" alt="Love"></img>';
								//echo $post->emojiTwo;
								echo '</th>';
							}
							if($post->emojiThree>0){
								echo '<th>';
								echo '<img class="emoji_img" id="emoji_laugh_reacted" src="img/emoji-laugh.png" alt="Laugh"></img>';
								//echo $post->emojiThree;
								echo '</th>';
							}
							if($post->emojiFour>0){
								echo '<th>';
								echo '<img class="emoji_img" id="emoji_wow_reacted" src="img/emoji-wow.png" alt="Wow"></img>';
								//echo $post->emojiFour;
								echo '</th>';
							}
							if($post->emojiFive>0){
								echo '<th>';
								echo '<img class="emoji_img" id="emoji_sad_reacted" src="img/emoji-sad.png" alt="Sad"></img>';
								//echo $post->emojiFive;
								echo '</th>';
							}
						echo '<th>';
							if($emojiCount < 1)
							{
								echo '<p id="reacted_emoji_txt" style="font-weight:normal;margin-left:3px;">';
								echo 'Be the first to add an emoji';
							}else
							{
								if( $emojiCount == 1)
								{
									echo '<p id="reacted_emoji_txt">';
									echo '1 emoji on this post.';
								}else
								{
									echo '<p id="reacted_emoji_txt">';
									echo $emojiCount.' emojis on this post.';
								}
							}
							echo '</p>
						</th>
					</tr>
					</table>';

				view_latest_comment($post->postID);
				echo '</div><!-- post -->';
			}
			echo '</div>';

			echo '<div id="comment_space">';
			foreach ($result as $post)
			{
				view_comments($post->postID);
			}
			echo '</div>';

		}
		else
		{
			console_log("no posts found");	

		}
	} catch (PDOException $e)
	{
		die($e->getMessage());		
	}
}


function view_comments($postID)
{

	global $errors;
	global $conn;
	try
	{
		$query = 
			"select commentContent, commentDate, firstName from post_comments, users where
			userID = commentBy and
			postID = :postID
			order by commentDate desc
			limit 1, 10;";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(':postID',$postID);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$result = $stmt->fetchAll();

			echo '<div class="comment_view" >';
		if($stmt->rowCount()>0)
		{
			foreach ($result as $comment)
			{
				echo '<div class="comment">';
				 echo '<span class="comment_body">';
				 echo $comment->commentContent;
				 echo '</p>';
				 echo '<span class="comment_date">';
				 echo $comment->firstName;
				 echo ' Posted at ';
				 echo date( 'd/m/Y', strtotime( $comment->commentDate ) );
				 echo '</p>';
				echo '</div>';
			}
		}
		else
		{
			console_log("no comments");	
		}
			echo '</div>';

	} catch (PDOException $e)
	{
		die($e->getMessage());		
	}
}

function view_latest_comment($postID)
{

	global $errors;
	global $conn;
	try
	{
		$query = 
			"select
			post_comments.commentContent, 
			post_comments.commentDate, 
			users.firstName,
			users.lastName,
			users.profilePicture 
			from 
			post_comments, users 
			where
			users.userID = post_comments.commentBy and
			post_comments.postID = :postID
			order by commentDate desc
			limit 1;";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(':postID',$postID);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$result = $stmt->fetchAll();

	 	if($stmt->rowCount()>0)
		{
			foreach ($result as $comment) 
			{
							
				echo 
				'<div id="latestCommentSection">
					<p id="latestCommentLabel">Latest Comment</p>
					<div class="latestCommentBar">
						<div class="latestCommentProfileImage">
							<img src="'.$comment->profilePicture.'"></img>
						</div>';

				echo
						'<div class="latestCommentContent">';
				echo $comment->commentContent;
				echo
					'</div>
					 <div class="latestCommentDate">';
						echo $comment->firstName; echo ' ';
						echo $comment->lastName; echo ' ';
						echo date( 'd/m/Y', strtotime( $comment->commentDate ) );
				echo
					'</div>
					</div>
				</div>';
			}			

		}
		else
		{
			echo 
			'<div id="latestCommentSection">
				<p id="latestCommentLabel">Latest Comment</p>
				<div class="latestCommentBar">
					<div class="latestCommentProfileImage">
						<img src="img/profile-placeholder.png"></img>
					</div>';

			echo
					'<div class="latestCommentContent" style="font-weight:normal">';
			echo 'Be the first to comment on this post...';
			echo
				'</div>
				 <div class="latestCommentDate">';
			echo
				'</div>
				</div>
			</div>';	
		}
	} catch (PDOException $e)
	{
		die($e->getMessage());		
	}
}

?>