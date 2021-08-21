<!--include header -->
<?php
  include('./MainInclude/header.php');
?>


<?php
            //Check whether id is passed or not
    if (isset($_GET['category_id'])) {
            //category id is and get the id
    $category_id = $_GET['category_id'];
            //get thr e category title based on category id
    $sql = "SELECT title FROM tbl_category WHERE category_id = $category_id";
            //execute the query
    $result = mysqli_query($conn, $sql);
            //get the value from database
    $row = mysqli_fetch_assoc($result);
            //get the title
    $category_title = $row['title'];
    }else{
            //category not passed
            //redirect to home page
        header('location:'.SITEURL);
    }
?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
    </div>
</section>


<!-- fOOD sEARCH Section Ends Here -->
<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
                //Create SQL Query to get foods based on selected category
            $sql2 = "SELECT * FROM tbl_post WHERE category_id = $category_id";
                //execute the query
            $result2 = mysqli_query($conn, $sql2);
                //count the rows
            $count2 = mysqli_num_rows($result2);
                //check whether food is available or not
            if ($count2 > 0) {
                    //Food is available
            while ($row2 = mysqli_fetch_assoc($result2)) {
                        //Get  the values like id,title,image_name
                $id = $row2['category_id'];
                $title = $row2['title'];
                $price = $row2['price'];
                $date = $row2['post_date'];
                $description = $row2['description'];
                $image_name = $row2['image_name'];
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
            <p class="food-detail"><?php echo $description; ?></p><br>
            <p class="food-date" style="color: grey;"><b>Deadline: </b><?php echo $date; ?></p><br>
            <a href="#" class="btn btn-primary">Order Now</a>
        </div>
    </div>

<?php
    }
    }else{
                    //Food not available
        echo "<div class='error'>Food not available.</div>";
    }
?>
    <div class="clearfix"></div>
</div>
</section>


<!-- fOOD Menu Section Ends Here -->
<!--Footer Include-->
<?php
   include('./MainInclude/footer.php');
?>