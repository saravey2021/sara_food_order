<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>  <br><br>

    <?php
      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];  //Displaying Session Message
        unset($_SESSION['add']);  //Removing Session Message
      }
        if (isset($_SESSION['upload'])) {
          echo $_SESSION['upload'];  //Displaying Session Message
          unset($_SESSION['upload']);  //Removing Session Message
        }
    ?>  <br><br><br>

       <!--Add Category Form Sterts-->
        <form action="" method="post" enctype="multipart/form-data">
          <table class="tbl-30">

            <tr>
              <td>Title:</td>
              <td>
                <input type="text" name="title" id="title" class="title" placeholder="Category title" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;">
              </td>
            </tr>

            <tr>
              <td>Image:</td>
              <td>
                <input type="file" name="image">
              </td>
            </tr>

            <tr>
              <td><br>Featured:</td>
              <td><br>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
              </td>
            </tr>

            <tr>
              <td><br>Active:</td>
              <td><br>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
              </td>
            </tr>

            <tr>
              <td colspan="2"><br>
                <input type="submit" name="add" class="btn-secondary" value="Add Categories">
                <input type="reset" name="reset" class="btn-danger" value="Cancel">
              </td>
            </tr>

          </table>
        </form>

        <!--Add Category Form Ends-->
        <?php
          //Check whether the submit button is clicked or not
          if (isset($_POST['add'])) {

            //1.Get the value from category form
            $title = $_POST['title'];
            //For  Radio inout, we need to check whether the button is selected or not
            if (isset($_POST['featured'])) {
              //Get the value from form
              $featured = $_POST['featured'];
            }else{
              //Set the default value
              $featured = "No";
            }

            if (isset($_POST['active'])) {
              //Get the value from form
              $active = $_POST['active'];
            }else{
              //Set the default value
              $active = "No";
            }

            //Check whether the image is selected or not and set the value for image name accoridingly
            if (isset($_FILES['image']['name'])) {

              //Upload the image
              //To upload image we need image name, source path and destination path
              $image_name = $_FILES['image']['name'];
              //upload the image only if image is selected
              if ($image_name != "") {

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
                  header('location:'.SITEURL.'Admin/add-category.php');
                  //Stop the process
                  die();
                }
          }

          }else{
            //Don't Upload image and set the image_name value as blank
            $image_name = "";
          }
            //2.Create SQL query to insert category into database
            $sql = "INSERT INTO tbl_category SET title ='$title', image_name ='$image_name', featured ='$featured', active ='$active'";
            //3.Execute the query and save in database
            $result = mysqli_query($conn, $sql);
            //4.Check whether the query executed or not and data added or not
            if ($result == true) {
              //Query Executed and category added
              $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
              //Redirect to Manage category page
              header('location:'.SITEURL.'Admin/manager-category.php');
            }else{
              //Failed to add category
              $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
              //Redirect to Manage category page
              header('location:'.SITEURL.'Admin/add-category.php');
            }
          }
        ?>
  </div>
</div>


<!--Admin Footer Include-->
<?php
  include('../AdminInclude/footer.php');
?>