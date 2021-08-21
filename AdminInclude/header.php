<!--Connection to database table-->
<?php
   include('../dbconnection.php');
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Important to make website responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--fontawesome CSS link-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Custome CSS link-->
  <link rel="stylesheet" type="text/css" href="../css/adminstyle.css">
  <title>Website - Home Page</title>
</head>
<body>

  <!--Menu Section Starts-->
  <div class="menu">
    <div class="wrapper">
      <ul>
        <li><a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li><a href="manager-admin.php"><i class="fa fa-lock" aria-hidden="true"></i> Admin</a></li>
        <li><a href="manager-category.php"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Category</a></li>
        <li><a href="manager-post.php"><i class="fa fa-cutlery" aria-hidden="true"></i> Post</a></li>
        <li><a href="../index.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
      </ul>
    </div>
  </div>
  <!--Menu Section Ends-->


  