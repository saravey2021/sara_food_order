<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>


<!--Main Content Section Starts-->
<div class="main-content">
  <div class="wrapper">
    <h1 style="color: red;">Manage Food</h1>  <br/><br>

    <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];  //Displaying Session Message
        unset($_SESSION['add']);  //Removing Session Message
      }
        if (isset($_SESSION['upload'])) {
          echo $_SESSION['upload'];  //Displaying Session Message
          unset($_SESSION['upload']);  //Removing Session Message
        }
        if (isset($_SESSION['unauthorize'])) {
          echo $_SESSION['unauthorize'];  //Displaying Session Message
          unset($_SESSION['unauthorize']);  //Removing Session Message
        }
        if (isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];  //Displaying Session Message
          unset($_SESSION['delete']);  //Removing Session Message
        }
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];  //Displaying Session Message
          unset($_SESSION['update']);  //Removing Session Message
        }
        if (isset($_SESSION['remove-failed'])) {
          echo $_SESSION['remove-failed'];  //Displaying Session Message
          unset($_SESSION['remove-failed']);  //Removing Session Message
        }
    ?>  <br><br><br>


        <a href="<?php echo SITEURL; ?>Admin/add-post.php" class="btn-primary"><i class="fa fa-cutlery" aria-hidden="true"></i> Add Food</a>  <br/><br/>
          <table class="tbl_full">
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Price</th>
              <th>Date</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Action</th>
            </tr>


            <?php
              //Create a SQL Query to Get all the Food
              $sql = "SELECT * FROM tbl_post";  //Execute the  query
              $result = mysqli_query($conn, $sql);  //Count rows to check whether we have foods or not
              $count = mysqli_num_rows($result);
              $sn = 1; //Create a Variable and Assign the value
              if ($count > 0) {
                //We have food in database
                //Get the foods from database and display
                while ($row = mysqli_fetch_assoc($result)) {
                  //Get the values from individual column
                  $id = $row['post_id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $date_number = $row['post_date'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];
            ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>$<?php echo $price; ?></td>
                    <td><?php echo $date_number; ?></td>
                    <td>
                      <?php
                        //check whether image name is available or not
                        if ($image_name != "") {
                        //Display the image
                      ?>

                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="150px" height="60px" alt ="">

                      <?php
                        }else{
                                  //Display the message
                          echo "<div class='error'>Image not Added.</div>";
                        }
                      ?>
                    </td>
                    <td><?php echo $featured; ?></td>
                    <td><?php echo $active; ?></td>
                    <td>
                      <a href="<?php echo SITEURL; ?>Admin/update-post.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                      <a href="<?php echo SITEURL; ?>Admin/delete-post.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                    </td>
                  </tr>

              <?php
                  }
                }else{
                      //Food not Added in database
                  echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
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

