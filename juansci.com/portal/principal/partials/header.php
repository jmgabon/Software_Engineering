<?php
  session_start();
  $_SESSION['TeacherNum'] = 1;
  $_SESSION['AccessType'] = "principal";
  if($_SESSION['TeacherNum'] === null || $_SESSION['AccessType'] != "principal"){
    header('Location: ../');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>JuanSci Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/modal.css">
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/merged-styles.css">
        <link rel="stylesheet" type="text/css" href="../../css/dbstyles.css">
        <link rel="stylesheet" type="text/css" href="../../css/all.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Righteous&display=swap">
        <link rel="icon" href="../../pictures/logo-new.png">
    </head>
    <script src="../../js/jquery-3.4.1.js"></script>
    <body id="test1" class="bg-light">
      <!---------------TOPNAV--------------->
      
      <nav class="sticky-top navbar shadow bg-dark text-light navbar-expand-lg">
        <div class="container-fluid">
          <p id="demo" class="m-0 p-0"></p>
          
          <a class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user p-0 m-0"></i>
              <span id="user" class="text-capitalize ml-1"></span>
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
            var user = "<?php echo($_SESSION['AccessType']) ?>"; 
            var userID = "<?php echo($_SESSION['TeacherNum'])?>"; 
            // var user = "echo($_SESSION['access']"
            document.getElementById("user").innerHTML = user;
          </script>
        </div>
      </nav>
      
      <!----------------MIDNAV---------------->
      <nav class="navbar shadow bg-white navbar-expand-lg">
      
        <p id="lead" class="lead nav-item mr-auto lead-margin mb-0"></p>
        <a id="slide" class="navbar-toggler d-md-none" type="button" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars text-dark"></i>
        </a>
          <div class="ml-auto d-none d-md-block">
            <a href="" class="btn btn-danger text-light">Manage Home</a>
          </div>
      </nav>
      <!---------------SIDEBAR--------------->

      <nav class="d-md-block bg-white sidebar shadow collapse navbar-collapse" id="navbarNav">
        <div class="sidebar-sticky">
        <img src="../../pictures/logo2.png" width="200px" class="ml-2 mt-2 mb-4">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a id="dashboard" class="nav-link" href="dashboard.php">
                <span data-feather="home"></span>
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a id="dashboard" class="nav-link" href="Requests.php">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Requests <span class="sr-only">(current)</span>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a id="dashboard" class="nav-link" href="UserControl.php">
                <i class="fas fa-tachometer-alt mr-2"></i>
                User Control <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a id="section" class="nav-link" href="UserControl.php">
                <i class="fa fa-chalkboard-teacher mr-2 "></i>
                Sections
              </a>
            </li> -->
            <li class="nav-item">
              <a id="section" class="nav-link" href="Requests.php">
                <i class="fa fa-chalkboard-teacher mr-2 "></i>
                Requests
              </a>
            </li>
            <li class="nav-item">
              <a id="subject" class="nav-link" href="UserControl.php">
                <i class="fas fa-book mr-2 "></i>
                User Control
              </a>
            </li>
          </ul>
            <!-- <div class="text-center text-light mt-5">
              <a class="btn btn-danger btn-sm pl-4 pr-4"><i class="fas fa-question-circle mr-2"></i>Help</a>
            </div> -->
        </div>
      </nav>
      <script type="text/javascript">
      function RemoveStorage(){
        sessionStorage.removeItem('EmployeeInfo');   
      }
         // sessionStorage.removeItem('EmployeeInfo');  
      </script>
      