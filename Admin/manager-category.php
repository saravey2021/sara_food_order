<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

<!--Main Content Section Starts-->
<div class="main-content">
  <div class="wrapper">
    <h1 style="color: green;">Manage Category</h1>  <br/>

    <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];  //Displaying Session Message
        unset($_SESSION['add']);  //Removing Session Message
      }

        if (isset($_SESSION['remove'])) {
          echo $_SESSION['remove'];  //Displaying Session Message
          unset($_SESSION['remove']);  //Removing Session Message
        }
        if (isset($_SESSION['delete'])) {
          echo $_SESSION['delete'];  //Displaying Session Message
          unset($_SESSION['delete']);  //Removing Session Message
        }
        if (isset($_SESSION['update'])) {
          echo $_SESSION['update'];  //Displaying Session Message
          unset($_SESSION['update']);  //Removing Session Message
        }
        if (isset($_SESSION['upload'])) {
          echo $_SESSION['upload'];  //Displaying Session Message
          unset($_SESSION['upload']);  //Removing Session Message
        }
        if (isset($_SESSION['no-category-found'])) {
          echo $_SESSION['no-category-found'];  //Displaying Session Message
          unset($_SESSION['no-category-found']);  //Removing Session Message
        }
        if (isset($_SESSION['failed-remove'])) {
          echo $_SESSION['failed-remove'];  //Displaying Session Message
          unset($_SESSION['failed-remove']);  //Removing Session Message
        }
    ?>  <br><br><br>

        <a href="add-category.php" class="btn-primary"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> Add Category</a>  <br/><br/>

        <table class="tbl_full">
          <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
          </tr>

          <?php
            //Query to Get all category
             $sql = "SELECT * FROM tbl_category";
            //Execute the Query
            $result = mysqli_query($conn, $sql);
            //Count Rows to Check whether we have data in database 
            $rows = mysqli_num_rows($result);//Function to Get all the rows in database
            $sn = 1;//Create a Variable and Assign the value

              //Check the num of rows
              if ($rows > 0) {
                //We have data in database
                while($rows = mysqli_fetch_assoc($result)){
                  //Using while loop to get all the data from database
                  //and while loop will run as long as we have data in database
                  //Get individual data
                  $id = $rows['category_id'];
                  $title = $rows['title'];
                  $image_name = $rows['image_name'];
                  $featured = $rows['featured'];
                  $active = $rows['active'];
                  //Display the values in our table
          ?>

                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $title; ?></td>
                    <td>
                      <?php
                        //check whether image name is available or not
                        if ($image_name != "") {
                        //Display the image
                      ?>

                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="150px" height="60px" alt ="">

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
                      <a href="<?php echo SITEURL; ?>Admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                      <a href="<?php echo SITEURL; ?>Admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                    </td>
                  </tr>

                <?php
                    }
                  }else{
                    //We Do not have data in database
                    //we'll display the message inside table
                ?>

                <tr>
                  <td colspan="6">
                    <div class="error">No Category Added</div>
                  </td>
                </tr>

            <?php
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