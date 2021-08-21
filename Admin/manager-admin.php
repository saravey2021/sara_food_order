<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

<!--Main Content Section Starts-->
<div class="main-content">
  <div class="wrapper">
    <h1 style="color: purple;">Manage Admin</h1>  <br><br>

    <?php
      if (isset($_SESSION['add'])) {
          echo $_SESSION['add'];  //Displaying Session Message
          unset($_SESSION['add']);  //Removing Session Message
      }

        if (isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];  //Displaying Session Message
          unset($_SESSION['delete']);  //Removing Session Message
        }
        if (isset($_SESSION['update'])) {
          echo $_SESSION['update'];  //Displaying Session Message
          unset($_SESSION['update']);  //Removing Session Message
        }
        if (isset($_SESSION['user-not-found'])) {
          echo $_SESSION['user-not-found'];  //Displaying Session Message
          unset($_SESSION['user-not-found']);  //Removing Session Message
        }
        if (isset($_SESSION['pwd-not-match'])) {
          echo $_SESSION['pwd-not-match'];  //Displaying Session Message
          unset($_SESSION['pwd-not-match']);  //Removing Session Message
        }
        if (isset($_SESSION['change-pwd'])) {
          echo $_SESSION['change-pwd'];  //Displaying Session Message
          unset($_SESSION['change-pwd']);  //Removing Session Message
        }
    ?>  <br><br><br>

        <a href="add-admin.php" class="btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Admin</a><br/><br/>
        <table class="tbl_full">
          <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>


          <?php
            //Query to Get all Admin
            $sql = "SELECT * FROM tbl_user";  
            //Execute the Query
            $result = mysqli_query($conn, $sql);

            //Check whether the Query is Executed of not
            if ($result == true) {
              //Count Rows to Check whether we have data in database 
              $rows = mysqli_num_rows($result);//Function to Get all the rows in database
              $sn = 1;
              
              //Create a Variable and Assign the value
              //Check the num of rows
              if ($rows > 0) {
                //We have data in database
                while($rows = mysqli_fetch_assoc($result)) {

                  //Using while loop to get all the data from database
                  //and while loop will run as long as we have data in database
                  //Get individual data
                  $id = $rows['user_id'];
                  $full_name = $rows['full_name'];
                  $username = $rows['username'];
                  //Display the values in our table
          ?>

          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $full_name; ?></td>
            <td><?php echo $username; ?></td>
          <td>

              <a href="<?php echo SITEURL; ?>Admin/update-password.php?user_id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
              <a href="<?php echo SITEURL; ?>Admin/update-admin.php?user_id=<?php echo $id ?>" class="btn-secondary">Update</a>
              <a href="<?php echo SITEURL; ?>Admin/delete-admin.php?user_id=<?php echo $id; ?>" class="btn-danger">Delete</a>
        
          <?php
              }
            }else{
              //We Do not have data in database
              //we'll display the message inside table
          ?>

            <tr>
              <td colspan="6">
                <div class="error">No Admin Added</div>
              </td>
            </tr>

            <?php
            }
          }
          ?>

         </table>

  </div>
</div>


<!--Maun Content Section Ends-->
<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>

