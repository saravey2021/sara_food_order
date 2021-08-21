<!--Connection to database table-->
<?php
  include('../dbConnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Form Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
</head>
<body>

  <div class="loginbox">
    <img src="../images/2.jpg" class="back" alt="">
    <h1>Form Login</h1>

    <form action="#" method="POST">
      <p>Username</p>
      <input type="text" name="username" placeholder="Enter Username" required />
      <p>Password</p>
      <input type="password" name="password" placeholder="Enter Password" required />
      <input type="submit" name="login" value="Login">
    </form>
  </div>

</body>
</html>


<?php
  //Check whether the submit button is clicked or not
  if (isset($_POST['login'])) {
    //Proccess for login
    //1.Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //2.SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_user WHERE username ='$username' AND password ='$password'";
    //3.Execute the Query
    $result = mysqli_query($conn, $sql);
    //4.Count rows to check whether the user exists or not
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      //User Available and login success
      $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
      $_SESSION['user'] = $username;//To check whether the user is logged in or not and logout will unset it
      //Redirect to home page/Dashboard
      header('location:'.SITEURL.'admin/admin.php');

  }else{
    //User not Available
    $_SESSION['login'] = "<div class='error text-center'>username or password did not match.</div>";
    //Redirect to home page/Dashboard
    header('location:'.SITEURL.'admin/login.php');
  }
  }
?>