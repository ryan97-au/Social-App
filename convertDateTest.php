<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8"/>
</head>
<body>
<?php
	$originalDate = "27-08-2017";
	echo "original date: ";
	echo $originalDate;
	echo "<br>";
	$newDate = date("Y-m-d", strtotime($originalDate));
	echo "new date: "; 
	echo $newDate;
	echo "<br>";
	echo "<br>";
	$originalDateTwo = "27.08.2017";
	echo "original date: ";
	echo $originalDateTwo;
	echo "<br>";
	$newDateTwo = date("Y-m-d", strtotime($originalDateTwo));
	echo "new date: "; 
	echo $newDateTwo;
	echo "<br>";
	echo "<br>";
	$originalDateThree = "27 08 2017";
	echo "original date: ";
	echo $originalDateThree;
	echo "<br>";
	$newDateThree = date("Y-m-d", strtotime($originalDateThree));
	echo "new date: "; 
	echo $newDateThree;
	echo "<br>";
	echo "<br>";
	$originalDateFour = "27/08/2017";
	echo "original date: ";
	echo $originalDateFour;
	echo "<br>";
	$newDateFour = date("Y-m-d", strtotime($originalDateFour));
	echo "new date: "; 
	echo $newDateFour;
?>
</body>
</html>