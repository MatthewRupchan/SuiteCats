<?php
//By using helper scripts, the users don't get annoying pop ups asking if
//they want to resend forms or not. This script removes this annoyance for renaming your cat.
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	
	$newname = $_POST["cat_name"];
	$cat_id = $_POST["cat_id"];
	
	$query = "UPDATE cat_table SET cat_name = '$newname' WHERE cat_id = '$cat_id';";
	if(!$database->query($query)) {
		die("Failed to upload new cat name, please try again later.");
	}
	
	$database->close();
	
	session_start();
	$page = $_POST["page"];
	//return to the suite page
	header("location: ../webpages/suite.php?page=$page");
?>