<!DOCTYPE HTML>

<?PHP
	session_start();
	
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$error = "";
	//check if the log in / log out forms were submitted
	if (isset($_POST["logout"]) && $_POST["logout"] == "1") {
		unset($_POST["logout"]);
		session_destroy();
		header("Location: index.php");
	} elseif (isset($_POST["login"]) && $_POST["login"] == "1") {
		//get the user information
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		
		$username = $_POST['username'];
        $password = $_POST['password'];

        $username_v = clean_input($username);
        $password_v = clean_input($password);
		
		//get the user's information
		$query = "SELECT user_id, user_name, money FROM user_table
        WHERE user_name='$username_v' and user_password='$password_v'";
		
		$user_info = $database->query($query);
		if ($user_info = $user_info->fetch_assoc()) {
			$_SESSION["user"] = $user_info["user_id"];
			$_SESSION["user_name"] = $user_info["user_name"];
			$_SESSION["money"] = $user_info["money"];
		} else {
			//invalid input
			$error = "Invalid username or password.";
		}
	}
?>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/index.css">
		<script type="text/javascript" src="../javascript/insertjavascriptfilehere.js"></script>
	</head>
	
	<body>
	
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
				<img id="mascot" src="../cat_images/placeholder.png" alt="Mascot">
				<div id="user_info_box">
					<?PHP
						if (isset($_SESSION["user"])) { //user is logged in, display their information
					?>
						<div id="username" class="user_box_element"><?=$_SESSION["user_name"]?></div>
						<div id="money" class="user_box_element">$<?=$_SESSION["money"]?></div>
						<form action="index.php" method="post" enctype="multipart/form-data" id="logout">
							<input type="hidden" name="logout" value="1"></input>
							<button id="log_out" type="submit" class="user_box_element">Log Out</button>
						</form>
					<?PHP
						} else { //user is not logged in, display a log in form
					?>
						<form action="index.php" method="post" enctype="multipart/form-data" id="login">
							<div id="log_in_error_message"><?=$error?></div> <!-- PHP Error Message -->
							<input type="hidden" name="login" value="1"></input>
							<div id="username" class="user_box_element">
								<input name="username" type="text" placeholder="Username"></input>
							</div>
							<!--ID is money so it takes this row, equivalent to where money would be if logged in.-->
							<div id="money" class="user_box_element"> 
								<input name="password" type="password" placeholder="Password"></input>
							</div>
							<button id="log_in" type="submit" class="user_box_element">Log In</button>
						</form>
					<?PHP
						}
					?>
				</div>
			</div>
	
		<content> 
			<!--3 big main icons to direct users to the other available pages-->
			<table>
			<tr>
			
			<th><div id="lowered_div"><a href="adoption.php">
			<button id="icon_adoption"></button>
			<h2 class="labels">Adoption Center</h2></div></a></th>
			
			
			<th><div id="raised_div"><a href="suite.php">
			<button id="icon_suite"></button>
			<h2 class="labels">Suite</h2></div></a></th>
			
			
			<th><div id ="lowered_div"><a href="marketplace.php">
			<button id="icon_marketplace"></button>
			<h2 class="labels">Marketplace</h2></div></a></th>
			
			</tr>
			</table>
            
			<?PHP
				if (!isset($_SESSION["user"])) { //user is not logged in, they may sign up	
			?>
			<a href="sign_up.php">

			<button class="road">
			<h2 class="labels">Sign Up</h2></a></button>
			<?PHP
				} else { //user is not logged in, display a log in form
			?>
			<div id="road_spacer"></div>
			<?PHP
				}
			?>
            
		</content>
		
		<footer> 
			<!-- 
			this is a placeholder, update if we want something else here
			-->
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		
	</body>
	
</html>

<?PHP
//FUNCTIONS
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>