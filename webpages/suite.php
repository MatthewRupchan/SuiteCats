<!DOCTYPE HTML>

<?PHP
	include '../phpscripts/cat_info_for_suite.php';
/*
TODO
implement rename
implement pages
implement filling in default cat # 1
implement picking a new cat to focus on

TODO


*/

	session_start();
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$queryforrenaming = "UPDATE cats_table SET cat_name = 'the name you want' WHERE cat_id = the specific cat's id;";
	
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
		<script type="text/javascript" src="../javascript/insertjavascriptfilehere.js"></script>
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
						PHP for Name of Cat
						PHP for Enabling/Disabling Name Textbox (through Rename Button)
						Rename Button will have a pencil icon instead of the R
						-->	
							<form>
							<td><input id="name" type="text" name="cat_name" placeholder="Name" enabled><button id="rename_button">R</button></td>
							</form>
						</tr>					
						<tr>
						<!--
						PHP for picture of cat
						-->	
							<td><img id="album_pic" src="../cat_images/placeholder.png" alt="my_cat"></td>
						</tr>					
						<tr>
							<td><a href="interaction.php"><button id="visit_button">VISIT</button></a></td>
						</tr>	
						<tr>
						<!-- 
						PHP for last date visited
						-->					
							<td><div id="lastvisit"> Last Visited: 11/7/2020</div></td>
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
						<!--
						PHP array for the pictures and the names of the cats
						-->	
						<th colspan="3"></th>
						<tr class="cat_row">
						<?php
							//account for no pages eh!
							//TODO may need to adjust the cat url text depending on what's stored.
							//	currently assumes that the stored url starts with "cat_images/..."
							for ($j = 0; $j < 3; $j++) {
								if ($j > $num_cats - 1) {
									break;
								}
						?>
							<td><div id="cats_names"><?=$catarray[$j]["cat_name"]?></div><img id="album_pic" src="../<?=$catarray[$j]["cat_URL"]?>" alt="my_cat"></td>
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
							<td><div id="cats_names"><?=$catarray[$j]["cat_name"]?></div><img id="album_pic" src="../<?=$catarray[$j]["cat_URL"]?>" alt="my_cat"></td>
						</tr>
						<?php
							}
						?>
						<!--
						Changing button images to match what is posted on storyboard
						Also enable/disable these buttons when on the last or first pages.
						-->	
						<tr>
							<?php
								if($page > 1) {
									$enabled = "";
								} else {
									$enabled = "disabled";
								}
								//
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
		
	</body>
	
</html>
