<?php
  session_start();
  // $_SESSION['TeacherNum'] = 1;
  // $_SESSION['AccessType'] = "principal";
  if($_SESSION['TeacherNum'] === null || !($_SESSION['AccessType'] == "" xor $_SESSION['AccessType'] == "principal" xor $_SESSION['AccessType'] == "coordinator")){
    header('Location: ../');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>JuanSci Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/merged-styles.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/modal.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/newdb.css">
        <link rel="stylesheet" type="text/css" href="../../css/all.css"/>
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Righteous|Russo+One&display=swap"> -->
        <link rel="icon" href="../../pictures/logo-new.png">
    </head>
    <script src="../../js/jquery-3.4.1.js"></script>
    
    <body id="test1" class="bg-light">

      <!---------------TOPNAV--------------->
      
      <nav class="sticky-top navbar shadow bg-dark text-light navbar-expand-lg">
        <div class="container-fluid">
          <p id="demo" class="m-0 p-0 d-none d-md-block"></p>
          <a class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user p-0 m-0"></i>
              <!-- <span class="text-capitalize ml-1"><?php echo $fullname?></span> -->
            </a>
            <div class="d-none" id="divDropdown">
                <a href="" class="dropdown-item">Profile</a>
                <a href="../" class="dropdown-item">Logout</a>
            </div>
          </a>
          
          <script>
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var today  = new Date();
            var d = today.toLocaleDateString("en-US", options);
            document.getElementById("demo").innerHTML = d;
            // var user = "<?php //echo($_SESSION['access']);?>";
            // document.getElementById("user").innerHTML = user;
            
          </script>
        </div>
      </nav>
      <div class="header-img bg-white shadow row">
        <img src="../../pictures/logo-new.png" class="pl-1 pt-3 pb-3 pr-0 auto-margin-left">
        <div class="col">
          <div class="row mt-3">
            <p class='mb-0'>
              <span class="head-text text-maroon"><em>JUAN</span><span class="head-text text-secondary">SCI</em>
              <span class="h4 mt-0"> PORTAL</p>
          </div>
          <nav class="d-none d-md-block row navbar pt-0 w-75">
          <a class="lead p-0" id="lead"></a>
          <div class="float-right mt-2" id="back-to-menu">
            <a href="dashboard.php" class="text-danger h6 mr-5">
            <i class="fa fa-caret-left"></i> Back to Menu</a>
          </div>
          </nav>
        </div>

      </div>
      