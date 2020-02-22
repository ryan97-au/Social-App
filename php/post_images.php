<?php 
	$query = "SELECT * FROM pictures ORDER BY pictureID DESC LIMIT 6;";
	
    $stmt = $conn->prepare($query); 
    $stmt->execute();
	
	while ($row = $stmt->fetch())
	{
		$image = $row['imageLocation'];
		echo "<img src=\"$image\" class=\"pictureClass\">";
	}
 ?>