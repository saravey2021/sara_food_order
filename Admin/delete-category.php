<?php
	//Include dbConnection.php file here
	include('../dbConnection.php');
	//Check whether the id  and image_name value is set or not
	if (isset($_GET['id']) AND isset($_GET['image_name'])) {
		//Get the value and Delete
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		//Redirect the physical image file is available
		if ($image_name != "") {

			//Image is available. So remove it
			$path = "../images/category/".$image_name;
			//Redirect the image
			$remove = unlink($path);

			//If failed to remove image then add an error message and stop the process
			if ($remove == false) {
				//Set the session message
				$_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
				//Redirect to Manage  Category page
				header('location:'.SITEURL.'Admin/manager-category.php');
				//Stop the process
				die();
			}
		}

 	//Delete data from database
 	//SQL query to delete data from database
	$sql = "DELETE FROM tbl_category WHERE category_id=$id";
 	//Execute the Query
	$result = mysqli_query($conn, $sql);
 	//check whether the data is delete from database or not
	if ($result == true) {
 		//Set success message and redirect
		$_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</dov>";
 		//Redirect to message category
		header('location:'.SITEURL.'Admin/manager-category.php');
	}else{
 		//Set fail message and redirect
		$_SESSION['delete'] = "<div class='error'>Failed Category to Deleted.</dov>";
 		//Redirect to message category
		header('location:'.SITEURL.'Admin/manager-category.php');
	}
	
	}else{
		//Redirect to message category page
		header('location:'.SITEURL.'Admin/manager-category.php');
	}

?>