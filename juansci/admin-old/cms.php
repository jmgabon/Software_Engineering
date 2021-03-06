<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Content Management System</title>
    <link rel="stylesheet" type="text/css" href="../css/Home.css" />
    <link rel="stylesheet" type="text/css" href="../css/all.css" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
    <link rel="icon" href="../pictures/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="arr-to-top fas fa-caret-square-up"></i></button>
    <div class="header">
    <img src="../pictures/logodesign.jpg" class="w-100" />
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
    <div class="tight-container">
        <h3 class=" pb-2 mb-4 bd-bottom"><i class="far fa-newspaper pr-2"></i>NEWS AND UPDATES</h3>
            <div class="container">
            	<button class="btn-sm btn-light border-dark ml-4">Add to Section</button>
            	<select class="btn-sm btn-light border-dark ml-4">
            		<option>Title</option>
            		<option>Author</option>
            		<option>Date</option>
            	</select>
            	<input class="btn-sm btn-light border-dark ml-4" type="text" id="searchbox" name="searchbox">
            	<button class="btn-sm btn-light border-dark ml-4">Search</button>
            	<p style="margin-bottom: 4%;"></p>
            <ul class="list-unstyled">
                <li class="media">
                <img class="news-img mt-1 mb-1 rounded mr-3" src="../pictures\news-1.png" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">List-based media object</h5>
                    <span>Date</span>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                    <button class="btn btn-outline-maroon btn-sm">
                        Read More<i class="fas fa-caret-right ml-2"></i></button>
                    <span style="float: right;">By Author</span>
                </div>
                </li>
            </ul>
            <!-- PAGINATION -->
            <!-- <nav aria-label="...">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                  </li>
                  
                  <li class="page-item active">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav> -->
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
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="../js/cms.js"></script>
    <script type="text/javascript" src="../js/crud.js"></script>
</body>
</html>