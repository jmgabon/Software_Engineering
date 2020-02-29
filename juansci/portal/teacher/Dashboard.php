<?php
    session_start();
    if($_SESSION['id'] === null || $_SESSION['access'] != "teacher"){
        header('Location: ../');
    }

    include '../php/Header_User.php';


    // check if adviser (if not, hide Print Student Grades)
    $stmt = $db->prepare('SELECT EmployeeNum FROM section WHERE EmployeeNum = ?');
    $stmt->bindValue(1, $_SESSION['id']);
    $stmt->execute();
    $col = $stmt->fetch();
    $stmt->closeCursor();
?>

<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Main Menu');
    $('#back-to-menu').addClass('d-none');
</script>     
    <div class="newcontainer">
        <div class="row mt-5">
            <div class="col mt-5 text-center">
                <a class="text-secondary" href="Schedule.php">
                    <img src="../pictures/sched.png" width="100px">
                    <p class="h6 mt-2">Check Schedule</p>
                </a>
            </div>
            <div class="col mt-5 text-center">
                <a class="text-secondary" href="Grade_Subject.php">
                    <img src="../pictures/edit-grade2.png" width="100px">
                    <p class="h6 mt-2">Grade Students on Subjects</p>
                </a>
            </div>
            <?php if (!empty($col[0])) { ?>
            <div class="col mt-5 text-center">
                <a class="text-secondary" href="Grade_Values.php">
                    <img src="../pictures/edit-grade.png" width="100px">
                    <p class="h6 mt-2">Grade Students on Values</p>
                </a>
            </div>
            <div class="col mt-5 text-center">
                <a class="text-secondary" href="../php/Grade_View.php">
                    <img src="../pictures/view-grade.png" width="100px">
                    <p class="h6 mt-2">View Student Grades</p>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
       
        <!-- <div class="row content">
            <div class="col option">
                <a href="Schedule.php">
                    <img src="../pictures/sched.png" class="img-opt">
                </a>
                <p class="label">Check Schedule</p>
            </div>  
            <div class="col option">
                <a href="Grade_Subject.php">
                    <img src="../pictures/gradesubject.png" class="img-opt">
                </a>
                <p class="label">Grade Students on Subjects</p>
            </div>
        <?php //if (!empty($col[0])) { ?>
            <div class="col option">
                <a href="Grade_Values.php">
                   <img src="../pictures/gradevalue.png" class="img-opt">
                </a>
                <p class="label">Grade Students on Values</p>
            </div>
            <div class="col option">
                <a href="../php/Grade_View.php">
                    <img src="../pictures/print.png" class="img-opt">
                </a>
                <p class="label">Print Student Grades</p>
            </div>
        <?php //} ?>
        </div>
    </div> -->


    <?php include 'partials/footer.php'; ?>