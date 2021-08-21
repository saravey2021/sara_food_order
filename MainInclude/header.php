<!-- Connection to database table -->
<?php
  include('dbconnection.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">   
                   <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive"> SaraFoodOrder
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="categories.php">Category</a>
                    </li>
                    <li>
                        <a href="post.php">Menu</a>
                    </li>
                    <li>
                        <a href="Admin/login.php">Login</a>
                    </li>
                </ul>
            </div>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


