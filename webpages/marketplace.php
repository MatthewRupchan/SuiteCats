<!DOCTYPE HTML>

<html>
	<head>
		<title>Suite Cats</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/marketplace.css">
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
			<aside>
				<img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
			</aside>
			
			<div id="marketplace">
				<div class="heading">Marketplace</div>
				
				<div class="forward_backward">
					<img id="top_far_back" class="image_button" src="../cat_images/placeholder.png" alt="Far Back">
					<img id="top_back" class="image_button" src="../cat_images/placeholder.png" alt="Back">
					
					<div class="page_label">Page: 1/1 <!--PHP SPOT HERE--></div>
					
					<img id="top_ahead" class="image_button" src="../cat_images/placeholder.png" alt="Ahead">
					<img id="top_far_ahead" class="image_button" src="../cat_images/placeholder.png" alt="Far Ahead">
				</div>
				
				<div id="market_table"><!--PHP needed on each image and data point have fun :)-->
					<!-- Can we do a PHP for loop? could make 5 rows and fill them really easy!-->
					<!--Row 1-->
					<img class="cat_image" src="../cat_images/placeholder.png" alt="Cat">
					<div class="row">
						<div class="row_info">
							<h4 class="name"><u><!--PHP-->Name</u></h4>
							<div class="detail">Hair Length: <!--PHP-->Insert Value</div>
							<div class="detail">Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Personality: <!--PHP-->Insert Value</div>
							<div class="detail">Eye Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Tail Type: <!--PHP-->Insert Value</div>
							<div class="detail">Gender: <!--PHP-->Insert Value</div>
						</div>
						
						<div class="purchase">
							<button class="buy_cat">Buy</button>
							<div class="worth">$<!--PHP-->69</div>
						</div>
					</div>
					
					<!--Row 2-->
					<img class="cat_image" src="../cat_images/placeholder.png" alt="Cat">
					<div class="row">
						<div class="row_info">
							<h4 class="name"><u><!--PHP-->Name</u></h4>
							<div class="detail">Hair Length: <!--PHP-->Insert Value</div>
							<div class="detail">Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Personality: <!--PHP-->Insert Value</div>
							<div class="detail">Eye Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Tail Type: <!--PHP-->Insert Value</div>
							<div class="detail">Gender: <!--PHP-->Insert Value</div>
						</div>
						
						<div class="purchase">
							<button class="buy_cat">Buy</button>
							<div class="worth">$<!--PHP-->69</div>
						</div>
					</div>
					
					<!--Row 3-->
					<img class="cat_image" src="../cat_images/placeholder.png" alt="Cat">
					<div class="row">
						<div class="row_info">
							<h4 class="name"><u><!--PHP-->Name</u></h4>
							<div class="detail">Hair Length: <!--PHP-->Insert Value</div>
							<div class="detail">Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Personality: <!--PHP-->Insert Value</div>
							<div class="detail">Eye Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Tail Type: <!--PHP-->Insert Value</div>
							<div class="detail">Gender: <!--PHP-->Insert Value</div>
						</div>
						
						<div class="purchase">
							<button class="buy_cat">Buy</button>
							<div class="worth">$<!--PHP-->69</div>
						</div>
					</div>
					
					<!--Row 4-->
					<img class="cat_image" src="../cat_images/placeholder.png" alt="Cat">
					<div class="row">
						<div class="row_info">
							<h4 class="name"><u><!--PHP-->Name</u></h4>
							<div class="detail">Hair Length: <!--PHP-->Insert Value</div>
							<div class="detail">Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Personality: <!--PHP-->Insert Value</div>
							<div class="detail">Eye Colour: <!--PHP-->Insert Value</div>
							<div class="detail">Tail Type: <!--PHP-->Insert Value</div>
							<div class="detail">Gender: <!--PHP-->Insert Value</div>
						</div>
						
						<div class="purchase">
							<button class="buy_cat">Buy</button>
							<div class="worth">$<!--PHP-->69</div>
						</div>
					</div>
				</div>
				
				<div class="forward_backward">
					<img id="far_back" class="image_button" src="../cat_images/placeholder.png" alt="Far Back">
					<img id="back" class="image_button" src="../cat_images/placeholder.png" alt="Back">
					
					<div class="page_label">Page: 1/1 <!--PHP SPOT HERE--></div>
					
					<img id="ahead" class="image_button" src="../cat_images/placeholder.png" alt="Ahead">
					<img id="far_ahead" class="image_button" src="../cat_images/placeholder.png" alt="Far Ahead">
				</div>
				
			</div>
			
			<aside>
				<img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
			</aside>
		</content>
		
		<footer> 
			<!-- 
			this is a placeholder, update if we want something else here
			-->
			<p id="footer_info">CS 372 Fall 2020</p>
		</footer>
		
	</body>
	
</html>