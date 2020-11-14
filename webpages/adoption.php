<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suite Cats</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/adoption.css">
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
    <main>
        <div class="heading">Adoption Shop</div>
        <div class="refresh_timer"><p id="refresh">Refresh Shop in: 00:00</p></div>
        <div id="adoption_page">
            <aside>
                <img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
            </aside>

            <div class="adoption_display" id="adoption_display_left">
                <img class="cat_image" src="../cat_images/placeholder.png" alt="cat img">
                <div class="cat_details">
                    <h4 class="name"><u>Name</u></h4>
                    <div class="detail">Hair length: Placeholder Value</div>
                    <div class="detail">Colour: Placeholder Value</div>
                    <div class="detail">Eye Colour: Placeholder Value</div>
                    <div class="detail">Trait Type: Placeholder Value</div>
                    <div class="detail">Personality: Placeholder Value</div>
                    <div class="detail">Gender: Placeholder Value</div>

                    <!--need to add if/else to display "Adopt $15" or "Adopted" based on its status-->
                    <button class="adopt_button">Adopt $15</button>
                </div>
            </div>

            <div class="adoption_display" id="adoption_display_center">
                <img class="cat_image" src="../cat_images/placeholder.png" alt="cat img">
                <div class="cat_details">
                    <h4 class="name"><u>Name</u></h4>
                    <div class="detail">Hair length: Placeholder Value</div>
                    <div class="detail">Colour: Placeholder Value</div>
                    <div class="detail">Eye Colour: Placeholder Value</div>
                    <div class="detail">Trait Type: Placeholder Value</div>
                    <div class="detail">Personality: Placeholder Value</div>
                    <div class="detail">Gender: Placeholder Value</div>

                    <!--need to add if/else to display "Adopt $15" or "Adopted" based on its status-->
                    <button class="adopt_button">Adopt $15</button>
                </div>
            </div>

            <div class="adoption_display" id="adoption_display_right">
                <img class="cat_image" src="../cat_images/placeholder.png" alt="cat img">
                <div class="cat_details">
                    <h4 class="name"><u>Name</u></h4>
                    <div class="detail">Hair length: Placeholder Value</div>
                    <div class="detail">Colour: Placeholder Value</div>
                    <div class="detail">Eye Colour: Placeholder Value</div>
                    <div class="detail">Trait Type: Placeholder Value</div>
                    <div class="detail">Personality: Placeholder Value</div>
                    <div class="detail">Gender: Placeholder Value</div>

                    <!--need to add if/else to display "Adopt $15" or "Adopted" based on its status-->
                    <button class="adopt_button">Adopt $15</button>
                </div>
            </div>

            <aside id="right_icon">
                <img class="icon" src="../cat_images/placeholder.png" alt="Marketplace Icon">
            </aside>
        </div>
    </main>
</body>
</html>