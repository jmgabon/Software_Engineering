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

    <style type="text/css">
          #Results{
            width: 100% !important;
            margin-top: 3rem !important;
          }
    </style>
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
        <!-- <p style="text-align: left;">* - REQUIRED</p> -->
          <div class="ml-auto d-none d-md-block">
            
            <a href="" class="btn btn-danger text-light" style="display: none;"></a>
            <a href="" class="btn btn-danger text-light" style="display: none;"></a>
            <!-- <a href="../" class="btn btn-danger text-light">Manage Home</a> -->
          </div>
      </nav>
      <!---------------SIDEBAR--------------->

      <nav class="d-md-block bg-white sidebar shadow collapse navbar-collapse" id="navbarNav">
        <div class="sidebar-sticky">
          <a href="dashboard.php">
            <img src="../../pictures/logo2.png" width="200px" class="ml-2 mt-3 mb-5">
          </a>
          <ul class="nav flex-column mt-2">
            
            <li class="nav-item dropdown">
              <a id="student" class="nav-link dropdown-toggle" href="#" 
              id="studentsDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-graduate mr-2 "></i>
                Students
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="studentsDropdown">
                <a href="masterlist_student.php" class="dropdown-item">Masterlist</a>
                <a href="regrequests_student.php" class="dropdown-item">Requests</a>
                <!-- <a href="student_lst.php" class="dropdown-item">Masterlist</a> -->
                <!-- <a href="student_rec__old_css.php" class="dropdown-item">Form 137</a> -->
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="teacher" class="nav-link dropdown-toggle" href="#" 
              id="teachersDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-graduate mr-2 "></i>
                Teachers
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="teachersDropdown">
                <a href="masterlist_teacher.php" class="dropdown-item">Masterlist</a>
                <a href="requests_teacher.php" class="dropdown-item">Requests</a>
                <!-- <a href="student_lst.php" class="dropdown-item">Masterlist</a> -->
                <!-- <a href="student_rec__old_css.php" class="dropdown-item">Form 137</a> -->
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="student" class="nav-link dropdown-toggle" href="#" 
              id="gradesDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-book mr-2"></i>
                Grades
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="gradesDropdown">
                <a href="../common/Grade_Subject.php" class="dropdown-item">Evaluation</a>
                <a href="../common/Grade_Transferee.php" class="dropdown-item">For Transferee</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="room" class="nav-link dropdown-toggle" href="#" 
              id="roomDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chalkboard mr-2"></i>
                Rooms
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="roomDropdown">
                <a href="masterlist_room.php" class="dropdown-item">List of Rooms</a>
                <a href="requests_room.php" class="dropdown-item">Requests</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="subject" class="nav-link dropdown-toggle" href="#" 
              id="subjectDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-book mr-2"></i>
                Subjects
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="subjectDropdown">
                <a href="masterlist_subjectcode.php" class="dropdown-item">List of Subjects</a>
                <a href="requests_subjectcode.php" class="dropdown-item">Requests</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a id="section" class="nav-link dropdown-toggle" href="#" 
              id="sectionDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-chalkboard-teacher mr-2"></i>
                Sections
                </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="subjectDropdown">
                <a href="masterlist_section.php" class="dropdown-item">List of Sections</a>
                <a href="requests_section.php" class="dropdown-item">Requests</a>
              </div>
            </li>
            <!-- <li class="nav-item">
              <a id="schedule" class="nav-link dropdown-toggle" href="#" 
                id="schedulesDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-clock mr-2"></i>
                Schedules
              </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="schedulesDropdown">
                <a href="masterlist_schedule.php" class="dropdown-item">Masterlist</a>
                <a href="requests_schedule.php" class="dropdown-item">Requests</a>
              </div>
            </li> -->
            <li class="nav-item">
              <a id="schedule" class="nav-link" href="schedule.php">
                <i class="fas fa-clock mr-2"></i>
                Schedules
              </a>
            </li>
            <!-- <li class="nav-item">
                <a id="room" class="nav-link" href="RoomCreation.php">
                    <i class="fas fa-chalkboard mr-2"></i>
                    Rooms
                </a>
            </li> -->
            <!-- <li class="nav-item">
              <a id="employee" class="nav-link dropdown-toggle" href="#" 
                id="employeesDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-briefcase mr-2"></i>
                 Employees
              </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="employeesDropdown">
                <a href="employee_reg.php" onclick="RemoveStorage()" class="dropdown-item">Registration</a>
                <a href="employee_lst.php" class="dropdown-item">Masterlist</a>
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
                <a href="sched_sections.php" class="dropdown-item">Sections</a>
                <a href="sched_teachers.php" class="dropdown-item">Teachers</a>
              </div>
            </li>
            <li class="nav-item">
              <a id="subject" class="nav-link" href="subjects.php">
                <i class="fas fa-book mr-2 "></i>
                Subjects
              </a>
            </li>
            <li class="nav-item">
              <a id="section" class="nav-link" href="sections.php">
                <i class="fa fa-chalkboard-teacher mr-2 "></i>
                Sections
              </a>
            </li>
            <li class="nav-item">
                <a id="room" class="nav-link" href="rooms.php">
                    <i class="fas fa-chalkboard mr-2"></i>
                    Rooms
                </a>
            </li>-->
            <li class="nav-item">
              <a id="setting" class="nav-link dropdown-toggle" href="#" 
                id="settingsDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog mr-2"></i>
                Settings
              </a>
              <div class="dropdown-menu pl-5 bg-light" aria-labelledby="settingsDropdown">
                <a href="setting_gradeConfig.php" class="dropdown-item">Grade Configuration</a>
                <a href="setting_gradeSortable.php" class="dropdown-item">Learning Areas Sorting</a>
                <!-- <a href="logs.php" class="dropdown-item">Logs</a> -->
              </div>
            </li>
              
          </ul>
            <div class="text-center text-light mt-5">
              <a class="btn btn-danger btn-sm pl-4 pr-4"><i class="fas fa-question-circle mr-2"></i>Help</a>
            </div>
        </div>
      </nav>
      <script type="text/javascript">
      function RemoveStorage(){
        sessionStorage.removeItem('EmployeeInfo');   
      }
         // sessionStorage.removeItem('EmployeeInfo');  
      </script>
      