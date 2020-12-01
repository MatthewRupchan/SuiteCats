<!DOCTYPE html>
<html lang="en">
<?php
    session_start();

    if (isset($_POST["logout"]) && $_POST["logout"] == "1") { //the user pressed the log out button
        unset($_POST["logout"]);
        session_destroy();
        header("Location: index.php");
    } elseif (!isset($_SESSION["user"])) { //user is trying to access the page not logged in
        header("Location: index.php");
    }

    //database variables
    $dbserver = "34.121.103.176:3306";
    $dbusername = "testuser1587";
    $dbpassword = "woai1587";
    $dbname = "catsdatabase";

    $database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
    }

    //user adopting a cat
    if (isset($_POST["adopt_cat"])) {
        adoptCat();
    }

    //select 3 random unowned cats
    $query = "SELECT * FROM cat_table WHERE owned <>1 ORDER BY RAND() LIMIT 3;";
    if (!$cats_query = $database->query($query)){
        die("Failed query on adoption.php");
    }
    $count = $cats_query->num_rows;

    //insert a random cat until there are 3 available cats for adoption
    while($count < 3) {
        $eye_colours = array('Black', 'Blue', 'Brown', 'Green', 'Two', 'Yellow');
        $eye_colours_key = array_rand($eye_colours);
        $eye_colour = $eye_colours[$eye_colours_key];
        $tail_types =  array('Fluffy', 'Smooth', 'Stubby');
        $tail_type_key = array_rand($tail_types);
        $tail_type = $tail_types[$tail_type_key];
        $hair_length = rand(1, 3);
        $body_colours = array('Black', 'Dark Brown', 'Light Brown', 'Grey', 'Hima', 'Socks', 'White', 'Orange');
        $body_colour_key = array_rand($body_colours);
        $body_colour = $body_colours[$body_colour_key];
        $personalities = array('Playful', 'Feisty', 'Dozy', 'Snuggly', 'Friendly', 'Easy-going', 'Needy', 'Greedy');
        $personality_key = array_rand($personalities);
        $personality = $personalities[$personality_key];
        $genders = array('Male', 'Female');
        $gender_key = array_rand($genders);
        $gender = $genders[$gender_key];
        if ($gender == 'Male') {
            $names = array('Snowball', 'Patches', 'Luna', 'Shadow', 'Charlie', 'Cable', 'Andrew', 'Spaghetti', 'Baguette', 'Olive');
        } else {
            $names = array('Snowball', 'Patches', 'Luna', 'Shadow', 'Jennifer', 'Cable', 'Spaghetti', 'Baguette', 'Bella', 'Olive');
        }
        $name_key = array_rand($names);
        $name = $names[$name_key];

        $img_url = '../cat_images/';
        if ($hair_length == 1) {
            $img_url .= 'short_hair/' . $body_colour . '/SH';
        } else if ($hair_length == 2) {
            $img_url .= 'medium_hair/' . $body_colour . '/MH';
        } else {
            $img_url .= 'long_hair/' . $body_colour . '/LH';
        }
        if ($body_colour == 'Dark Brown') {
            $img_url .= '_DBrown_' . $eye_colour . '_' . $tail_type . '.png';
        } else if ($body_colour == 'Light Brown') {
            $img_url .= '_LBrown_' . $eye_colour . '_' . $tail_type . '.png';
        } else {
            $img_url .= '_' . $body_colour . '_' . $eye_colour . '_' . $tail_type . '.png';
        }

        $new_cat = "INSERT INTO cat_table (eye_colour, tail_type, hair_length, body_colour, personality, gender, owned, Img_URL, cat_name)
                        VALUES ('$eye_colour', '$tail_type', '$hair_length', '$body_colour', '$personality', '$gender', 0, '$img_url', '$name');";
        if (!$database->query($new_cat)){
            die("Failed query on adoption.php");
        }
        $count++;
    }

    if (!$cats_query = $database->query($query)){
        die("Failed query on adoption.php");
    }
    $database->close();

    //store the queried 3 cats
    $cats_available = [];
    for ($i = 0; $i < 3; $i++) {
        $cats_available[$i] = $cats_query->fetch_assoc();
    }
?>
<head>
    <meta charset="UTF-8">
    <title>Suite Cats</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/adoption.css">
    <!-- Stylized Fonts, only 2 max for header and content, and 5 max for within content-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">
    <!-- Inserted css code, because it's easier to have the link to the fonts on the same page-->
    <style type="text/css">
        h3, .menu_button, .heading, button {
            font-family: 'Grandstander', cursive;
        }

        #website_header, .name, .detail{
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
                    <input type="hidden" name="logout" value="1">
                    <button id="log_out" type="submit" class="user_box_element">Log Out</button>
                </form>
            </div>
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
        <div id="adoption_page">
            <aside>
                <img class="icon" src="../cat_images/icons/Adoption_Icon.png" alt="Marketplace Icon">
            </aside>

            <?php
            $cat_cost = 50;
            $button_status = "";
            $button_text = "Adopt $50";

            for ($i = 0; $i < 3; $i++) {
                if ($_SESSION["money"] < $cat_cost) {
                    $button_status = "disabled";
                    $button_text = "You cannot afford this cat.";
                } else if ($cats_available[$i] == 1) {
                    $button_status = "disabled";
                    $button_text = "Owned";
                }

            ?>
            <div class="adoption_display" id="adoption_display_left">
                <img class="cat_image" src="<?=$cats_available[$i]["Img_URL"]?>" alt="cat img">
                <div class="cat_details">
                    <h4 class="name"><u><?=$cats_available[$i]["cat_name"]?></u></h4>
                    <?php if($cats_available[$i]["hair_length"] == 1) : ?>
                    <div class="detail">Hair length: Short</div>
                    <?php elseif($cats_available[$i]["hair_length"] == 2) : ?>
                    <div class="detail">Hair length: Medium</div>
                    <?php else : ?>
                    <div class="detail">Hair length: Long</div>
                    <?php endif; ?>
                    <div class="detail">Colour: <?=$cats_available[$i]["body_colour"]?></div>
                    <div class="detail">Eye Colour: <?=$cats_available[$i]["eye_colour"]?></div>
                    <div class="detail">Tail Type: <?=$cats_available[$i]["tail_type"]?></div>
                    <div class="detail">Personality: <?=$cats_available[$i]["personality"]?></div>
                    <div class="detail">Gender: <?=$cats_available[$i]["gender"]?></div>

                    <form action="adoption.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="adopt_cat" value="<?=$cats_available[$i]["cat_id"]?>">
                        <button class="adopt_button" type="submit" onclick="confirm('Will you adopt this cat?')" <?=$button_status?>><?=$button_text?></button>
                    </form>
                </div>
            </div>
            <?php
            }
            ?>

            <aside id="right_icon">
                <img class="icon" src="../cat_images/icons/Adoption_Icon.png" alt="Marketplace Icon">
            </aside>
        </div>
    </main>
    <footer>
        <p id="footer_info">CS 372 Fall 2020</p>
    </footer>
</body>
</html>

<?php
function adoptCat() {
    $dbserver = "34.121.103.176:3306";
    $dbusername = "testuser1587";
    $dbpassword = "woai1587";
    $dbname = "catsdatabase";

    $database = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    if ($database->connect_error) {
        die("Connection failed: " . $database->connect_error);
    }

    //query the cat to adopt
    $cat_id = $_POST["adopt_cat"];
    $user_id = $_SESSION["user"];
    $query = "SELECT * FROM cat_table WHERE cat_id = '$cat_id';";
    $results = $database->query($query);
    if ($_SESSION["money"] < 50) {
        die("You can't afford this cat.");
    }

    //update the cat ownership to current user
    $cat = $results->fetch_assoc();
    $query = "UPDATE cat_table SET user_id = '$user_id', owned = '1' WHERE cat_id = '$cat_id';";
    $database->query($query);

    //update user's money balance
    $new_balance = $_SESSION["money"] - 50;
    $_SESSION["money"] = $new_balance;
    $query = "UPDATE user_table SET money = '$new_balance' WHERE user_id = '$user_id';";
    $database->query($query);

    $database->close();
    header("Location: suite.php");
}
?>