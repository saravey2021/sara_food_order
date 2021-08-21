<!--include header -->
<?php
  include('./MainInclude/header.php');
?>

<!-- CAtegories Section Starts Here -->
<section class="categories" style="background-color: grey;">
  <div class="container">
    <h2 class="text-center" style="color: #000;">Category Foods</h2>

    <?php
      //display all the category that are active
      //sql query
      $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
        //Execute the query
      $result = mysqli_query($conn, $sql);
        //count rows
      $count = mysqli_num_rows($result);
        //check whether category available or not
      if ($count > 0) {
        //category available
      while ($row = mysqli_fetch_assoc($result)) {
          //Get  the values like id,title,image_name
        $id = $row['category_id'];
        $title = $row['title'];
        $image_name = $row['image_name'];
    ?>

      <a href="<?php echo SITEURL; ?>category-post.php?category_id=<?php echo $id; ?>">
        <div class="box-3 float-container">
          <?php
            //check whether image is available or not
            if ($image_name == "") {
            //display message
            echo "<div class='error'>Image not Available.</div>";
          }else{
            //image available
          ?>

          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

          <?php
            }
          ?>

          <h3 class="float-text text-white"><?php echo $title; ?></h3>
        </div>
      </a>


    <?php
      }
    }else{
                    //category not available
      echo "<div class='error'>Category not found.</div>";
    }
    ?>


<div class="clearfix"></div>
</div>
</section>


<!-- Categories Section Ends Here -->
<!--Footer Include-->
<?php
  include('./MainInclude/footer.php');
?>
