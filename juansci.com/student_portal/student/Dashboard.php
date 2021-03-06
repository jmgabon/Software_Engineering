<?php
    session_start();

    if($_SESSION['LRNNum'] === null || $_SESSION['AccessType'] !== 'student'){
        header('Location: ../');
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>JuanSci Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../css/newDashboard.css" />
    <link rel="icon" href="../../pictures/logo.png" />
</head>

<body>
    <center><img src="../../pictures/logodesign.jpg" class="logo" /></center>
    <div class="mycontainer">

        <div class="header float-right">
			<a href="#" class="header-link float-right">HELP</a>
			<span class="separator">|</span>
            <a href="#" class="header-link float-right">POLICY</a>
            <span class="separator">|</span>
            <a href="../" class="header-link float-right">LOGOUT</a>
			<br/>
			<p class="h5 mb-1 float-right bd">JuanSci Portal - MAIN MENU</p><br/>
			<p class="header-text float-right"><span class="name" id="name">
            <?php //echo 'Welcome, ' . $honorific . $fullname?></span></p>
        </div>
        </br>
        <div class="row content">
            <div class="col option">
                <a href="Schedule.php">
                    <img src="../../pictures/sched.png" class="img-opt">
                </a>
                <p class="label">Check Schedule</p>
            </div>  
            
            <div class="col option">
                <a href="../../portal/common/Grade_View.php">
                    <img src="../../pictures/view-grade.png" class="img-opt">
                </a>
                <p class="label">View Grades</p>
            </div>
        </div>
    </div>

    <div class="footer">
		<p class="footer-text">© 2020 - San Juan City Science High School. All Rights Reserved</p>
    </div>
    
    <script>
        let LRNNum = <?php echo $_SESSION['LRNNum']?>;
        let AccessType = '<?php echo $_SESSION['AccessType']?>';

        console.log('AccessType: ' + AccessType);
        console.log('LRNNum: ' + LRNNum);
    </script>
</body>
</html>