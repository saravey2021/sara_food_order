<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>


  <?php
    //Check whether the submit button is checked or not
    if (isset($_POST['add'])) {
        //1.Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  //Password Encryption with MD5

        //2.SQL Query to Save the data into Database
        $sql = "INSERT INTO tbl_user SET
                full_name ='$full_name',
                username ='$username',
                password ='$password'";

        //3.Executing Query and Saving Data into Database
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        
        //4.Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if ($result == true) {
            //Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect page to Message Admin
            header('location:'.SITEURL.'Admin/manager-admin.php');
        }else{
            //Create a Session variable to Display Message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            //Redirect page to Message Admin
            header('location:'.SITEURL.'Admin/manager-admin.php');
        }
    }
  ?>


  <div class="main-content">
  	<div class="wrapper">
  		<h1 style="color: grey;">Add Admin</h1>  <br><br>


  		<form action="" method="post" enctype="multipart/form-data">
  		  <table>

          <tr>
            <td>Full Name:</td>
            <td>
              <input type="text" name="full_name" class="full_name" id="full_name" placeholder="Enter Your Name" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
            </td>
          </tr>

          <tr>
            <td>Username:</td>
            <td>
              <input type="text" name="username" class="username" id="username" placeholder="Your Username" style="width: 100%;height: 30px; border-radius: 5px; border-color: cyan;">
            </td>
          </tr>

          <tr>
            <td>Password:</td>
            <td>
              <input type="password" name="password" class="password" id="password" placeholder="Enter Your Password" style="width: 100%;height: 30px; border-radius: 5px; border-color: cyan;">
            </td>
          </tr>

          <tr>
            <td>Image</td>
            <td>
              <input type="file" name="image">
            </td>
          </tr>

          <tr>
            <td colspan="2"><br>
              <input type="submit" name="add" class="btn-secondary" value="Add Admin">
              <input type="reset" name="reset" class="btn-danger" value="Cancel">
            </td>
          </tr>

  		  </table>
  		</form>


  	</div>
  </div>


<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>

