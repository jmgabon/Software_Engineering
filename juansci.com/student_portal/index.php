<?php
	session_start();
	session_unset();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JuanSci Portal</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="../css/newportal.css" />
	<link href="https://fonts.googleapis.com/css?family=Righteous|Russo+One&display=swap" rel="stylesheet">
    <link rel="icon" href="pictures/logo.png">
</head>
<body>
	<div class="col-12 col-md-6 col-lg-6 col-xl-4 rounded ml-auto mr-auto mt-4 text-light p-3">
		<div class="text-center text-uppercase">
			<img src="../pictures/logo-new.png" width="180px">
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
                    <input class="form-control" type="password" placeholder="Password" name="Password" required>
                    <div class="invalid-feedback">
                        Please enter your password.
                    </div>
                </div>
                <div class="form-group">
                    <input  style="display: none;" class="form-control" type="password" placeholder="Reenter Password" name="Password" required id="verify">
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-12">
                            <button class="btn btn-danger w-100">Log In</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/cms.js"></script>
<script type="text/javascript" src="js/Authenticate.js"></script>
</body>
</html>
