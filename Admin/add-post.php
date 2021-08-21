<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>


<div class="main-content">
  <div class="wrapper">
    <h1>Add Food</h1>  <br><br>


    <?php
      if (isset($_SESSION['add'])) {
          echo $_SESSION['add'];  //Displaying Session Message
          unset($_SESSION['add']);  //Removing Session Message
      }
      if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];  //Displaying Session Message
        unset($_SESSION['upload']);  //Removing Session Message
      }
    ?>  <br><br>


      <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">

          <tr>
            <td>Title:</td>
            <td>
              <input type="text" name="title" id="title" class="title" placeholder="Title of the food" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
            </td>
          </tr>

          <tr>
            <td>Description:</td>
            <td>
              <textarea name="description" id="description" class="description" placeholder="Description of the food" cols="30" rows="5" style="width: 100%;height: 70px; border-radius: 5px; border-color:  cyan;"></textarea>
            </td>
          </tr>

          <tr>
            <td>Price:</td>
            <td>
              <input type="number" name="price" id="price" class="price" placeholder="Enter price food" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
            </td>
          </tr>
          <tr>
            <td>Image:</td>
            <td>
              <input type="file" name="image">
            </td>
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
                    $id = $row['category_id'];
                    $title = $row['title'];
                ?>

                  <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
            <td>Featured:</td>
            <td>
              <input type="radio" name="featured" value="Yes"> Yes
              <input type="radio" name="featured" value="No"> No
            </td>
          </tr>

          <tr>
            <td>Active:</td>
            <td>
              <input type="radio" name="active" value="Yes"> Yes
              <input type="radio" name="active" value="No"> No
            </td>
          </tr>
          <tr>
            <td colspan="2"><br>
              <input type="submit" name="add" class="btn-secondary" value="Add Foods">
              <input type="reset" name="reset" class="btn-danger" value="Cancel">
            </td>
          </tr>

        </table>
      </form>


      <?php
        //Check whether the button is clicked or not
        if (isset($_POST['add'])) {
          //Add the Food in Database
          //1.Get the data from form
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $date_number = date('Y-m-d');
          $category = $_POST['category'];

          //Check whether radio button for featured and active are checked or not
          if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
          }else{
              $featured = "No";  //Setting the details value
            }
            if (isset($_POST['active'])) {
              $active = $_POST['active'];
            }else{
              $active = "No";  //Setting the details value
            }

          //2.Upload the Image if selected
          //Check whether the select image is clicked or not and upload the image only if the image is selected

          if (isset($_FILES['image']['name'])) {

            //Get the details of the selected image
            $image_name = $_FILES['image']['name'];
            //Check whether the image is selected or not and upload image only if selected
            if ($image_name != "") {
              //Image is selested
              //A.Rename the image
              //Get the extension of selected image(jpg,png.gif,etc.)"Mrr-Maim.jpg"
              $extension = end(explode('.', $image_name));
              //Create New name image
              $image_name = "Food-Name-".rand(0000, 9999).'.'.$extension;//New image name may be "Food-Name-657.jpg"
              //B.Upload the image
              //Get the src path and destination path
              //Source path is the current location of the image
              $source_path = $_FILES['image']['tmp_name'];
              //Description path for the image to be upload
              $destination_path = "../images/food/".$image_name;
              //Finally upload the food image
              $upload = move_uploaded_file($source_path, $destination_path);
              //Check whether image upload of not
              if ($upload == false) {
                //Failed to upload the image
                //Redirect to add food page with error message
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                header('location:'.SITEURL.'Admin/add-post.php');
                //Stop the process
                die();
              }
            }
          }

          else{
            $image_name = "";  //Setting details value as blank
          }

          //3.Insert Into Database
          //Create a SQL Query to save or Add food
          //For numerical we don't need to pass value inside quote "" But for string value it is compulsory to add quotes ""
          $sql2 = "INSERT INTO tbl_post SET title ='$title', description ='$description', price =$price, post_date ='$date_number', image_name ='$image_name', category_id =$category, featured ='$featured', active ='$active'";

          //Execute the query
          $result2 = mysqli_query($conn, $sql2);

          //4.Redirect with message to manage food page
          //Check whether data inserted or not
          if ($result2 == true) {
            //Data inserted successfully
            $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
            header('location:'.SITEURL.'Admin/manager-post.php');
          }else{
            //Failed inserted successfully
            $_SESSION['add'] = "<div class='error'>Failed to Added Food.</div>";
            header('location:'.SITEURL.'Admin/add-post.php');
          }
        }
      ?>

  </div>
</div>


<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>

