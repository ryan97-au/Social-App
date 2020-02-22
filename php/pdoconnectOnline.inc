<?php
// do not stage this file.
$servername = "fdb17.runhosting.com:3306"; 
$username = "2412123_snap"; 
$password = "8h*G66hdkO5&"; 
try {
    $conn = new PDO("mysql:host=$servername;dbname=2412123_snap", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>