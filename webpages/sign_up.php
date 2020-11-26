<!DOCTYPE HTML>
<?php
	//database variables
	$dbserver = "34.121.103.176:3306";
	$dbusername = "testuser1587";
	$dbpassword = "woai1587";
	$dbname = "catsdatabase";
	
	$error = ""; 
	if (isset($_POST["submitted"]) && $_POST["submitted"] == 1) { //the form was submitted
		
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$email = trim($_POST["email"]);
		$starting_money = 50;
		
		//PHP verification that the data is good and will fit into the database
		if (strlen($username) > 0 && strlen($username) < 255 && strlen($password) > 0 && strlen($password) < 255 && strlen($email) > 0 && strlen($email) < 255){
			
			$database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
			
			if ($database->connect_error) {
				die("Connection failed: " . $database->connect_error);
			}
			//Retrieve usernames that are like the inputted username
			$query = "SELECT user_name FROM user_table WHERE user_name = \"" . $username . "\";"; 
			$results = $database->query($query);
			if ($results->num_rows > 0) { //require a unique username
				$database->close();
				$error = "Username has already been taken.";
			} else { //upload information
				//insert user information into the table, make a new row with username, password, email, and starting money
				$query = "INSERT INTO user_table (user_name, user_password, email, money) 
				VALUES ('$username', '$password', '$email', '$starting_money');"; 
				if (!$database->query($query)) { //Check if it fails
					$database->close();
					die("Failed to upload user information.");
				}
				$database->close();
				header("Location: index.php"); //Success, redirect to main page
			}
		}
	}
?>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/sign_up.css">
		<script type="text/javascript" src="../javascript/sign_up.js"></script>
		<!-- Stylized Fonts, only 2 max for header and content, and 5 max for within content-->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">
		<!-- Inserted css code, because it's easier to have the link to the fonts on the same page-->
		<style type="text/css">
			h3 {
				font-family: 'Grandstander', cursive;
			}
			
			#sign_up_title, .sign_up_text, #sign_up_submit, .error_message {
				font-family: 'Kalam', cursive;
			}
		</style>
	</head>
	
	<body>
		<header>
			<div id="star_effects">
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
			</div>
			</div>
		</header>
		
		<content>
			<div id="sign_up_title">Sign Up</div>
			
			<form action="sign_up.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="submitted" value="1"></input>
				<label id="sign_up_error_message" class="error_message"><?=$error?></label>
				
				<div class="sign_up_row">
					<div class="sign_up_text">Username</div>
					<input type="text" name="username" id="username" class="sign_up_input"></input>
					<label id="username_error_message" class="error_message"></label>
				</div>
				
				<div class="sign_up_row">
					<div class="sign_up_text">Email</div>
					<input type="text" name="email" id="email" class="sign_up_input"></input>
					<label id="email_error_message" class="error_message"></label>
				</div>
				
				<div class="sign_up_row">
					<div class="sign_up_text">Password</div>
					<input type="password" name="password" id="password" class="sign_up_input"></input>
					<label id="password1_error_message" class="error_message"></label>
				</div>
				
				<div class="sign_up_row">
					<div class="sign_up_text">Verify Password</div>
					<input type="password" name="verify_password" id="verify_password" class="sign_up_input"></input>
					<label id="password2_error_message" class="error_message"></label>
				</div>
				
				<button id="sign_up_submit" type="submit">Create Account</button>
			</form>
		</content>
			
		<footer> 
			<!-- 
			this is a placeholder, update if we want something else here
			-->
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		<script type="text/javascript" src="../javascript/sign_up_listener.js"></script>
	</body>
	
</html>