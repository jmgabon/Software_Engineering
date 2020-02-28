<!DOCTYPE html>
<html>
    <head>
        <title>JuanSci Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/merged-styles.css"/>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/modal.css"/>
        <link rel="stylesheet" type="text/css" href="../css/newdb.css">
        <link rel="stylesheet" type="text/css" href="../css/all.css"/>
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Righteous|Russo+One&display=swap"> -->
        <link rel="icon" href="../pictures/logo-new.png">
    </head>
    <script src="../js/jquery-3.4.1.js"></script>
    
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
            // var user = "<?php //echo($_SESSION['access']);?>";
            // document.getElementById("user").innerHTML = user;
          </script>
        </div>
      </nav>
      <div class="header-img bg-white shadow row">
        <img src="../pictures/logo-new.png" class="pl-1 pt-3 pb-3 pr-0 auto-margin-left">
        <div class="col">
          <div class="row mt-3">
            <p class='mb-0'>
              <span class="head-text text-maroon"><em>JUAN</span><span class="head-text text-secondary">SCI</em>
              <span class="h4 mt-0"> PORTAL</p>
          </div>
          <nav class="d-none d-md-block row navbar pt-0 mr-5">
          <a class="lead p-0" id="lead"></a>
            <div class="d-inline-block float-right">
            
            </div>
          </nav>
        </div>

      </div>
      