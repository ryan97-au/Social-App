<?php 
	if (isset($_POST['adminLogout']) || isset($_POST['studentLogout'])) {
		session_destroy();
		header("Location: index.php");
	} 
 ?>