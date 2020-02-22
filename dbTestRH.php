<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?php
require_once 'php/pdoconnectOnline.inc';
?>
<?php
	$sql = "SELECT firstName, lastName FROM users";
	$sqlQuery = $conn->prepare($sql);
	$sqlQuery->execute();
	foreach ($sqlQuery as $row) {
		$firstName = $row['firstName'];
		$lastName = $row['lastName'];
		echo "Hello ";
		echo "$firstName ";
		echo "$lastName</br>";
	}
?>
</body>
</html>