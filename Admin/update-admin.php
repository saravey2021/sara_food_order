<!--Header Admin include-->
<?php
   include('../AdminInclude/header.php');
?>


<div class="main-content">
  	<div class="wrapper">
  		<h1 style="color: red;">Update Admin</h1>  <br><br>
  		<?php
			//1.Get the ID of Selected Admin
			$id = $_GET['user_id'];
			//2.Create a SQL Query to Get the Details
			$sql = "SELECT * FROM tbl_user WHERE user_id=$id";
			//Execute the Query
			$result = mysqli_query($conn, $sql);
			//Check whether the query is Executed or not
			if ($result == true) {
				//check whether the data is available or not
				$rows = mysqli_num_rows($result);
				//check whether we have admin data or not
				if ($rows == 1) {
					//Get the Details
					$row = mysqli_fetch_assoc($result);
					$full_name = $row['full_name'];
					$username = $row['username'];
				}else{
					//Redirect to Manage Admin Page
					header('location:'.SITEURL.'Admin/manager-admin.php');
				}
			}
  		?>

		<form action="" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>Full Name:</td>
					<td><input type="text" name="full_name" class="full_name" id="full_name" placeholder="Enter Your Name" style="width: 100%;height: 30px; border-radius: 5px; border-color:  cyan;" value="<?php echo $full_name; ?>"></td>
				</tr>

				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" class="username" id="username" placeholder="Your Username" style="width: 100%;height: 30px; border-radius: 5px; border-color: cyan;" value="<?php echo $username; ?>"></td>
				</tr>

				<tr>
					<td colspan="2"><br>
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="update" class="btn-secondary" value="Update Admin">
					<input type="reset" name="reset" class="btn-danger" value="Cancel"></td>
				</tr>
			</table>
		</form>
  	</div>
</div>

	<?php
		//check whether the update button is clicked or not
		if (isset($_POST['update'])) {
			//Get all the values from form to update
			$id = $_POST['id'];
			$full_name = $_POST['full_name'];
			$username = $_POST['username'];
			//Create a SQL Query to Update Admin
			$sql = "UPDATE tbl_user SET full_name = '$full_name', username = '$username'
			WHERE user_id = '$id'";
			//Execute the Query
			$result = mysqli_query($conn, $sql);
			//Check whether the query executed successfully or not
			if ($result == true) {
				//Query Executed and Admin update
				$_SESSION['update'] = "<div class='success'>Admin Update Successfully.</div>";
				//Redirect to message Admin page
				header('location:'.SITEURL.'Admin/manager-admin.php');
			}else{
				//Query Executed and Admin update
				$_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
				//Redirect to message Admin page
				header('location:'.SITEURL.'Admin/manager-admin.php');
			}
		}
	?>


<!--Admin Footer Include-->
<?php
   include('../AdminInclude/footer.php');
?>