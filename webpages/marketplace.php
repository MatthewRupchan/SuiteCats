<!DOCTYPE HTML>

<?PHP
	session_start();
	
	//control variable, change this to change number of cats per page.
	$CATS_PER_PAGE = 4;
	
	if (isset($_POST["logout"]) && $_POST["logout"] == "1") { //the user pressed the log out button
		unset($_POST["logout"]);
		session_destroy();
		header("Location: index.php");
	} elseif (!isset($_SESSION["user"])) { //user is trying to access the page not logged in
		header("Location: index.php");
	} 
	
	if (isset($_POST["page"])) { //for when a page button is pressed
		$page = $_POST["page"];
	} else {
		$page = 1; //default to page 1
	}
	
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	//will place newer cats before older cats
	$query = "SELECT * FROM cat_table WHERE cost IS NOT NULL ORDER BY cat_id DESC;"; 
	$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
	if ($database->connect_error) {
		die("Connection failed: " . $database->connect_error);
	}
	$cats_found = $database->query($query);
	$database->close();

	$num_pages = ceil($cats_found->num_rows / $CATS_PER_PAGE);
	
	$cats_for_sale = [];
	$upper_limit = ($CATS_PER_PAGE * $page) - 1;
	$lower_limit = $CATS_PER_PAGE * ($page - 1);
	
	for ($i = 0; $i < $cats_found->num_rows; $i++) {
		if ($i > $upper_limit) { //we have moved beyond where we need to, can move on
			break;
		} elseif ($i >= $lower_limit) {
			//store the row we need it for this page
			if(!($cats_for_sale[$i] = $cats_found->fetch_assoc())) {
				//but if there are no more cats to be found we must quit
				$CATS_PER_PAGE = $i % $CATS_PER_PAGE;
				break;
			}
		} else {
			$cats_found->fetch_assoc(); //do nothing with this row
		}
	}
	
	if ($num_pages == 0) {
		$CATS_PER_PAGE = 0; //don't show cats if there are none.
	}
?>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/marketplace.css">
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
			<aside>
				<img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
			</aside>
			
			<div id="marketplace">
				<div class="heading">Marketplace</div>
				
				<div class="forward_backward">
					<?php 
						//BACK BUTTONS
						if($page > 1) {
							$enabled = "";
						} else {
							$enabled = "disabled";
						}
					?>
					
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=1?>"></input>
						<button id="far_back" class="image_button" <?=$enabled?>></button>
					</form>
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$page - 1?>"></input>
						<button id="back" class="image_button" <?=$enabled?>></button>
					</form>
					
					<?php
						//PAGE LABEL
						if ($num_pages > 0) {
					?>
					<div class="page_label">Page: <?=$page?>/<?=$num_pages?></div>
					<?php
						} else { //no cats are on sale
					?>
					<div class="page_label">No cats for sale.</div>
					<?php
						}
						//FORWARD BUTTONS
						if($page < $num_pages) {
							$enabled = "";
						} else {
							$enabled = "disabled";
						}
					?>
					
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$page + 1?>"></input>
						<button id="forward" class="image_button" <?=$enabled?>></button>
					</form>
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$num_pages?>"></input>
						<button id="far_forward" class="image_button" <?=$enabled?>></button>
					</form>
				</div>
				
				<?php
					for($i = 0; $i < $CATS_PER_PAGE; $i++) {
				?>
				<div id="market_table">
					<img class="cat_image" src="../<?=$cats_for_sale[$i]["Img_URL"]?>" alt="Cat">
					<div class="row">
						<div class="row_info">
							<h4 class="name"><u><?=$cats_for_sale[$i]["cat_name"]?></u></h4>
							<div class="detail">Hair Length: <?=describeHair($cats_for_sale[$i]["hair_length"])?> </div>
							<div class="detail">Colour: <?=$cats_for_sale[$i]["body_colour"]?></div>
							<div class="detail">Personality: <?=$cats_for_sale[$i]["personality"]?></div>
							<div class="detail">Eye Colour: <?=$cats_for_sale[$i]["eye_colour"]?></div>
							<div class="detail">Tail Type: <?=$cats_for_sale[$i]["tail_type"]?></div>
							<div class="detail">Gender: <?=$cats_for_sale[$i]["gender"]?></div>
						</div>
						
						<div class="purchase">
							<button class="buy_cat">Buy</button>
							<div class="worth">$<?=$cats_for_sale[$i]["cost"]?></div>
						</div>
					</div>
				<?php
					}
				?>

				<?php
					if ($num_pages > 0) {
				?>
				<div class="forward_backward">
					<?php 
						//BACK BUTTONS
						if($page > 1) {
							$enabled = "";
						} else {
							$enabled = "disabled";
						}
					?>
					
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=1?>"></input>
						<button id="far_back" class="image_button" <?=$enabled?>></button>
					</form>
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$page - 1?>"></input>
						<button id="back" class="image_button" <?=$enabled?>></button>
					</form>
					
					<div class="page_label">Page: <?=$page?>/<?=$num_pages?></div>
					
					<?php
						//FORWARD BUTTONS
						if($page < $num_pages) {
							$enabled = "";
						} else {
							$enabled = "disabled";
						}
					?>
					
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$page + 1?>"></input>
						<button id="forward" class="image_button" <?=$enabled?>></button>
					</form>
					<form action="marketplace.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="page" value="<?=$num_pages?>"></input>
						<button id="far_forward" class="image_button" <?=$enabled?>></button>
					</form>
				</div>
				<?php
					}
				?>
				
			</div>
			
			<aside>
				<img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
			</aside>
		</content>
		
		<footer> 
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		
	</body>
	
</html>
<?php
//FUNCTIONS
function describeHair($hair_number) {
	if($hair_number == 1) {
		return "Short";
	} elseif($hair_number == 2) { 
		return "Medium";
	} elseif($hair_number == 3) { 
		return "Long";
	}
}
?>
