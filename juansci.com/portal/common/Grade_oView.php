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

    if(isset($_POST['LRNNum'])){
        $LRNNum = ($_POST['LRNNum'] !== 'undefined') ? $_POST['LRNNum'] : 'N/A';
        $schoolYear = ($_POST['schoolYear'] !== 'undefined') ? $_POST['schoolYear'] : 'N/A';
        $studentName = ($_POST['studentName'] !== 'undefined') ? $_POST['studentName'] : 'N/A';
        $studentAge = ($_POST['studentAge'] !== 'undefined') ? $_POST['studentAge'] : 'N/A';
        $studentSex = ($_POST['studentSex'] !== 'undefined') ? $_POST['studentSex'] : 'N/A';
        $GradeLevel = ($_POST['GradeLevel'] !== 'undefined') ? $_POST['GradeLevel'] : 'N/A';
        $sectionName = ($_POST['sectionName'] !== 'undefined') ? $_POST['sectionName'] : 'N/A';
        $principalName = ($_POST['principalName'] !== 'undefined') ? $_POST['principalName'] : 'N/A';
        $adviserName = ($_POST['adviserName'] !== 'undefined') ? $_POST['adviserName'] : 'N/A';     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Report Card (Cover Pages)</title>

    <link rel="stylesheet" type="text/css" href="../../css/modal.css" />
    <link rel="stylesheet" type="text/css" href="../../css/all.css" />
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../css/merged-styles.css" />
    <link rel="icon" href="../../pictures/logo-new.png" />
</head>

<body onload="printOuterReportCard()">
    <img src="../../pictures/logodesign2.jpg" class="logodesign hide-on-print">

    <div class="hide-on-print header mb-3">
        <legend class="h4 pl-0 pt-3 mb-0">ADVISER'S VIEW: STUDENT GRADE</legend>

        <div class="menu">
        <!-- <a href="#"><?php // echo 'Welcome, ' . $honorific . $fullname?></a>|<a href="Dashboard.php">Menu</a>|<a href="../">Logout</a> -->
        </div>

    </div>

    <div class="grade-container">

        <div class="hide-on-print">
            <p><b>Adviser Name: </b><?php echo $adviserName ?></p>
            <p><b>Section Name: </b><?php echo $sectionName ?></p>
            <p><b>Grade Level: </b><?php echo $GradeLevel ?></p>
            <br />
            <p><b>Student Name: </b><?php echo $studentName ?></p>
            <br />
        </div>
        <div class="row">
            <div class="col-6 p-0 m-0">
                <div class="mr-4">
                <table class="g-table"><h4 class="text-center m-5">RECORD OF ATTENDANCE</h5>
                    <thead class="dark">
                        <tr class="w-50px">
                            <th></th>
                            <th>June</th>
                            <th>July</th>
                            <th>Aug.</th>
                            <th>Sept.</th>
                            <th>Oct.</th>
                            <th>Nov.</th>
                            <th>Dec.</th>
                            <th>Jan.</th>
                            <th>Feb.</th>
                            <th>Mar.</th>
                            <th>Apr.</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-center">No. of school days</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">No. of days present</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-center">No. of days absent</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="p-0 mt-3">
                    <h5 class="text-center mt-5">PARENT'S/GUARDIAN'S SIGNATURE</h5>
                    <div class="row mt-4">
                        <div class="col-3  text-right">
                            <em class="h6">1st Quarter</em>
                        </div>
                        <div class="col-9 ">
                            <hr class="w-100 bg-dark">
                            <hr class="w-100 bg-dark mt-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3  text-right">
                            <em class="h6">2nd Quarter</em>
                        </div>
                        <div class="col-9 ">
                            <hr class="w-100 bg-dark">
                            <hr class="w-100 bg-dark mt-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3  text-right">
                            <em class="h6">3rd Quarter</em>
                        </div>
                        <div class="col-9 ">
                            <hr class="w-100 bg-dark">
                            <hr class="w-100 bg-dark mt-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3  text-right">
                            <em class="h6">4th Quarter</em>
                        </div>
                        <div class="col-9 ">
                            <hr class="w-100 bg-dark">
                            <hr class="w-100 bg-dark mt-4">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <p class="text-right">LRN: <?php echo $LRNNum ?></p>
                <br />
                <h5 class="text-center p-0 m-0">SAN JUAN CITY SCIENCE HIGH SCHOOL</br>
                (JUNIOR HIGH SCHOOL)</h5>
                <p class="text-center mb-4 ">School Year: <?php echo $schoolYear ?></p>
                <br />
                <b>Name:</b> <?php echo $studentName ?>
                <br />
                <div class="row">
                    <div class="w-50">
                        <b>Age:</b> <?php echo $studentAge ?>
                    </div>
                    <div class="w-50">
                        <b>Sex:</b> <?php echo $studentSex ?>
                    </div>
                </div>
                <div class="row">
                    <div class="w-50">
                        <b>Grade:</b> <?php echo $GradeLevel ?> 
                    </div>
                    <div class="w-50">
                        <b>Section:</b> <?php echo $sectionName ?>
                    </div>
                </div>
                <b>Track/Strand:</b>
                </br>
                </br>
                <i>
                <p>Dear Parents:</p>
                        <p style="text-indent:30px">This report card shows the ability and progress your child has made
                    in the different learning areas as well as his/her values.</p>
                        <p style="text-indent:30px">The school welcomes you should you desire to know more about your
                    child's progress.</p>
                </i>
                <div class="w-25 text-center ml-auto">
                    <p class="border-bottom border-dark"> <?php echo $adviserName ?></p>
                    <p><b>Teacher</b></p>
                </div>
                <div class="w-25 text-center ml-auto">
                    <p class="border-bottom border-dark text-uppercase"><b><?php echo $principalName ?></b></p>
                    <p><b>Teacher</b></p>
                </div>
                <!--     
                <br />
                <b>Principal</b>                <b>Teacher</b>  -->
                <h5>CERTIFICATE OF TRANSFER</h5>
                <i>Admitted to Grade: __________ Section: __________
                    Eligible for Admission to Grade: __________
                    Approved:
                    __________  __________
                    <b>Principal</b>   <b>Teacher</b>
                </i>
                <h5>CANCELLATION OF ELIGIBILITY TO TRANSFER</h5>
                <i>Admitted in:  Date: __________
                        __________
                        <b>Principal</b>
                </i>
            </div>
        </div>

        <div class="hide-on-print footer">
            <p class="footer-text">© 2020 - San Juan City Science High School. All Rights Reserved</p>
        </div>
    </div>

    <script>
        function printOuterReportCard() {
            window.print();
        }
    </script>

    <script>
        // $('#lead').text("View Student's Grade");
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
</body>
    <!-- <script type="text/javascript" src="../../js/script.js" ></script> -->
    <!-- <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script> -->
</html>