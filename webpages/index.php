<!DOCTYPE HTML>

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
					<div id="username" class="user_box_element">Username<!--PHP INPUT--></div>
					<div id="money" class="user_box_element">$420<!--PHP INPUT--></div>
					<button id="log_out" class="user_box_element">Log Out</button>
					<!--
					DO A PHP CHECK HERE IF ON MAIN
					contains either
					1-
					username, money, and log out button
					2-
					username input, password input, log in button
					-->
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
            
			<a href="signup.html">
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