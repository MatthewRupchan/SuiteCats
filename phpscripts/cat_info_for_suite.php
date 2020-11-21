<?php
// this doesn't need its own file really...
function retrieve_users_cats($userid, $page) {
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	
	$query = "SELECT * FROM cat_table WHERE user_id LIKE '$userid' ORDER BY cat_name DESC;";
	$cats = $database->query($query);
	$pages = ceil($cats->num_rows / 6);
	
	$database->close();
	
	$num_cats = 0;
	for ($i = 0; $i < $pages; $i++) {
		if ($i == $page) {
			for ($j = 0; $j < 6; $j++) {
				if ($cats[make_index($i, $j)]->fetch_assoc()) {
					$catarray[$j] = $cats[make_index($i, $j)]->fetch_assoc();
					$num_cats = 6;
				} else {
					$num_cats = $j; //- 1 + 1
					break;
				}
				
			}
		}
	}
	$results["num_cats"] = $num_cats;
	$results["pages"] = $pages;
	for ($i = 0; $i < $num_cats; $i++) {
		$results["catarray"][$i] = $catarray[$i];
	}
	return $results;
}

function make_index($page, $element) {
    return ($page*6) + $element;
}

function rename_cat($newname, $cat_id) {
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	
	$query = "UPDATE cats_table SET cat_name = '$newname' WHERE cat_id = '$cat_id';";
	if(!$database->query($query)) {
		die("Failed to upload new cat name, please try again later.");
	}
	
	$database->close();
	return;
}

?>