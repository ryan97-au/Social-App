<?php 
	
	require 'php/pdoconnectOnline.inc';

	if (isset($_POST['emojiSubmitButton'])) {

		$value = $_POST['emojiHidden'];

		switch ($value) {
			case 'like':
				$query = $conn->prepare("UPDATE posts SET emojiOne= emojiOne + 1, likes = likes + 1 WHERE postID=1");
				$query->execute();
				break;
			case 'love':
				$query = $conn->prepare("UPDATE posts SET emojiTwo= emojiTwo + 1, likes = likes + 1 WHERE postID=1");
				$query->execute();
				break;
			case 'laugh':
				$query = $conn->prepare("UPDATE posts SET emojiThree= emojiThree + 1, likes = likes + 1 WHERE postID=1");
				$query->execute();
				break;
			case 'wow':
				$query = $conn->prepare("UPDATE posts SET emojiFour= emojiFour + 1, likes = likes + 1 WHERE postID=1");
				$query->execute();
				break;
			case 'sad':
				$query = $conn->prepare("UPDATE posts SET emojiFive= emojiFive + 1, likes = likes + 1 WHERE postID=1");
				$query->execute();
				break;

			default:
				break;
		}

	}
	
 ?>