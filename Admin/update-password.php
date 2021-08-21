 <!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

  <div class="main-content">
    <div class="wrapper">
      <h1 style="color: red;">Change password</h1>  <br><br>

      <?php
        if (isset($_GET['user_id'])) {
          //1.Get the ID of Selected Admin
          $id = $_GET['user_id'];
        }
      ?>

      <form action="" method="post" enctype="multipart/form-data">
        <table>
          <tr>
            <td>Current password:</td>
            <td><input type="password" name="current_password" class="current_password" id="current_password" placeholder="Old password" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
            </td>
          </tr>

          <tr>
            <td>New password:</td>
            <td><input type="password" name="new_password" class="new_password" id="new_password" placeholder="New password" style="width: 100%;height: 30px; border-radius: 5px; border-color: cyan;">
            </td>
          </tr>

          <tr>
            <td>Confirm password:</td>
            <td><input type="password" name="confirm_password" class="confirm_password" id="confirm_password" placeholder="Confirm password" style="width: 100%;height: 30px; border-radius: 5px; border-color: cyan;">
            </td>
          </tr>

          <tr>
            <td colspan="2"><br>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" name="change" class="btn-secondary" value="Update password">
              <input type="reset" name="reset" class="btn-danger" value="Cancel">
            </td>
          </tr>
        </table>
      </form>

    </div>
  </div>


  <?php
    //check whether the submit button is clicked on  not
    if (isset($_POST['change'])) {
      //1.Get the data from form
      $id = $_POST['id'];
      $current_password = md5($_POST['current_password']);
      $new_password = md5($_POST['new_password']);
      $confirm_password = md5($_POST['confirm_password']);
      //2.Check whether the user with current ID and current password exists or not
      $sql = "SELECT * FROM tbl_user WHERE user_id = $id AND password ='$current_password'";

      //Execute the Query
      $result = mysqli_query($conn, $sql);
      if ($result == true) {
        //Check whether data is available or not
        $count = mysqli_num_rows($result);
        if ($count == 1) {
          //Check whether the new password and confirm match or not
          if ($new_password == $confirm_password) {
            //Update the Password
            $sql2 = "UPDATE tbl_user SET password ='$new_password' WHERE user_id =$id";
            //Execute the Query
            $result2 = mysqli_query($conn, $sql2);
            //Check whether the query executed or not
            if ($result2 == true) {
              //Display Success Meessage
              //User Does not Exist set Message and redirect
              $_SESSION['change-pwd'] = "<div class='success'>Password Change Successfully.</div>";
              //Redirect the user
              header('location:'.SITEURL.'Admin/manager-admin.php');
            }else{
              //Display Error Message
              //User Does not Exist set Message and redirect
              $_SESSION['change-pwd'] = "<div class='error'>Failed Change Password.</div>";
              //Redirect the user
              header('location:'.SITEURL.'Admin/manager-admin.php');
            }

          }else{
            //Redirect to Message Admin page with Error Message
            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Patch.</div>";
            //Redirect the user
            header('location:'.SITEURL.'Admin/manager-admin.php');
          }

        }else{
          //User Does not Exist set Message and redirect
          $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
          //Redirect the user
          header('location:'.SITEURL.'Admin/manager-admin.php');
        }
      }

      //3.check whether the new password and confirm password match or not
      //4.change password if all above is true
    }
  ?>


<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>