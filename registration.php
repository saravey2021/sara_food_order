<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Responsive Registration Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
    <div class="container">
    	<div class="title">
    		Registration
    	</div>
    	<form action="#" method="POST">
    		<div class="user-details">
    			<div class="input-box">
    				<span class="details">Full Name</span>
    				<input type="text" name="fullname" placeholder="Enter your name" required />
    			</div>
    			<div class="input-box">
    				<span class="details">Username</span>
    				<input type="text" name="username" placeholder="Enter your username" required />
    			</div>
    			<div class="input-box">
    				<span class="details">E-mail</span>
    				<input type="text" name="email" placeholder="Enter your email" required />
    			</div>
    			<div class="input-box">
    				<span class="details">Phone Number</span>
    				<input type="text" name="phone" placeholder="Enter your phone number" required />
    			</div>
    			<div class="input-box">
    				<span class="details">Passwod</span>
    				<input type="text" name="password" placeholder="Enter your password" required />
    			</div>
    			<div class="input-box">
    				<span class="details">Confirm Password</span>
    				<input type="text" name="confirm" placeholder="Confirm your password" required />
    			</div>
    		</div>
    		<div class="gender-details">
    			<input type="radio" name="gender" id="dot-1">
    			<input type="radio" name="gender" id="dot-2">
    			<input type="radio" name="gender" id="dot-3">
    			<span class="gender-title">Gender</span>
    			<div class="category">
    				<label for="dot-1">
    					<span class="dot one"></span>
    					<span class="gender">Male</span>
    				</label>
    				<label for="dot-2">
    					<span class="dot two"></span>
    					<span class="gender">Female</span>
    				</label>
    				<label for="dot-3">
    					<span class="dot three"></span>
    					<span class="gender">Prefer not to say</span>
    				</label>
    			</div>
    		</div>
    		<div class="button">
    			<input type="submit" name="register" value="Register">
    		</div>
    	</form>
    </div>
</body>
</html>