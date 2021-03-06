<?php

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>HOME - San Juan City Science High School</title>
    <link rel="stylesheet" type="text/css" href="css\Home.css" />
    <link rel="stylesheet" type="text/css" href="css\all.css" />
    <link rel="stylesheet" type="text/css" href="css\bootstrap.css" />
    <link rel="icon" href="pictures\logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js\jquery-3.4.1.js"></script>
    <script type="text/javascript" src="js\bootstrap.bundle.min.js"></script>
</head>
<body class="bg">

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="arr-to-top fas fa-caret-square-up"></i></button>
        <div class="header">
            <img src="pictures\logodesign2.jpg" class="w-100" />
        </div>
        <!--=================== NAVBAR-===================-->
        <div class="navbar shadow h6 navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="navbar-brand hoverable selected" href="#">Home</a>
                    </li>
                    <li class="nav-item active dropdown">
                         <a class="navbar-brand hoverable" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About JuanSci<span class="fas arr-down fa-caret-down"></span></a>
                            <div class="dropdown-menu rounded-0">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="navbar-brand hoverable" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">News & Updates<span class="arr-down fas fa-caret-down"></span></a>
                            <div class="dropdown-menu rounded-0">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="navbar-brand hoverable" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Programs<span class="fas arr-down fa-caret-down"></span></a>
                             <div class="dropdown-menu rounded-0">
                                  <a class="dropdown-item" href="#">Action</a>
                                  <a class="dropdown-item" href="#">Another action</a>
                                  <a class="dropdown-item" href="#">Something else here</a>
                                  <div class="dropdown-divider"></div>
                                  <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                    <li class="nav-item active">
                        <a class="navbar-brand hoverable" href="#">Transparency</a>
                    </li>
                    <li class="nav-item active">
                        <a class="navbar-brand hoverable" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="search form-inline">
              <div">
                <div class="input-group">
                  <input id="search" type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                    <div class="input-group-append">
                      <button id="button-addon1" type="submit" class="btn btn-link text-light searchbtn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
              </div>
            </div>
        </div>

        <!-- =================CAROUSEL================== -->
        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselIndicators" data-slide-to="1"></li>
                <li data-target="#carouselIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="pictures\carousel-1.png" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="pictures\carousel-2.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="pictures\carousel-3.png" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>

        <!-- ==================NEWS AND UPDATES================ -->
        <div class="mycontainer mt-5">
          <div class="row">
            <div class="col-xl-8">
              <h4 class="p-2 pb-3"><i class="far fa-newspaper pr-2"></i>Latest News and Updates</h4>
              <div class="container">
                <!-- NEWS 1 -->
                <div class="media container pb-2 mt-2 border-bottom row">
                  <img src="pictures\news-1.png" class="news-img mt-1 mb-1 rounded mr-3" alt="...">
                  <div class="media-body col">
                    <p class="mt-0 h5">Media heading
                      <span class="float-right h6 text-secondary">Jan 01, 2020</span></p>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum... </p>
                    <button class="btn btn-outline-primary btn-sm mr-2 float-right">
                      Read More<i class="fas fa-caret-right ml-2"></i></button>
                  </div>
                </div>
                <!-- NEWS 2 -->
                <div class="media container pb-2 mt-2 border-bottom row">
                  <img src="pictures\news-2.png" class="news-img mt-1 mb-1 rounded mr-3" alt="...">
                  <div class="media-body col">
                    <p class="mt-0 h5">Media heading
                    <span class="float-right h6 text-secondary">Jan 01, 2020</span></p>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum... </p>
                    <button class="btn btn-outline-primary btn-sm mr-2 float-right">
                      Read More<i class="fas fa-caret-right ml-2"></i></button>
                  </div>
                </div>
                <!-- NEWS 3 -->
                <div class="media container pb-2 mt-2 border-bottom row">
                  <img src="pictures\news-3.png" class="news-img mt-1 mb-1 rounded mr-3" alt="...">
                  <div class="media-body col">
                    <p class="mt-0 h5">Media heading
                      <span class="float-right h6 text-secondary">Jan 01, 2020</span></p>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. 
                      Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. 
                      Fusce condimentum... </p>
                    <button class="btn btn-outline-primary btn-sm mr-2 float-right">
                      Read More<i class="fas fa-caret-right ml-2"></i></button>
                  </div>
                </div>
              </div>  
            </div>
            <div class="col-xl-4">
              <h4 class="p-2 pb-3"><i class="fas fa-bullhorn"></i> Announcements</h4>
              <ul class="fa-ul ml-5">
                <li class="mb-2"><a href=# class="maroon"><span class="fa-li"><i class="fas fa-caret-right"></i></span>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                </a></li>
                <li class="mb-2"><a href=# class="maroon"><span class="fa-li"><i class="fas fa-caret-right"></i></span>
                  Lorem ipsum dolor sit amet,  incididunt ut labore et dolore magna aliqua.
                </a></li>
                <li class="mb-2"><a href=# class="maroon"><span class="fa-li"><i class="fas fa-caret-right"></i></span>
                  At vero eos et accusamus voluptatum deleniti atque corrupti quos dolores et quas.
                </a></li>
                <li class="mb-2"><a href=# class="maroon"><span class="fa-li"><i class="fas fa-caret-right"></i></span>
                  Lorem ipsum dolor sit amet,  incididunt ut labore et dolore magna aliqua.
                </a></li>
                
              </ul>
              <div>
                <h4 class="p-2 pt-3"><i class="far fa-calendar-alt"></i> School Calendar</h4>
                <iframe src="https://calendar.google.com/calendar/embed?height=300&amp;wkst=1&amp;ctz=Asia%2FManila&amp;src=ZW4ucGhpbGlwcGluZXMjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%230B8043&amp;showTitle=0&amp;showPrint=0&amp;showNav=1&amp;showTabs=0&amp;showTz=0&amp;showCalendars=0&amp;title" style="border-width:0" width="100%" height="300" frameborder="0" scrolling="no"></iframe>
              </div>
            </div>
          </div>
     
        </div>

        <div class="row footer-two">
          <div class="important-links">
            <p class="text-light pt-2 pb-0 mb-0 ml-5"><i class="fas fa-external-link-alt"> </i> IMPORTANT LINKS</p>
            <ul class="ml-5 pb-3 list-group list-group-flush">
                <li class="list-group-item p-2 ml-2 bg-transparent border-bottom h6">
                  <a class="text-light" href=#>TRANSPARENCY SEAL</a>
                </li>
                <li class="list-group-item p-2 ml-2 bg-transparent border-bottom h6">
                  <a class="text-light" href="Portal.php">JUANSCI PORTAL</a>
                </li>
            </ul>
          </div>
        </div>

        <div class="row footer text-light row">
            <div class="col foottext">
                © 2019 - San Juan Science High School. All Rights Reserved
            </div>
            <div class="col footlogo float-right">
                <a class="text-light" href="#"><span class="fab fa-google-plus-square"></span></a>
                <a class="text-light" href="#"><span class="fab fa-twitter-square"></span></a>
                <a class="text-light" href="https://web.facebook.com/San-Juan-City-Science-High-School-614122265693169/"><span class="fab fa-facebook-square"></span></a>
            </div>
        </div>

    <script type="text/javascript" src="js\Home.js"></script>
</body>
</html>
