<?php

//database ip and account and password
$servername = "34.121.103.176:3306";
$username = "testuser1587";
$password = "woai1587";
$databasename = "catsdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
  
  // table creation query
/*  $sql = "create TABLE user_table(
    user_id INT(11) NOT NULL AUTO_INCREMENT,
    user_name  VARCHAR(255),
    user_password  VARCHAR(255),
    email VARCHAR(255),
    money INT(11),
    PRIMARY KEY (user_id)
);";*/

/*  $sql = "create TABLE marketplace(
    cat_id INT(11) NOT NULL,
    cat_price INT(11),   
    sale_timer TIMESTAMP
);";

/*  $sql = "
    create TABLE cat_table(
    cat_id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    eye_colour VARCHAR(255),
    tail_length INT(11),
    hair_length INT(11),
    body_colour VARCHAR(255),
    personality VARCHAR(255),
    gender VARCHAR(255), 
    owend TINYINT(1), 
    interaction_timer TIMESTAMP,
    Img_URL VARCHAR(255),
    PRIMARY KEY (cat_id),
    FOREIGN KEY (user_id) REFERENCES user_table(user_id)
);";*/


// check table's content (not the attributes)
/*   
     $sql= "select * from user_table;";
     $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["user_id"]. " - Name: " . $row["user_name"]. " " . $row["user_password"]. "<br>"; // fill all the attributes completely
  }
} else {
  echo "0 results";
}
*/

$conn->close();
?>