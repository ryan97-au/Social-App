<?php 
	require 'pdoconnectOnline.inc';

	if (isset($_POST['value'])) {
		$s = $_POST['value'];		// This is the value i.e. 1,John,Doe,2001-05-05,Student

		$accType = "";
		$userID = "";

		$s = explode(",", $s);
		$accType = strtolower(end($s));
		$userID = $s[0];

		$query = $conn->prepare("SELECT * FROM users WHERE userID=:id");
		$query->execute(array(":id"=>$userID));
		$rowCount = $query->rowCount();

		if ($rowCount > 0) {
			// If there's atleast one result
			// Another query to select all of the friends from the user
			$query = $conn->prepare("SELECT * FROM users WHERE users.userID in (SELECT userTwoID FROM relationships WHERE userOneID=:id) ORDER BY userID DESC");
			$query->execute(array(":id"=>$userID));

			// Check if the user is friends with anyone
			$rowCount = $query->rowCount();

			if ($rowCount > 0) {
				while($row = $query->fetch(PDO::FETCH_ASSOC)) {
					$picture = $row['profilePicture'];
					$fName = $row['firstName'];
					$lName = $row['lastName'];
					$id = $row['userID'];

					echo "<tr>
								<td>
									<input type='checkbox' value='$id' name='checkboxFriend' class='cbs'>
								</td>
								<td>
									<img src='$picture' class='friendProfilePicture'>
								</td>
								<td>
									$fName $lName
								</td>
						</tr>";

				}
				
			} else {
				echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;This user currently has 0 friends";
				echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;Try Again!";
			}

		} else {
			echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;Found 0. Try Again!";
		}

	/*		This is for showing removing the user	*/
	} else if (isset($_POST['val'])) {
		$id = $_POST['val'];
		$id = explode(",", $id);
		$userID = $id[0];
		$name = $id[1] . " " . $id[2];


		$friendID = $_POST['cb'];

		/*	Deletes the row	*/
		$query = $conn->prepare("DELETE FROM relationships WHERE userOneID=:usr1 AND userTwoID=:usr2");
		$query->execute(array(":usr1"=>$userID, ":usr2"=>$friendID));


		$query = $conn->prepare("SELECT * FROM users WHERE users.userID in (SELECT userTwoID FROM relationships WHERE userOneID=:id) ORDER BY userID DESC");
		$query->execute(array(":id"=>$userID));
		$rowCount = $query->rowCount();

		if ($rowCount > 0) {
			while($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$picture = $row['profilePicture'];
				$fName = $row['firstName'];
				$lName = $row['lastName'];
				$id = $row['userID'];

				echo "<tr>
							<td>
								<input type='checkbox' value='$id' name='checkboxFriend' class='cbs'>
							</td>
							<td>
								<img src='$picture' class='friendProfilePicture'>
							</td>
							<td>
								$fName $lName
							</td>
					</tr>";

			}

		} else {
			echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;You have removed all of " . $name .  "'s friends";
			echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;" . $name . " now has 0 friends";
		}
	}

 ?>


