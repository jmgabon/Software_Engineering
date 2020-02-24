<?php
	session_start();
	session_unset();
?>
<!DOCTYPE html>
<!-- <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JuanSci Portal</title>
    <link rel="stylesheet" type="text/css" href="css/Portal.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="icon" href="pictures/logo.png">
</head>
<body>
	<img src="pictures/logodesign.jpg" class="logo">
	<div class="mycontainer">
		<div class="header float-right">
			<a href="#" class="header-link float-right">HELP</a>
			<span class="separator">|</span>
			<a href="#" class="header-link float-right">POLICY</a>
			<br/>
			<p class="h5 mb-1 float-right">LOGIN TO JUANSCI Portal</p><br/>
			<p class="header-text float-right"><span class="text-light">-----</span>Enter your username and password to continue</p>
		</div>
		<div class="login-form">
			<p class="h6"><label for="Username">User Name: </label>
				<input type="text" name="Username" class="float-right"/>
			</p>
			<p class="h6"><label for="Password">Password:</label>
				<input type="password" name="Password" class="float-right"/>
			</p>
			<p class="h6" id="verify" style="display: none;"><label for="VerifyPassword">Verify:</label>
				<input type="password" name="VerifyPassword" class="float-right"/>
			</p>
			<p class="h6"><label for="account">Log In As:</label>
				<select name="account">
					<option>Admin</option>
					<option>Teacher</option>
					<option>Student</option>
				</select>
			</p>
			<p class="h6">
			<button class="rounded-pill" type="submit">LOGIN</button></a>
			<button class="rounded-pill" type="submit">RESET</button>
			</p>
		</div>
	</div>
	<div class="footer">
		<p class="footer-text">© 2019 - San Juan Science High School. All Rights Reserved</p>
	</div>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/cms.js"></script>
<script type="text/javascript" src="js/Authenticate.js"></script> -->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JuanSci Portal</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/newportal.css" />
	<link href="https://fonts.googleapis.com/css?family=Righteous|Russo+One&display=swap" rel="stylesheet">
    <link rel="icon" href="pictures/logo.png">
</head>
<body>
	<div class="col-12 col-md-6 col-lg-6 col-xl-4 rounded ml-auto mr-auto mt-4 text-light p-3">
		<div class="text-center text-uppercase">
			<img src="pictures/logo-new.png" width="180px">
			<h1 class="mb-0 mt-3">San Juan City</h1>
			<h3>Science High School</h3>
			<p class="lead mt-2">Official School Portal</p>
        </div>
        <div class="p-4">
            <form class="needs-validation container" action="" method="POST" novalidate>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="User ID" name="Username" required>
                    <div class="invalid-feedback">
                        Please enter your username.
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="password" name="Password" required>
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-6">
                            <select name="account" class="custom-select" required>
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Admin">Administrator</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-danger w-100">Log In</button>
                            <!-- <button type="submit" class="btn btn-danger w-50">Reset</button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/cms.js"></script>
<script type="text/javascript" src="js/Authenticate.js"></script>
</body>
</html>
