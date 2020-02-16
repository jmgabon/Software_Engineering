<!DOCTYPE html>
<html>
    <head>
        <title>JuanSci Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type="text/css" href="bootstrap.css"/>
        <link rel = "stylesheet" type="text/css" href="all.css"/>
        <link rel="stylesheet" type="text/css" href="../css/merged-styles.css">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="dbstyles.css" rel="stylesheet">
    </head>
    <script src="../js/jquery-3.4.1.js"></script>
    <body id="test1" class="bg-light">
      <!---------------TOPNAV--------------->
      <nav class="sticky-top navbar shadow bg-dark text-light navbar-expand-lg">
        <div class="container-fluid">
          <p id="demo" class="m-0 p-0"></p>
          <script>
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var today  = new Date();
            var d = today.toLocaleDateString("en-US", options);
            document.getElementById("demo").innerHTML = d;

          </script>
          <a class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user p-0 m-0"></i>
            </a>
          </a>
        </div>
      </nav>
      
      <!----------------MIDNAV---------------->
      <nav class="navbar shadow bg-white navbar-expand-lg">
        <p id="lead" class="lead nav-item mr-auto lead-margin mb-0"></p>
        <button id="slide" class="navbar-toggler d-md-none" type="button" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars text-dark"></i>
        </button>
        
          <div class="ml-auto d-none d-md-block">
            
            <a class="btn btn-danger text-light">Manage Home</a>
          </div>
      </nav>
      <!---------------SIDEBAR--------------->

      <nav class="d-md-block bg-white sidebar shadow collapse navbar-collapse" id="navbarNav">
        <div class="sidebar-sticky">
        <img src="logo2.png" width="200px" class="ml-2 mt-2 mb-4">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a id="dashboard" class="nav-link" href="index.php">
                <span data-feather="home"></span>
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a id="student" class="nav-link dropdown-toggle" href="#" 
              id="studentsDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-graduate mr-2 "></i>
                Students
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="studentsDropdown">
                <a href="student_reg.php" class="dropdown-item">Registration</a>
                <a href="#" class="dropdown-item">Drafting</a>
                <a href="#" class="dropdown-item">Masterlist</a>
              </div>
            </li>
            <li class="nav-item">
              <a id="employee" class="nav-link dropdown-toggle" href="#" 
                id="employeesDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-briefcase mr-2"></i>
                 Employees
              </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="employeesDropdown">
                <a href="#" class="dropdown-item">Registration</a>
                <a href="#" class="dropdown-item">Masterlist</a>
              </div>
            </li>
            <li class="nav-item">
              <a id="schedule" class="nav-link dropdown-toggle" href="#" 
                id="schedulesDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-clock mr-2"></i>
                Schedules
              </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="schedulesDropdown">
                <a href="#" class="dropdown-item">Sections</a>
                <a href="#" class="dropdown-item">Teachers</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fas fa-book mr-2 "></i>
                Subjects
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa fa-chalkboard-teacher mr-2 "></i>
                Sections
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chalkboard mr-2"></i>
                    Rooms
                </a>
            </li>
            <li class="nav-item  mb-5">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog mr-2"></i>
                    Settings
                </a>
            </li>
              
          </ul>
            <div class="text-center text-light mt-5">
              <a class="btn btn-danger btn-sm pl-4 pr-4"><i class="fas fa-question-circle mr-2"></i>Help</a>
            </div>
        </div>
      </nav>