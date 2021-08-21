<?php
	//Include dbConnection.php file here
	include('../dbConnection.php');

	//1.get the ID of Admin to be delete
	$id = $_GET['user_id'];

	//2.Create SQL Query to Delete Admin
	$sql = "DELETE FROM tbl_user WHERE user_id = $id";

	//Execute the Query
	$result = mysqli_query($conn, $sql);

	//Check whether the query executed successfully or not
	if ($result == true) {
		//Create Session variable to display Message
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
		//Redirect to Message Admin Page
		header('location:'.SITEURL.'Admin/manager-admin.php');
	}else{
		$_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.Try Again later.</div>";
		header('location:'.SITEURL.'Admin/manager-admin.php');
	}
	//3.Redirect to Manage Admin page with message (success/error)
?>