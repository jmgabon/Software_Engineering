<?php
    session_start();
    
    if ($_SESSION['AccessType'] === '') {
        if($_SESSION['TeacherNum'] === null) {
            header('Location: ../');
        }

        // checks if Adviser
        include '../../php/ConnectToDB.php';
        $stmt = $db->prepare('SELECT Adviser FROM main_section WHERE Adviser = ?');
        $stmt->bindValue(1, $_SESSION['TeacherNum']);
        $stmt->execute();
        $col = $stmt->fetch();
        $stmt->closeCursor();

        // if not Adviser, logout
        if (empty($col[0])) {
            header('Location: ../');
        }
    } else if ($_SESSION['AccessType'] === 'student') {
        if($_SESSION['LRNNum'] === null){
            header('Location: ../');
        }
    } else {
        header('Location: ../');
    }

    // include '../php/Header_User.php';
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
            // var user = "<?php //echo($_SESSION['AccessType']);?>";
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
            <?php if ($_SESSION['AccessType'] == "principal") { ?>
              <a href="../principal/dashboard.php" class="text-danger h6 mr-5">
            <?php } else if ($_SESSION['AccessType'] == "coordinator") { ?>
              <a href="../coordinator/dashboard.php" class="text-danger h6 mr-5">
            <?php } else if ($_SESSION['AccessType'] == "") { ?>
              <a href="../teacher/dashboard.php" class="text-danger h6 mr-5">
            <?php } else if ($_SESSION['AccessType'] == "student") { ?>
              <a href="../../student_portal/student/dashboard.php" class="text-danger h6 mr-5">
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
            <?php if($_SESSION['AccessType'] == "") { ?>
                <div class="float-right hide-on-print">
                    <input type="text" id="txt_LRNNum" style="display: none;" />
                    <label for="">Select Student: <input class="ml-2 sec-name" type="text" id="txt_StudentModal" required disabled/></label>
                    <button class="modal-button"><i class="far fa-window-restore"></i></button>
                </div>
            <?php } ?>

            <?php if($_SESSION['AccessType'] == "student") { ?>
                <div class="float-right">
                    <label style="display: block">Select Grade Level:
                        <select id="select_GrLvl"></select>
                    </label>
                </div>
            <?php } ?>


            <br />
            <p><b>Adviser Name: </b><span id="txt_AdviserName"></span></p>
            <p><b>Section Name: </b><span id="txt_SectionName"></span></p>
            <p><b>Grade Level: </b><span id="txt_GradeLevel"></span></p>
            <br />
            <p><b>Student Name: </b><span id="txt_StudentName"></span></p>
            <br />
        </div>
        <div class="row">
            <div class="col-6 p-0 m-0">
                <button id="btn_encode" style="display: none" disabled>ENCODE</button>

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
                <div class="p-0 mt-3">
                    <pre>
                        <b>Descriptors                 Grade       Remarks</b>
                        Outstanding                 90-100      Passed
                        Very Satisfactory           85-89       Passed
                        Satisfactory                80-84       Passed
                        Fairly Satisfactory         75-79       Passed
                        Did Not Meet Expectations   Below-75    Failed
                    </pre>
                </div>
            </div>

            <div class="col-6">
                <table id="tableValues" class="g-table"><h5 class="">REPORT ON LEARNER'S OBSERVED VALUES</h5>
                    <thead class="dark">
                        <tr>
                            <th rowspan="2" class="w-25">Core Values</th>
                            <th rowspan="2">Behavior Statement</th>
                            <th colspan="4">Quarter</th>
                        </tr>
                        <tr>
                            <th class="w-25px">1</th>
                            <th class="w-25px">2</th>
                            <th class="w-25px">3</th>
                            <th class="w-25px">4</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyValues">
                        <tr>
                            <td rowspan="2"><b>1. Maka-Diyos</b></td>
                            <td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td>Shows adherence to ethical principles by upholding truth</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td rowspan="2"><b>2. Makatao</b></td>
                            <td>Is sensitive to individual, social, and cultural differences</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td>Demonstrates contributions towards solidarity</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td rowspan="2"><b>3. Makakalikasan</b></td>
                            <td>Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td>Demonstrates pride in being a Filipino; exercises the right and responsibilities of Filipino citizen</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>

                        <tr>
                            <td><b>4. Makabansa</b></td>
                            <td>Demonstrates appropriate behavior in carrying out activities in the school community, and country</td>
                            <td class="grValQ1"></td>
                            <td class="grValQ2"></td>
                            <td class="grValQ3"></td>
                            <td class="grValQ4"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="p-0 mt-3">
                    <pre>
                        <b>Marking          Non-numerical Rating</b>
                        <b> AO</b> -            Always Observed
                        <b> SO</b> -            Sometimes Observed
                        <b> RO</b> -            Rarely Observed
                        <b> NO</b> -            Not Observed
                    </pre>  
                </div>
            </div>
        </div>

      

        <?php //if($_SESSION['AccessType'] === '') { ?>
        <div class="hide-on-print float-right d-inline-block mb-5">
            <select id="print-select" class="form-control-sm">
                <option>Outer Page</option>
                <option>Inner Page</option>
            </select>
            
            <br /><button id='print-btnO' class="btn btn-sm btn-danger mb-1">Print Outer Page</button>

            <script type="text/javascript">
                var selected = 'Outer Page';

                $('#print-select').change(function(){
                    selected = $('#print-select').val();
                    if(selected == 'Outer Page'){
                        $('#print-btnO').show();
                        $('#print-btnI').hide();
                    } else if(selected == 'Inner Page'){
                        $('#print-btnO').hide();
                        $('#print-btnI').show();

                        if (txt_StudentName.textContent === '') {
                            $('#print-btnI').attr('disabled', true);
                            alert('Please select student first!');
                        }
                    }
                });

                $('#print-btnO').click(function(){
                    printInnerReportCard();
                });
            </script>

            <form id="postData" action="Grade_oView.php" method="post" target="_blank">
                <button id='print-btnI' class="btn btn-sm btn-danger mb-1" style="display: none">Print Inner Page</button>

                <input type="hidden" name="LRNNum" value="">
                <input type="hidden" name="schoolYear" value="">
                <input type="hidden" name="studentName" value="">
                <input type="hidden" name="studentAge" value="">
                <input type="hidden" name="studentSex" value="">
                <input type="hidden" name="GradeLevel" value="">
                <input type="hidden" name="sectionName" value="">
                <input type="hidden" name="principalName" value="">
                <input type="hidden" name="adviserName" value="">

                <script type="text/javascript">
                    $('#print-btnI').click(function(){
                        AddPostData();
                    });
                </script>
            </form>
        </div>
        <?php //} ?>

        <!-- <?php //if($_SESSION['AccessType'] === 'teacher') { ?>
            <button class="btn btn-dark" onclick="printInnerReportCard()">PRINT INNER PAGE OF FORM 138</button>
        <?php //} ?>
        
        <form id="postData" action="../teacher/Grade_oView.php" method="post" target="_blank">
            <input type="hidden" name="LRNNum" value="">
            <input type="hidden" name="schoolYear" value="">
            <input type="hidden" name="studentName" value="">
            <input type="hidden" name="studentAge" value="">
            <input type="hidden" name="studentSex" value="">
            <input type="hidden" name="GradeLevel" value="">
            <input type="hidden" name="sectionName" value="">
            <input type="hidden" name="principalName" value="">
            <input type="hidden" name="adviserName" value="">

            <?php //if($_SESSION['AccessType'] === 'teacher') { ?>
                <input type="submit" class="btn btn-dark" value="PRINT OUTER PAGE OF FORM 138" onclick="AddPostData()">
            <?php //} ?>
        </form> -->
    </div>

    <?php include 'partials/footer.php'; ?>
    <script>
        $('#lead').text("View Student's Grade");
        let LRNNum;
        let TeacherNum;
        let AccessType = '<?php echo $_SESSION['AccessType']?>';

        if (AccessType === '') {
            AccessType = 'teacher';
        }

        console.log('AccessType: ' + AccessType);
        <?php if($_SESSION['AccessType'] === '') { ?>
            TeacherNum = <?php echo $_SESSION['TeacherNum']?>;
            console.log('TeacherNum: ' + TeacherNum);
        <?php } else if($_SESSION['AccessType'] === 'student') { ?>
            LRNNum = <?php echo $_SESSION['LRNNum']?>;
            console.log('LRNNum: ' + LRNNum);
        <?php } ?>
    </script>
    <script src="js/Grade_View.js" type="text/javascript"></script>
</body>
</html>