<!--Connection to Database Table Mysqli-->

<?php

    //Start Session
    session_start();
    //Create Constants to Store Mon Repeating Values
    define('SITEURL', 'http://localhost/sara_food_order/');
    //Connection to Database Table Mysqli
    $conn = mysqli_connect("localhost","root","","sara_project");
    //Check Connection
    if($conn->connect_error){
      die("connection failed");
    }

?>