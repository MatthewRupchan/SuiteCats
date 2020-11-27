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
	
	if (!isset($_GET["cat_id"])) {
		header("Location: suite.php");
	} else {
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		$cat_id = $_GET["cat_id"];
		$query = "SELECT user_id FROM cat_table WHERE cat_id = '$cat_id';"; 
		
		$results = $database->query($query);
		$database->close();
		
		$results = $results->fetch_assoc();
		$user_id = $results["user_id"];
		
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
		<script type="text/javascript" src="../javascript/insertjavascriptfilehere.js"></script>
	</head>
	
	<body>
	
		<header>
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
				<img id="mascot" src="../cat_images/placeholder.png" alt="Mascot">
				<div id="user_info_box">
					<div id="username" class="user_box_element">Username<!--PHP INPUT--></div>
					<div id="money" class="user_box_element">$420<!--PHP INPUT--></div>
					<button id="log_out" class="user_box_element">Log Out</button>
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
				<h1 id="CatName"><!--PHP SPOT-->Name</h1>
				<div class="details">Tail Type:</div><div class="info" id="tail"><!--PHP SPOT-->Excellent</div>
				<br>
				<div class="details">Hair Length:</div><div class="info" id="hair"><!--PHP SPOT-->Nice</div>
				<br>
				<div class="details">Colour:</div><div class="info" id="colour"><!--PHP SPOT-->Wonderful</div>
				<br>
				<div class="details">Eye Colour:</div><div class="info" id="eye"><!--PHP SPOT-->Perfect</div>
				<br>
				<div class="details">Personality:</div><div class="info" id="personality"><!--PHP SPOT-->Exciting</div>
				<br>
				<div class="details">Gender:</div><div class="info" id="gender"><!--PHP SPOT-->Needs Work</div>
			</div>
			
			<!-- 
			cat avatar and selling
			-->
			<div id="middle">
				<img id="avatar" src="../cat_images/placeholder.png" alt="Cat Image">
				<br>
				<form id="sell">
					<input id="sell_cat" type="submit" value="Sell"></button>
					<input id="cat_price" type="number" value="0" min="0"></input>
					<div id="price_label">Price:</div>
				</form>
			</div>
			
			<!-- 
			cat interactions
			-->
			<div id="right">
				<button id="feed" class="interaction">FEED</button>
				<div class="countdown" id="feed_count">Ready!</div>
				<br>
				<button id="play" class="interaction">PLAY</button>
				<div class="countdown" id="play_count">Ready!</div>
				<br>
				<button id="pet" class="interaction">PET</button>
				<div class="countdown" id="pet_count">Ready!</div>
				<br>
				<button id="groom" class="interaction">GROOM</button>
				<div class="countdown" id="groom_count">Ready!</div>
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