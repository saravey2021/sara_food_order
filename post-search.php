<!--include header -->
<?php
   include('./MainInclude/header.php');
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
            //Get the search keyword
            $search = $_POST['search'];
        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
    </div>
</section>

<!-- fOOD sEARCH Section Ends Here -->
<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu Foods</h2>

        <?php
            //Get the search keyword
            $search = $_POST['search'];
            //SQL Query to get foods based on search keyword
            $sql = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            //Execute the query
            $result = mysqli_query($conn, $sql);
            //Count rows
            $count = mysqli_num_rows($result);
            //check whether food available or not
            if ($count > 0) {
                //category available
                while ($row = mysqli_fetch_assoc($result)) {
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
            <p class="food-detail"><?php echo $description; ?></p>  <br>
            <p class="food-date" style="color: blue;"><b>Deadline: </b><?php echo $date; ?></p>  <br>
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
</section>

<!-- fOOD Menu Section Ends Here -->
<!--Footer Include-->
<?php
   include('./MainInclude/footer.php');
?>

