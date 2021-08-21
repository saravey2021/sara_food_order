<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

  <div class="main-content">
    <div class="wrapper">
      <h1>Update Category</h1>  <br><br>

      <?php
        //Check whether the id is set or not
        if (isset($_GET['id'])) {
          //Get the ID and all other details
          $id = $_GET['id'];
          //Create SQL Query to get all other details
          $sql = "SELECT * FROM tbl_category WHERE category_id=$id";
          //Execute the query
          $result = mysqli_query($conn, $sql);
          //Count the rows to check whether the id is valid or not
          $count = mysqli_num_rows($result);
          if ($count == 1) {
            //Get all the data
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
          }else{
            //redirect to message category with session message
            $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
            header('location:'.SITEURL.'Admin/manager-category.php');
          }
        }else{
          //redirect to message category
          header('location:'.SITEURL.'Admin/manager-category.php');
        }
      ?>


      <!--Add Category Form Sterts-->
      <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
          <tr>
            <td>Title:</td>
            <td>
              <input type="text" name="title" id="title" class="title" placeholder="Category title" value="<?php echo $title; ?>" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
            </td>
          </tr>

          <tr>
            <td>CurrentImage:</td>
            <td>
              <?php
               if ($current_image != "") {
                 //Display the Image
              ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="80px">;

              <?php
                }else{
                  //Display message
                  echo "<div class='error'>Image Not Added.</div>";
                }
              ?>
            </td>
          </tr>

          <tr>
            <td><br>NewImage:</td>
            <td><br><input type="file" name="image"></td>
          </tr>

          <tr>
            <td><br>Featured:</td>
            <td><br>
              <input <?php if ($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
              <input <?php if ($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
            </td>
          </tr>

          <tr>
            <td><br>Active:</td>
            <td><br>
              <input <?php if ($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
              <input <?php if ($active == "No") {echo "checked";} ?> type="radio" name="active" value="No"> No
            </td>
          </tr>

          <tr>
            <td colspan="2"><br>
              <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" name="update" class="btn-secondary" value="Update Categories">
              <input type="reset" name="reset" class="btn-danger" value="Cancel">
            </td>
          </tr>

        </table>
      </form>
      

  <?php
    //check whether the update button is clicked or not
    if (isset($_POST['update'])) {
      //1.Get all the values from form to update
      $id = $_POST['id'];
      $title = $_POST['title'];
      $current_image = $_POST['current_image'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      //2.updating New image if selected
      //check whether the image is selected or not
      if (isset($_FILES['image']['name'])) {
        //Get the Image Details
        $image_name = $_FILES['image']['name'];

        //check whether the image is available or not
        if ($image_name != "") {
            //Image Available
            //A.upload the new image
            //Auto rename our image
            //Get the Extension of our image (jpg,png,gif,etc)e.g. "spacialfood.jpg"
            $extension = end(explode('.', $image_name));
            //Rename the image
            $image_name = "Food_category_".rand(000, 999).'.'.$extension;//e.g. Food_category_834.jpg
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
            //Finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //Check whether the image is uploaded or not
            //And if the image is not uploaded then we will stop the process and redirect with error message
            if ($upload == false) {
              //Set message
              $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
              //Redirect to add category page
              header('location:'.SITEURL.'Admin/manager-category.php');
              //Stop the process
              die();
            }

          //B.remove the current image if available
          if ($current_image != "") {
              $remove_path = "../images/category/".$current_image;
              $remove = unlink($remove_path);

              //check whether the image is removed or not
              //If failed to remove then display message and stop the process
            if ($remove == false) {
              //failed to remove image
              $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
              header('location:'.SITEURL.'Admin/manager-category.php');
              //stop the process
              die();
            }
          }
        }else{
          $image_name = $current_image;
        }
      }else{
        $image_name = $current_image;
      }


      //3.update the database
      //Create a SQL Query to Update category
      $sql2 = "UPDATE tbl_category SET title = '$title', image_name = '$image_name', featured = '$featured', active = '$active' WHERE category_id = '$id'";
      //Execute the Query
      $result2 = mysqli_query($conn, $sql2);

      //4.redirect to message category with message
      //Check whether the query executed successfully or not
      if ($result2 == true) {
        //Query Executed and category update
        $_SESSION['update'] = "<div class='success'>Category Update Successfully.</div>";
        //Redirect to message category page
        header('location:'.SITEURL.'Admin/manager-category.php');
      }else{
        //Query Executed and category update
        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
        //Redirect to message category page
        header('location:'.SITEURL.'Admin/manager-category.php');
      }
    }
  ?>

    <!--Add Category Form Ends-->
    </div>
  </div>


<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>
