<?php
	//File used to process interactions with cats.
	//This can't be in the interaction.php file because of a bug that allows users to refresh the page and get infinite money.

	session_start();

	//get all the cat information
	
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	$cat_id = $_GET["cat_id"];
	$query = "SELECT * FROM cat_table WHERE cat_id = '$cat_id';"; 
	$results = $database->query($query);
	$database->close();
	$cat_info = $results->fetch_assoc();

	//money control variables
	$standardGift = 5;
	$boostedGift = 10;
	$update_needed = false;
	
	//check which interaction was triggered
	if (isset($_POST["feed"]) && $_POST["feed"] == 1) {
		//personality traits that boost money
		$boost1 = "Needy";
		$boost2 = "Greedy";
		//timer to update
		$timer_name = "feed_timer";
		$update_needed = true;
	} elseif(isset($_POST["pet"]) && $_POST["pet"] == 1) {
		//personality traits that boost money
		$boost1 = "Dozy";
		$boost2 = "Snuggly";
		//timer to update
		$timer_name = "pet_timer";
		$update_needed = true;
	} elseif(isset($_POST["play"]) && $_POST["play"] == 1) {
		//personality traits that boost money
		$boost1 = "Playful";
		$boost2 = "Feisty";
		//timer to update
		$timer_name = "play_timer";
		$update_needed = true;
	} elseif(isset($_POST["groom"]) && $_POST["groom"] == 1) {
		//personality traits that boost money
		$boost1 = "Friendly";
		$boost2 = "Easy-going";
		//timer to update
		$timer_name = "groom_timer";
		$update_needed = true;
	}
	
	if ($update_needed) {
		//increase money
		if ($cat_info["personality"] == $boost1 || $cat_info["personality"] == $boost2) {
			$new_money = $_SESSION["money"] + $boostedGift;
		} else {
			$new_money = $_SESSION["money"] + $standardGift;
		}
		updateMoney($new_money);
		//update timestamp
		setTimestamp($timer_name, $cat_id);
		//refresh timestamp variables
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$cat_id = $_GET["cat_id"];
		$query = "SELECT * FROM cat_table WHERE cat_id = '$cat_id';"; 
		$results = $database->query($query);
		$database->close();
		$cat_info = $results->fetch_assoc();
	}
	
	header("Location: ../webpages/interaction.php?cat_id=$cat_id");
	//Return to interaction.php
	
	
	//HELPER FUNCTIONS
	function updateMoney($new_money) {
		//database variables
		$dbserver = "34.121.103.176:3306";
		$dbusername = "testuser1587";
		$dbpassword = "woai1587";
		$dbname = "catsdatabase";
		
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$uid = $_SESSION["user"];
		$query = "UPDATE user_table SET money = '$new_money' WHERE user_id = '$uid';";
		$database->query($query);
		$database->close();
		
		$_SESSION["money"] = $new_money;
	}

	
	function setTimestamp($timer_name, $cat_id) {
		//database variables
		$dbserver = "34.121.103.176:3306";
		$dbusername = "testuser1587";
		$dbpassword = "woai1587";
		$dbname = "catsdatabase";
		
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		//Update this timer
		$query = "UPDATE cat_table SET " . $timer_name . " = NOW() WHERE cat_id = '$cat_id';";
		$database->query($query);
		//Update the last interacted with timestamp
		$query = "UPDATE cat_table SET interaction_timer = NOW() WHERE cat_id = '$cat_id';";
		$database->query($query);
		$database->close();
	}

?>