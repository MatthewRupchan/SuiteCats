<?php
	//file used for ajax

	//receive request
	$cat_id = $_GET["cat_id"];

	//prep the database
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	
	//retrieve the cat
	$query = "SELECT Img_URL, cat_name, interaction_timer FROM cat_table WHERE cat_id LIKE '$cat_id';";
	$cat = $database->query($query);
	$database->close();
	
	//store the information in JSON format
	$message = array();
	
	/*
	NUMBER	DATABASE_ELEMENT
	0		Img_URL
	1		cat_name
	2		interaction_timer
	*/
	$cat = $cat->fetch_assoc();
	$message[0] = $cat["Img_URL"];
	$message[1] = $cat["cat_name"];
	$message[2] = date("g:i a  F j, Y", strtotime($cat["interaction_timer"]));
	
	echo json_encode($message)

?>