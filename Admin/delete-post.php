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
			$path = "../images/food/".$image_name;
			//Redirect the image
			$remove = unlink($path);

			//If failed to remove image then add an error message and stop the process
			if ($remove == false) {
				//Set the session message
				$_SESSION['upload'] = "<div class='error'>Failed to Remove Food Image.</div>";
				//Redirect to Manage  Category page
				header('location:'.SITEURL.'Admin/manager-post.php');
				//Stop the process
				die();
			}
		}

		//Delete data from database
		//SQL query to delete data from database
		$sql = "DELETE FROM tbl_post WHERE post_id=$id";
		//Execute the Query
		$result = mysqli_query($conn, $sql);

		//check whether the data is delete from database or not
		if ($result == true) {
			//Set success message and redirect
			$_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</dov>";
			//Redirect to message category
			header('location:'.SITEURL.'Admin/manager-post.php');
		}else{
			//Set fail message and redirect
			$_SESSION['delete'] = "<div class='error'>Failed Food to Deleted.</dov>";
			//Redirect to message category
			header('location:'.SITEURL.'Admin/manager-post.php');
		}
		
	}else{
		//Redirect to message category page
		$_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
		header('location:'.SITEURL.'Admin/manager-post.php');
	}

?>