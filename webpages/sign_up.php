<!DOCTYPE HTML>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/sign_up.css">
		<script type="text/javascript" src="../javascript/sign_up.js"></script>
	</head>
	
	<body>
	
		<header>
			<div id="website_header"> 
				<a href="index.php"><h3 id="website_title">Suite Cats</h3></a>
			</div>
		</header>
	
		<content> 
			<div id="sign_up_title">Sign Up</div>
			
			<form action="sign_up.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="submitted" value="1"></input>
				<label id="sign_up_error_message" class="error_message"><!--PHP error messages--></label>
				
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