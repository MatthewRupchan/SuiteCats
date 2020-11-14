<!DOCTYPE HTML>

<?PHP
	session_start();
	
	//database variables
	$dbserver = "localhost";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	//check if the log in / log out forms were submitted
	if (isset($_POST["logout"]) && $_POST["logout"] == "1") {
		unset($_POST["logout"]);
		session_destroy();
		header("Location: home.php");
	} elseif (isset($_POST["login"]) && $_POST["login"] == "1") {
		//get the user information
		$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
		if ($database->connect_error) {
			die("Connection failed: " . $database->connect_error);
		}
		//take user info from form
		//WHAT CHANGES DO WE MAKE IN THE ERROR SITUATION????
		//can we make things red? this isn't js tho booooooo
		
		$query = ""; //get the user's information
		$user_info = $database->query($query);
		if ($user_info == null || $user_info == false) {
			//invalid input
			$error = 1;
		} else {
			$user_info = $user_info->fetch_assoc(); //easier to work with.
			$_SESSION["user"] = $user_info["user_id"];
			$_SESSION["user_name"] = $user_info["user_name"];
			$_SESSION["money"] = $user_info["money"];
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
				
						<div id="username" class="user_box_element"><?/*=$_SESSION["user_name"]*/?></div>
						<div id="money" class="user_box_element">$<?/*=$_SESSION["money"]*/?></div>
						<form action="index.php" method="post" enctype="multipart/form-data" id="logout">
							<input type="hidden" name="logout" value="1"></input>
							<button id="log_out" type="submit" class="user_box_element">Log Out</button> <!-- TODO make this log the user out -->
						</form>
					<?PHP
						} else { //user is not logged in, display a log in form
					?>
					
						<form action="index.php" method="post" enctype="multipart/form-data" id="login">
							<input type="hidden" name="login" value="1"></input>
							<div id="username" class="user_box_element">
								<input name="username" type="text" placeholder="Username" 
									<?PHP if(isset($error) && $error == 1){ ?>style="border: solid red 4px;" <?PHP } ?>><!--make input red if there is a log in error-->
								</input>
							</div>
							<!--ID is money so it takes this row, equivalent to where money would be if logged in.-->
							<div id="money" class="user_box_element"> 
								<input name="password" type="password" placeholder="Password"
									<?PHP if(isset($error) && $error == 1){ ?>style="border: solid red 4px;" <?PHP } ?>><!--make input red if there is a log in error-->
								</input>
							</div>
							<!--ID is log out so they have the same style-->
							<button id="log_out" type="submit" class="user_box_element">Log In</button>
						</form>
					
					<?PHP
						}
					?>
				</div>
			</div>
	
		<content> 
			<!--3 big main icons to direct users to the other available pages
			-->
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