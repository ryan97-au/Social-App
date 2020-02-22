<?php 
	require 'pdoconnectOnline.inc';

	/*	For LOADING post comments	*/
	if (isset($_POST['value']) && $_POST['condition'] == "load") {
		$s = $_POST['value'];
		$counter = 1;

		$query = $conn->prepare("SELECT postPicture FROM posts WHERE postID=?");
		$query->execute(array($s));
		$row = $query->fetch(PDO::FETCH_ASSOC);

		echo "<p id='preview_title'>Picture</p>";
			echo "<div id='post_image_preview'>";
			echo 	"<img src='". $row['postPicture'] . "' alt='#'>";
			echo "</div>";
		echo "<p id='comments_title'>Comments</p>";

		$query = $conn->prepare("SELECT commentID, commentContent FROM post_comments WHERE post_comments.postID=? ORDER BY commentID DESC");
		$query->execute(array($s));

		echo "<div id='post_comments_table_box'>";
			echo "<table id='post_comments'>";
			while($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$commentID = $row['commentID'];
				echo "<tr id='comment_row". $counter . "'>";
				echo "<td id='checkbox'><input type='checkbox' class='commentBoxes' value='" . $commentID . "' onclick=\"selected('comment_row" . $counter . "')\"/></td><td width=200px>" . $row['commentContent'] . "</td>";
				echo "</tr>";
				$counter++;
			}
			echo "</table>";
		echo "</div>";	

	/*	For DELETING post					*/
	} else if (isset($_POST['value']) && $_POST['condition'] == "delete") {
		$s = $_POST['value'];

		$query =$conn->prepare("DELETE FROM post_comments WHERE postID=?");
		$query->execute(array($s));
		$query =$conn->prepare("DELETE FROM posts WHERE postID=?");
		$query->execute(array($s));

		$query = $conn->prepare("SELECT posts.postID,posts.postContent, posts.postedBy, posts.postDate, users.userID, users.firstName, users.lastName FROM users, posts WHERE posts.postedBy=users.userID ORDER BY posts.postID DESC");
		$query->execute();
		$rowCount = 1;

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$postID = $row['postID'];
			$name = $row['firstName'] . " " . $row['lastName'];
			$content = $row['postContent'];
			$date = date('d/m/Y', strtotime($row['postDate']));

			echo "<tr id='" . "post_row" . $rowCount . "'>";
			echo "<td><input id='checkbox' type='checkbox' name='box' value='". $postID . "'onclick='selected('". "post_row" . $rowCount . "')'/></td><td width=150px>". $name . "</td><td width=250px>";
			echo $content . "</td><td width=100px>" . $date . "</td>";
			echo "</tr>";
			$rowCount++;

		}

	/*	For DELETING post comment	*/	
	} else if (isset($_POST['delete'])) {
		$id = $_POST['delete'];
		$counter = 1;

		// Need to get the postID
		$query = $conn->prepare("SELECT postID FROM post_comments WHERE commentID=:id");
		$query->execute(array(":id"=>$id));
		$mate = $query->fetch(PDO::FETCH_ASSOC);
		$postID = $mate['postID'];

		// Delete the row
		$query = $conn->prepare("DELETE FROM post_comments WHERE commentID=?");
		$query->execute(array($id));


		$query = $conn->prepare("SELECT commentID, commentContent FROM post_comments WHERE post_comments.postID=? ORDER BY commentID DESC");
		$query->execute(array($postID));

		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$commentID = $row['commentID'];
				echo "<tr id='comment_row". $counter . "'>";
				echo "<td id='checkbox'><input type='checkbox' class='commentBoxes' value='" . $commentID . "' onclick=\"selected('comment_row" . $counter . "')\"/></td><td width=200px>" . $row['commentContent'] . "</td>";
				echo "</tr>";
				$counter++;
		}

	/*	For SEARCHING post	*/
	} else if (isset($_POST['keyword'])) {
		$s = strip_tags($_POST['keyword']);				// need to remove tags to be safe
		$rowCount = 1;

		// Check if there are results
		$query = $conn->prepare("SELECT users.firstName, users.lastName, posts.postContent, posts.postContent, posts.postDate, posts.postID FROM users INNER JOIN posts ON posts.postedBy=users.userID WHERE concat(users.firstName, ' ', users.lastName) LIKE concat('%', :search, '%') OR posts.postContent LIKE concat('%', :search2, '%') ORDER BY posts.postDate DESC");
		$query->execute(array(":search"=>$s, ":search2"=>$s));
		$numRow = $query->rowCount();		// counts how many rows the query returns

		// If there are results
		if ($numRow > 0) {
				while($row = $query->fetch(PDO::FETCH_ASSOC)) {
					$postID = $row['postID'];
					$name = $row['firstName'] . " " . $row['lastName'];
					$content = $row['postContent'];
					$date = date('d/m/Y', strtotime($row['postDate']));

					echo "<tr id='" . "post_row" . $rowCount . "'>";
					echo "<td><input id='checkbox' type='checkbox' name='box' value='". $postID . "' onclick=\"selected('post_row" . $rowCount . "')\"/></td><td width=150px>". $name . "</td><td width=250px>";
					echo $content . "</td><td width=100px>" . $date . "</td>";
					echo "</tr>";
					$rowCount++;
				}

		// If there's no results echo "No results"
		} else {
			echo "There are 0 results. Try Again.";
		}

	// If from date and to dates are set
	} else if (isset($_POST['fDate']) && isset($_POST['tDate'])) {
	//	$a = $_POST['fDate'];		
	//  $b = $_POST['tDate'];		

		/*********************************************************/
		$a = strip_tags($_POST['fDate']);
		$a = str_replace(' ', '', $a);		
		$a = explode('-', $a, 2);
		$dobDay = $a[0];
		$a = strtolower(end($a));			
		$a = explode('-', $a);
		$dobMonth = $a[0];
		$dobYear = strtolower(end($a));
		
		$a = $dobYear . "-" . $dobMonth . "-" . $dobDay;
		/*********************************************************/
		$b = $_POST['tDate'];
		$b = strip_tags($_POST['tDate']);
		$b = str_replace(' ', '', $b);		
		$b = explode('-', $b, 2);
		$dobDay = $b[0];
		$b = strtolower(end($b));			
		$b = explode('-', $b);
		$dobMonth = $b[0];
		$dobYear = strtolower(end($b));
		
		$b= $dobYear . "-" . $dobMonth . "-" . $dobDay;
		/*********************************************************/

		$rowCount = 1;

		$query = $conn->prepare("SELECT posts.postID,posts.postContent, posts.postedBy, cast(posts.postDate as date) as postDate, users.userID, users.firstName, users.lastName FROM users INNER JOIN posts ON posts.postedBy=users.userID WHERE postDate >= :fromDate AND postDate <= concat(:toDate, ' ', '23:59:59.999') ORDER BY postID DESC");
		$query->execute(array(":fromDate"=>$a, ":toDate"=>$b));
		$numOfRows = $query->rowCount();

		// If there are more than one results
		if ($numOfRows > 0) {
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$postID = $row['postID'];
				$name = $row['firstName'] . " " . $row['lastName'];
				$content = $row['postContent'];
				$date = date('d/m/Y', strtotime($row['postDate']));

				echo "<tr id='" . "post_row" . $rowCount . "'>";
				echo "<td><input id='checkbox' type='checkbox' name='box' value='". $postID . "' onclick=\"selected('post_row" . $rowCount . "')\"/></td><td width=150px>". $name . "</td><td width=250px>";
				echo $content . "</td><td width=100px>" . $date . "</td>";
				echo "</tr>";
				$rowCount++;				
			}

		// If there are zero results
		} else {
			echo "There are 0 results. Try Again.";
		}

	// If user is using both the search form and the dates to search posts
	} else if ((isset($_POST['sKeyword'])) && (isset($_POST['sfDate']) && isset($_POST['stDate']))) {
		$a = strip_tags($_POST['sKeyword']);
		
		/*********************************************************/
		$b = strip_tags($_POST['sfDate']);
		$b = str_replace(' ', '', $b);		
		$b = explode('-', $b, 2);
		$dobDay = $b[0];
		$b = strtolower(end($b));			
		$b = explode('-', $b);
		$dobMonth = $b[0];
		$dobYear = strtolower(end($b));
		
		$b = $dobYear . "-" . $dobMonth . "-" . $dobDay;
		/*********************************************************/
		$c = strip_tags($_POST['stDate']);
		$c = str_replace(' ', '', $c);		
		$c = explode('-', $c, 2);
		$dobDay = $c[0];
		$c = strtolower(end($c));			
		$c = explode('-', $c);
		$dobMonth = $c[0];
		$dobYear = strtolower(end($c));
		
		$c = $dobYear . "-" . $dobMonth . "-" . $dobDay;
		/*********************************************************/

		$rowCount = 1;

		$query = $conn->prepare("SELECT users.firstName, users.lastName, posts.postContent, posts.postContent, cast(posts.postDate as date) as postDate, posts.postID FROM users INNER JOIN posts ON posts.postedBy=users.userID WHERE concat(users.firstName, ' ', users.lastName) LIKE concat('%', :search, '%') AND postDate >= :fromDate AND postDate <= concat(:toDate, ' ', '23:59:59.999') ORDER BY postID DESC");
		$query->execute(array(":search"=>$a, ":fromDate"=>$b, ":toDate"=>$c));
		$numOfRows = $query->rowCount();

		if ($numOfRows > 0) {
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$postID = $row['postID'];
				$name = $row['firstName'] . " " . $row['lastName'];
				$content = $row['postContent'];
				$date = date('d/m/Y', strtotime($row['postDate']));

				echo "<tr id='" . "post_row" . $rowCount . "'>";
				echo "<td><input id='checkbox' type='checkbox' name='box' value='". $postID . "' onclick=\"selected('post_row" . $rowCount . "')\"/></td><td width=150px>". $name . "</td><td width=250px>";
				echo $content . "</td><td width=100px>" . $date . "</td>";
				echo "</tr>";
				$rowCount++;
			}

		} else {
			echo "There are 0 results. Try Again.";
		}
	}
	
 ?>