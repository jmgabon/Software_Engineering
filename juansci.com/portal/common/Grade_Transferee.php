<?php
    session_start();
    
    if($_SESSION['TeacherNum'] === null || !($_SESSION['AccessType'] === 'principal'
    xor $_SESSION['AccessType'] === 'coordinator')){
        header('Location: ../');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JuanSci Portal</title>

    <link rel="stylesheet" type="text/css" href="../../css/modal.css" />
    <link rel="stylesheet" type="text/css" href="../../css/all.css" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../css/merged-styles.css" />
    <link rel="stylesheet" type="text/css" href="../../css/newdb.css">
    <link rel="icon" href="../../pictures/logo-new.png" />
</head>

<script src="../../js/jquery-3.4.1.js"></script>
    
<nav class="sticky-top navbar shadow bg-dark text-light navbar-expand-lg">
        <div class="container-fluid">
          <p id="demo" class="m-0 p-0 d-none d-md-block"></p>
          <a class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user p-0 m-0"></i>
              <!-- <span class="text-capitalize ml-1"><?php //echo $fullname?></span> -->
            </a>
            <div class="d-none" id="divDropdown">
                <a href="" class="dropdown-item">Profile</a>
                <a href="../" class="dropdown-item">Logout</a>
            </div>
          </a>
          
          <script type="text/javascript">
            
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var today  = new Date();
            var d = today.toLocaleDateString("en-US", options);
            document.getElementById("demo").innerHTML = d;            
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
            <?php if ($_SESSION['AccessType'] == "principal") { ?>
              <a href="../principal/dashboard.php" class="text-danger h6 mr-5">
            <?php } else if ($_SESSION['AccessType'] == "coordinator") { ?>
              <a href="../coordinator/dashboard.php" class="text-danger h6 mr-5">
            <?php } ?>
            <i class="fa fa-caret-left"></i> Back to Menu</a>
          </div>
          </nav>
        </div>
      </div>

    <div class="grade-container mt-5">
        <div id="modal">
            <div id="modal-content">
                <span id="close" onclick="closeModal(document.getElementById('modal-body'));">&times;</span>
                <div id="modal-header">
                    <h2 id="modal-title"></h2>
                </div>

                <div id="modal-body">
                </div>

                <div id="modal-footer">
                </div>
            </div>
        </div>

        <div class="">
            <div class="float-right hide-on-print">
                <input type="text" id="txt_LRNNum" style="display: none;" />
                <label for="">Select Student: <input class="ml-2 sec-name" type="text" id="txt_StudentModal" required disabled/></label>
                <button class="modal-button"><i class="far fa-window-restore"></i></button>
            </div>
            <br /><br />

            <div class="float-right">
                <label style="display: block">Select Grade Level:
                    <select id="select_GrLvl">
                        <option disabled selected value>?</option>
                    </select>
                </label>
            </div>
            <br /><br />

            
            <div class="float-right">
                <label id="labelMAPEH" for="" style="display: none">Select MAPEH:
                    <select id="selectMAPEH" onchange="setSubMAPEH()">
                        <option disabled selected value> -- Select MAPEH -- </option>
                        <option value="MUSIC">MUSIC</option>
                        <option value="ARTS">ARTS</option>
                        <option value="PE">PE</option>
                        <option value="HEALTH">HEALTH</option>
                    </select>
                </label>
            </div>


            <br />
            <p><b>Student Name: </b><span id="txt_StudentName"></span></p>
            <br />
        </div>
        <div class="row">
            <div class="col-6 p-0 m-0">
                <table id="tableSubject" class="g-table"><h5 class="">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</h5>
                    <thead class="dark">
                        <tr>
                            <th rowspan="2">Learning Areas</th>
                            <th colspan="4">Quarter</th>
                            <th rowspan="2" class="w-adjust-print">Final Grade</th>
                            <th rowspan="2">Remarks</th>
                        </tr>
                        <tr>
                            <th class="w-25px">1</th>
                            <th class="w-25px">2</th>
                            <th class="w-25px">3</th>
                            <th class="w-25px">4</th>
                        </tr>
                    </thead>

                    <tbody id="tbodySubject"></tbody>
                </table>
            </div>
        </div>
                    
        
        <br />
        <div class="row">
            <div class="col-6 p-0 m-0">
                <table id="CreateGradeTable" class="g-table">
                    <h5 class="">ADD SUBJECT AND GRADES</h5>
                    <thead class="dark">
                        <tr>
                            <th id="student" rowspan="2">Learning Areas</th>
                            <th colspan="4">Quarter</th>
                            <th id="final" rowspan="2">Final Grade</th>
                            <th id="remark" rowspan="2">Remarks</th>
                            <th id="remark" rowspan="2"></th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td id="selectSubjCode">CLICK HERE</td>
                            <td><input type="input" style="width:3em" maxlength="3" id="q1" disabled></td>
                            <td><input type="input" style="width:3em" maxlength="3" id="q2" disabled></td>
                            <td><input type="input" style="width:3em" maxlength="3" id="q3" disabled></td>
                            <td><input type="input" style="width:3em" maxlength="3" id="q4" disabled></td>
                            <td></td>
                            <td></td>
                            <td><button disabled="" id="btn_AddGrade">ADD</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'partials/footer.php'; ?>
    <script>
        let TeacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let AccessType = '<?php echo $_SESSION['AccessType']?>';

        console.log('AccessType: ' + AccessType);
        console.log('TeacherNum: ' + TeacherNum);
    </script>
    <script src="js/Grade_Transferee.js" type="text/javascript"></script>
</body>
</html>