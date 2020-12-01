<!DOCTYPE HTML>

<?PHP
	session_start();

	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";

	if (isset($_POST["logout"]) && $_POST["logout"] == "1") { //the user pressed the log out button
		unset($_POST["logout"]);
		session_destroy();
		header("Location: index.php");
	} elseif (!isset($_SESSION["user"])) { //user is trying to access the page not logged in
		header("Location: index.php");
	} 
	
	//check if this is a page for a real cat and if it is yours
	if (!isset($_GET["cat_id"])) {
		header("Location: suite.php");
	} else {
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$cat_id = $_GET["cat_id"];
		$query = "SELECT * FROM cat_table WHERE cat_id = '$cat_id';";
		
		$results = $database->query($query);
		$database->close();
		
		$cat_info = $results->fetch_assoc();
		$user_id = $cat_info["user_id"];
		
		if ($user_id != $_SESSION["user"]) { //not your cat goodbye
			header("Location: suite.php");
		}
	}
?>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/interaction.css">
		<!-- Stylized Fonts, only 2 max for header and content, and 5 max for within content-->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">
		<!-- Inserted css code, because it's easier to have the link to the fonts on the same page-->
		<style type="text/css">
			h3, .menu_button  {
				font-family: 'Grandstander', cursive;
			}
			
			#website_header, #CatName, #left, button, .countdown, #sell_cat, #stop_sell_cat #lastvisit, #for_sale_label, #interaction, #price_label, #cat_price {
				font-family: 'Kalam', cursive;
			}
		</style>
	</head>
	
	<body>
	
		<header>
			<div id="star_effects">
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
				<img id="mascot" src="../cat_images/icons/Mascot.png" alt="Mascot">
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
			<!-- 
			cat details
			-->
			<div id="left">
				<h1 id="CatName"><?=$cat_info["cat_name"]?></h1>
				<div class="details">Tail Type:</div><div class="info" id="tail"><?=$cat_info["tail_type"]?></div>
				<br>
				<div class="details">Hair Length:</div><div class="info" id="hair"><?=describeHair($cat_info["hair_length"])?></div>
				<br>
				<div class="details">Colour:</div><div class="info" id="colour"><?=$cat_info["body_colour"]?></div>
				<br>
				<div class="details">Eye Colour:</div><div class="info" id="eye"><?=$cat_info["eye_colour"]?></div>
				<br>
				<div class="details">Personality:</div><div class="info" id="personality"><?=$cat_info["personality"]?></div>
				<br>
				<div class="details">Gender:</div><div class="info" id="gender"><?=$cat_info["gender"]?></div>
			</div>
			
			<!-- 
			cat avatar and selling
			-->
			<div id="middle">
				<img id="avatar" src="<?=$cat_info["Img_URL"]?>" alt="Cat Image">
				<br>
				<?php 
					if($cat_info["cost"] == null) { //The cat is not for sale
				?>
				<form id="sell" action="../phpscripts/sell_cat_helper.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
					<input id="sell_cat" type="submit" value="Sell"></button>
					<input id="cat_price" name="cat_price" type="number" value="1" min="1" max="9999"></input>
					<div id="price_label">Price:</div>
				</form>
				<?php 
					} else { //The cat is for sale
				?>
				<form id="sell" action="../phpscripts/sell_cat_helper.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
					<div id="for_sale_label">For sale in the <a href="Marketplace.php">Marketplace</a></div>
					<input type="hidden" name="remove_from_marketplace" value=1></input>
					<input id="stop_sell_cat" type="submit" value="Stop Selling Cat"></button>
				</form>
					
				<?php 
					}
				?>
			</div>
			
			<!-- 
			cat interactions
			-->
			<?PHP
				$cooldown_time = 900; //900 seconds is 15 minutes
				$feed_time = getReadyTime($cat_info["feed_timer"], $cooldown_time);
				$pet_time = getReadyTime($cat_info["pet_timer"], $cooldown_time);
				$play_time = getReadyTime($cat_info["play_timer"], $cooldown_time);
				$groom_time = getReadyTime($cat_info["groom_timer"], $cooldown_time);
			?>
			<div id="right">
			<form action="../phpscripts/process_interaction_requests.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="feed" value=1></input>
				<button id="feed" class="interaction" <?=disableIfUnready($feed_time)?>>FEED</button>
			</form>
				<div class="countdown" id="feed_count"><?=$feed_time?></div>
				<br>
			<form action="../phpscripts/process_interaction_requests.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="play" value=1></input>
				<button id="play" class="interaction" <?=disableIfUnready($play_time)?>>PLAY</button>
			</form>	
				<div class="countdown" id="play_count"><?=$play_time?></div>
				<br>
			<form action="../phpscripts/process_interaction_requests.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="pet" value=1></input>
				<button id="pet" class="interaction" <?=disableIfUnready($pet_time)?>>PET</button>
			</form>
				<div class="countdown" id="pet_count"><?=$pet_time?></div>
				<br>
			<form action="../phpscripts/process_interaction_requests.php?cat_id=<?=$cat_id?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="groom" value=1></input>	
				<button id="groom" class="interaction" <?=disableIfUnready($groom_time)?>>GROOM</button>
			</form>
				<div class="countdown" id="groom_count"><?=$groom_time?></div>
			</div>
		</content>
		
		<footer> 
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		
	</body>
	
</html>

<?PHP
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

function getReadyTime($interactionTimestamp, $cooldown_time) {
	//Make sure you're on Saskatchewan time for this to work.
	if (time() - strtotime($interactionTimestamp . "CST") > $cooldown_time) {
		return "Ready!";
	} else {
		return  "Will be ready at: " . date("g:i a  F j, Y", strtotime($interactionTimestamp) + $cooldown_time);
	}
}

function disableIfUnready($interactionTime) {
	if ($interactionTime == "Ready!") {
		return "";
	} else {
		return "disabled";
	}
}

?>