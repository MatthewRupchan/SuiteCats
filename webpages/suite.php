<!DOCTYPE HTML>

<?PHP
	session_start();
	//database variables (more sets of the same in functions down below)
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	if(isset($_POST["rename_submit"]) && $_POST["rename_submit"] == 1) {
		rename_cat($_POST["cat_name"], $_POST["cat_id"]);
	}
	
	if (isset($_POST["logout"]) && $_POST["logout"] == "1") { //the user pressed the log out button
		unset($_POST["logout"]);
		session_destroy();
		header("Location: index.php");
	} elseif (!isset($_SESSION["user"])) { //user is trying to access the page not logged in
		header("Location: index.php");
	} 
	
	if (isset($_POST["page"])) {
		$page = $_POST["page"];
	} else {
		$page = 1; //default to page 1
	}
	
	$userid = $_SESSION["user"];
	$results = retrieve_users_cats($userid, $page);
	$num_cats = $results["num_cats"];
	$pages = $results["pages"];
	$catarray;
	for ($i = 0; $i < $num_cats; $i++) {
		$catarray[$i] = $results["catarray"][$i];
	}
?>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/suite.css">
	</head>
	
	<body>
	
		<header>
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
				<img id="mascot" src="../cat_images/placeholder.png" alt="Mascot">
				<div id="user_info_box">
					<div id="username" class="user_box_element"><?=$_SESSION["user_name"]?></div>
					<div id="money" class="user_box_element">$<?=$_SESSION["money"]?></div>
					<form action="index.php" method="post" enctype="multipart/form-data" id="logout">
						<input type="hidden" name="logout" value="1"></input>
						<button id="log_out" type="submit" class="user_box_element">Log Out</button>
					</form>
				</div>
			</div>
			
			<menu>
				<a href="adoption.php"><h2 class="menu_button">Adoption Center</h2></a>
				<h2 class="menu_button">.</h2>
				<a href="suite.php"><h2 class="menu_button">Suite</h2></a>
				<h2 class="menu_button">.</h2>
				<a href="marketplace.php"><h2 class="menu_button">Marketplace</h2></a>
			</menu>
		</header>
	
		<content> 
			<div>
			<!-- 
			th - header
			tr - rows
			td - info within row
			-->
				<table id="big_table">
					<tr>
					<td>
					<!-- 
					Info Table
					-->
					<table id="info_col">
						<?php
							if ($num_cats > 0) { //standard, show the first cat
						?>
						<tr>
							<th><div class="heading">Suite Overview</div></th>
						</tr>
						<tr>
						<!-- 
						Rename Button will have a pencil icon instead of the R
						-->	
							<form action="suite.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="rename_submit" value="1"></input>
							<input type="hidden" id="rename_cat_id" name="cat_id" value="<?=$catarray[0]["cat_id"]?>"></input> <!-- default the first cat, update this value with ajax javascript -->
							<td><input id="name" type="text" name="cat_name" value="<?=$catarray[0]["cat_name"]?>" readonly><button id="rename_button" title="Rename">R</button></td>
							</form>
						</tr>					
						<tr>
							<!-- 
							If the image url is updated also update the ajax file!
							-->	
							<td><img id="album_pic" class="overview_pic" src="../<?=$catarray[0]["Img_URL"]?>" alt="<?=$catarray[0]["cat_name"]?>"></td>
						</tr>					
						<tr>
							<td><a id="visit_link" href="interaction.php?cat_id=<?=$catarray[0]["cat_id"]?>"><button id="visit_button">VISIT</button></a></td>
						</tr>	
						<tr>				
							<td><div id="lastvisit"> Last Visited: <?=substr($catarray[0]["interaction_timer"], 0, 10)?></div></td>
						</tr>
						<?php
							} else { //new user likely! provide a link to the adoption center!
						?>
						<tr>
							<th><div class="heading">Get Started</div></th>
						</tr>
						<tr>
							<th><div id="get_cat_prompt">Get your first cat from the</div></th>
						</tr>
						<tr>
							<td><a href="adoption.php"><button id="adoption_button">ADOPTION CENTER</button></a></td>
						</tr>	
						<?php
							}
						?>	
					</table>
					</td>
					
					<td>
					<!-- 
					Album Table
					-->
					<table>
						<th colspan="3"></th>
						<tr class="cat_row">
						<?php
							//TODO may need to adjust the cat url text depending on what's stored.
							//	currently assumes that the stored url starts with "cat_images/..."
							for ($j = 0; $j < 3; $j++) {
								if ($j > $num_cats - 1) {
									break;
								}
						?>
							<input type="hidden" id="cat<?=$j?>" value="<?=$catarray[$j]["cat_id"]?>"></input> <!-- used for ajax putting info on left hand panel -->
							<td><div id="cats_names"><?=$catarray[$j]["cat_name"]?></div><img id="pic<?=$j?>" class="album_pic" src="../<?=$catarray[$j]["Img_URL"]?>" alt="<?=$catarray[$j]["cat_name"]?>"></td>
						<?php
							}
						?>
						</tr>
						<tr class="cat_row">
						<?php
							for ($j = 3; $j < 6; $j++) {
								if ($j > $num_cats - 1) {
									break;
								}
						?>
							<input type="hidden" id="cat<?=$j?>" value="<?=$catarray[$j]["cat_id"]?>"></input> <!-- used for ajax putting info on left hand panel -->
							<td><div id="cats_names"><?=$catarray[$j]["cat_name"]?></div><img id="pic<?=$j?>" class="album_pic" src="../<?=$catarray[$j]["Img_URL"]?>" alt="<?=$catarray[$j]["cat_name"]?>"></td>
						</tr>
						<?php
							}
						?>
						<!--
						Change button images to match what is posted on storyboard
						-->	
						<tr>
							<?php
								if($page > 1) {
									$enabled = "";
								} else {
									$enabled = "disabled";
								}
							?>
							<td>
								<form action="suite.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="page" value="<?=1?>"></input>
									<button class="page_buttons" <?=$enabled?>><<</button>
								</form>
								<form action="suite.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="page" value="<?=$page - 1?>"></input>
									<button class="page_buttons" <?=$enabled?>><</button>
								</form>
								
							</td>
							
							<td><div id="page_label">Page: <?=$page?></div></td>
							
							<?php
								if($page < $pages) {
									$enabled = "";
								} else {
									$enabled = "disabled";
								}
							?>
							<td>
								<form action="suite.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="page" value="<?=$page + 1?>"></input>
									<button class="page_buttons" <?=$enabled?>>></button>
								</form>
								<form action="suite.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="page" value="<?=$pages?>"></input>
									<button class="page_buttons" <?=$enabled?>>>></button>
								</form>
							</td>
						</tr>					
					</table>
					</td>
					</tr>
				</table>
			</div>
		</content>
		
		<footer> 
			<!-- 
			this is a placeholder, update if we want something else here
			-->
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		<script type="text/javascript" src="../javascript/rename.js"></script>
		<script type="text/javascript" src="../javascript/suite_album_focus_ajax.js"></script>
	</body>
	
</html>

<?php
//FUNCTIONS
function retrieve_users_cats($userid, $page) {
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	
	$query = "SELECT * FROM cat_table WHERE user_id = '$userid' ORDER BY cat_id ASC;";
	$cats = $database->query($query);
	$pages = ceil($cats->num_rows / 6);
	
	$database->close();
	
	$num_cats = 0;
	for ($i = 0; $i < $pages; $i++) {
		for ($j = 0; $j < 6; $j++) {
			if ($catarray[$j] = $cats->fetch_assoc()) {
				$num_cats = 6;
			} else {
				$num_cats = $j; //- 1 + 1
				break;
			}	
		}
		if ($i == $page - 1) {
			break; 
		}
	}
	
	$results["num_cats"] = $num_cats;
	$results["pages"] = $pages;
	for ($i = 0; $i < $num_cats; $i++) {
		$results["catarray"][$i] = $catarray[$i];
	}
	return $results;
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
	
	$query = "UPDATE cat_table SET cat_name = '$newname' WHERE cat_id = '$cat_id';";
	if(!$database->query($query)) {
		die("Failed to upload new cat name, please try again later.");
	}
	
	$database->close();
	return;
}
?>