<!--include header -->
<?php
include('./MainInclude/header.php');
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>post-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
if (isset($_SESSION['add'])) {
         echo $_SESSION['add'];//Displaying Session Message
         unset($_SESSION['add']);//Removing Session Message
     }
     ?>
     <!-- CAtegories Section Starts Here -->
     <section class="categories" style="background-color: #333">
        <div class="container">
            <h2 class="text-center" style="color: #fff">Category Foods</h2>
            
            <?php
             //Create SQL Query to display category from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
             //Execute the query
            $result = mysqli_query($conn, $sql);
             //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($result);
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
        echo "<div class='error'>Category not Added.</div>";
    }
    ?>

    <div class="clearfix"></div>
</div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu Foods</h2>

        <?php
             //getting foods from database that are active and featured
             //sql query
        $sql2 = "SELECT * FROM tbl_post WHERE active='Yes' AND featured='Yes' LIMIT 6";
             //execute the query
        $result2 = mysqli_query($conn, $sql2);
             //count rows
        $count2 = mysqli_num_rows($result2);
             //check whether food available or not
        if ($count2 > 0) {
                 //category available
           while ($row = mysqli_fetch_assoc($result2)) {
                     //Get  the values like id,title,image_name
               $id = $row['post_id'];
               $title = $row['title'];
               $price = $row['price'];
               $date = $row['post_date'];
               $description = $row['description'];
               $image_name = $row['image_name'];
               ?>
               <div class="food-menu-box">
                  <div class="food-menu-img">
                    <?php
                         //check whether image is available or not
                    if ($image_name == "") {
                             //display message
                       echo "<div class='error'>Image not Available.</div>";
                   }else{
                            //image available
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                    <?php
                }
                ?>
            </div>

            <div class="food-menu-desc">
              <h4><?php echo $title; ?></h4>
              <p class="food-price">$<?php echo $price; ?></p>
              <p class="food-detail">
                <?php echo $description; ?>
            </p><br>
            <p class="food-date" style="color: blue;">
            <b>Deadline: </b><?php echo $date; ?>
            </p>
            <br>

            <a href="#" class="btn btn-primary">Order Now</a>
        </div>
    </div>

    <?php
        }
        }else{
                        //category not available
            echo "<div class='error'>Food not available.</div>";
        }
    ?>

    <div class="clearfix"></div>

</div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
</section>


<!-- fOOD Menu Section Ends Here -->
<!--Footer Include-->
<?php
  include('./MainInclude/footer.php');
?>