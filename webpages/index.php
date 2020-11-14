<!DOCTYPE HTML>

<?PHP
	session_start();
	$dbserver = "localhost";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";	
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
						/*
							$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
							$query = ""; //get the user's information
							$user_info = $database->query($query);
							$user_info = $user_info->fetch_assoc(); //easier to work with.
						*/
					?>
				
						<div id="username" class="user_box_element"><?/*=$user_info["user_name"]*/?></div>
						<div id="money" class="user_box_element">$<?/*=$user_info["money"]*/?></div>
						<form action="index.php" id="logout">
							<input type="hidden" name="logout" value="1"></input>
							<button id="log_out" type="submit" class="user_box_element">Log Out</button> <!-- TODO make this log the user out -->
						</form>
					<?PHP
						} else { //user is not logged in, display a log in form
					?>
					
						<form id="login">
							<div id="username" class="user_box_element">
								<input name="username" type="text" placeholder="Username"></input>
							</div>
							<!--ID is money so it takes this row, equivalent to where money would be if logged in.-->
							<div id="money" class="user_box_element"> 
								<input name="password" type="password" placeholder="Password"></input>
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
            
			<a href="sign_up.php">
			<button class="road">
			<h2 class="labels">Sign Up</h2></a></button>

            
		</content>
		
		<footer> 
			<!-- 
			this is a placeholder, update if we want something else here
			-->
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		
	</body>
	
</html>