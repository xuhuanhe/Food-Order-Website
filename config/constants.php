<?php
    //start the session
    session_start();
    //create constants to sore non repeating values
    define('SITEURL', 'http://localhost/food-order');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '1111233569');
    define('DB_NAME','food-order');
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME,'3307') or die(mysqli_error()); //database connection----- solve the problem using SET PASSWORD FOR 'root'@'localhost' = PASSWORD('1111233569');
    // $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error()); //selct database 
?>