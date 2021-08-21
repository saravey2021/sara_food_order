<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
  //code update
  if (isset($_POST['update'])) {

  //1.Get all the details from the form
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $date_number = $_POST['date-number'];
  $current_image = $_POST['current_image'];
  $category = $_POST['category'];
  $featured = $_POST['featured'];
  $active = $_POST['active'];
    //2.Upload the image if selected
    //Check whether upload button is clicked or not
      if (isset($_FILES['image']['name'])) {
        //upload button clicked
        $image_name = $_FILES['image']['name'];//New image name
        //Check whether the file is available or not
          if ($image_name != "") {
            //Image is available
            //A.Uploading New Image

            //Rename the image
            $extension = end(explode('.', $image_name));//Get the extension of the image
            $image_name = "Food-Name-".rand(0000, 9999).'.'.$extension;//This will be renamed image
            //Get the source path and destination path
            $source_path = $_FILES['image']['tmp_name'];//source path
            $destination_path = "../images/food/".$image_name;//destination path
            //upload the image
            $upload = move_uploaded_file($source_path, $destination_path);
            //Check whether the image is uploaded or not
              if ($upload == false) {
                //failed to upload
                $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                //redirect to manage food
                header('location:'.SITEURL.'Admin/manager-post.php');
                //Stop the process
                die();
              }

              //3.remove the image if new image is uploaded and current image exists
              //B.Rename current Image if available
              if ($current_image != "") {
                //current image is available
                //redirect the image
                $remove_path = "../images/food/".$current_image;
                $remove = unlink($remove_path);
                //Check whether the image is renamed or not
                if ($remove == false) {
                  //Failed to remove current image
                  $_SESSION['remove-failed'] = "<div class='error'>Failed to remove cerrent  image.</div>";
                  //redirect to manage food
                  header('location:'.SITEURL.'Admin/manager-post.php');
                  //Stop the process
                  die();
                }
              }

            }else{
              $image_name = $current_image;
            }
          }else{
            $image_name = $current_image;
          }

          //4.upload the food in database
          $sql3 = "UPDATE tbl_post SET title = '$title', description = '$description', price = $price, post_date ='$date_number', image_name = '$image_name', category_id = '$category', featured = '$featured', active = '$active' WHERE post_id = $id ";
          //Execute the SQL Query
          $result3 = mysqli_query($conn, $sql3);

          //Check whether the query is executed or not
          //redirect to manage food with session message
          if ($result3 == true) {
            //Query Executed and food upload
            $_SESSION['update'] = "<div class='success'>Food updated successfully.</div>";
            header('location:'.SITEURL.'Admin/manager-post.php');
          }
      }

?>


  <?php
    //Check whether id is set or not
    if (isset($_GET['id'])) {
      //Get all the detaile
      $id = $_GET['id'];
      //SQL query to get the selected food
      $sql2 = "SELECT * FROM tbl_post WHERE post_id=$id";
      //Execute the query
      $result2 = mysqli_query($conn, $sql2);
      //Get the value based on query executed
      $row2 = mysqli_fetch_assoc($result2);

      //Get the Individual value of selected food
      $title = $row2['title'];
      $description = $row2['description'];
      $price = $row2['price'];
      $date = $row2['post_date'];
      $current_image = $row2['image_name'];
      $current_category = $row2['category_id'];
      $featured = $row2['featured'];
      $active = $row2['active'];
      }else{
          //Redirect to manage food
        header('location:'.SITEURL.'Admin/manager-post.php');
      }
  ?>


<div class="main-content">
  <div class="wrapper">
    <h1>Update Foods</h1>  <br><br>

    <form action="" method="post" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" id="title" class="title" value="<?php echo $title; ?>" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
          </td>
        </tr>

        <tr>
          <td>Description:</td>
          <td>
            <textarea name="description" id="description" class="description" cols="30" rows="5" style="width: 100%;height: 70px; border-radius: 5px; border-color:  cyan;"><?php echo $description; ?></textarea>
          </td>
        </tr>

        <tr>
          <td>Price:</td>
          <td>
            <input type="number" name="price" id="price" class="price" value="<?php echo $price; ?>" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
          </td>
        </tr>

        <tr>
          <td>Date</td>
          <td>
            <input type="date" name="date-number" id="date-number" class="date-number" placeholder="Enter date food" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;" value="<?php echo $date; ?>">
          </td>
        </tr>

        <tr>
          <td>CurrentImage:</td>
          <td>
            <?php
              if ($current_image != "") {
              //Display the Image
            ?>

              <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="80px">;
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
          <td>Category:</td>
          <td>
            <select name="category" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
              <?php
                //Create php code to display category from database
                //1.Create SQL to get all active category from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                //Executing Query
                $result = mysqli_query($conn, $sql);
                //count rows to check whether we have category else we don't have categories
                $count = mysqli_num_rows($result);

                //If count is greater than zero, we have categories else we don't have categories
                if ($count > 0) {
                  //We have category
                  while ($row = mysqli_fetch_assoc($result)) {
                    //Get the details of category
                    $category_id = $row['category_id'];
                    $category_title = $row['title'];
              ?>
                <option <?php if ($current_category == $category_id) {echo "Selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                <?php
                    }
                  }else{
                  //We don't have category
                ?>

              <option value="0">No Category Found</option>
              
              <?php
                }
                  //2.Display on Dropdown
              ?>
            </select>
          </td>
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
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="submit" name="update" class="btn-secondary" value="Update Foods">
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

