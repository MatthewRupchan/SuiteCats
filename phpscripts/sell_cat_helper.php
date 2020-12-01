<?php
//By using helper scripts, the users don't get annoying pop ups asking if
//they want to resend forms or not. This script removes this annoyance for selling your cat.
	
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$cat_id = $_GET["cat_id"];
	
	//Updating cat's for sale status if the forms are submitted
	if(isset($_POST["cat_price"]) && $_POST["cat_price"] > 0) {
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$cost = $_POST["cat_price"];
		$query = "UPDATE cat_table SET cost = '$cost' WHERE cat_id = '$cat_id';";
		$database->query($query);
		$database->close();
	} elseif (isset($_POST["remove_from_marketplace"]) && $_POST["remove_from_marketplace"] == 1) {
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$query = "UPDATE cat_table SET cost = NULL WHERE cat_id = '$cat_id';";
		$database->query($query);
		$database->close();
	}
	//return to the interaction page
	header("location: ../webpages/interaction.php?cat_id=$cat_id");
?>