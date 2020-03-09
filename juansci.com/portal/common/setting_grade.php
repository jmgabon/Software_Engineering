<?php
    session_start();
    
    if($_SESSION['TeacherNum'] === null || $_SESSION['AccessType'] !== 'principal'){
        header('Location: ../');
    }

    // include '../php/Header_User.php';
?>

<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Report Card Settings');
    $('#setting').addClass('active');
</script>
<div class="newcontainer mt-5">
    <style>
        .ul {
            margin: 0;
            padding: 0;
            list-style: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            width:50%;
            float:left;
        }

        .ul li {
            cursor: move;
            margin: 1px;
            padding: 1% 10%;
            font-size: 100%;
            color: white;
            background-color: #800000;
        }

        .ghost {
            opacity: .4;
        }
    </style>
        <div class="float-left">
            <label>Selected Grade Level:
                <select id="selectGradeLevel" onchange="wrapperGradeSorter.selectGradeLevel()">
                    <option selected value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </label>

            <div class="row">
                <ul class="ul mt-4" id="uListSubject"></ul>
            </div>

            <div class = "col mt-4 mb-4">
                <button id="btnSaveSubj">SAVE Subject Arrangement</button>
            </div>
        </div>

        <div class="float-right">
            <p><span id="txt_CaseApproved"></span><b> <-- Approved by the Principal</b></p>
            <p><span id="txt_CaseTotal"></span><b> <--Total Number of Teachers * Subjects</b></p>
            <p>Note: Wait Subject Teachers to finish their grading.</p>
            <p><b>Approved</b> must be equal to <b>Total</b> to close the encoding of grades.</p><br />
            <label>Quarter SAVE Button Enabled:
                <select id="selectQuarter">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </label>

            <div class = "col">
                <button id="btnSaveQuarter">SAVE Enabled Quarter</button>
            </div>
        </div>
    </div>

    <script>
        let teacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessType = '<?php echo $_SESSION['AccessType']?>';
        if (accessType === '') {
            accessType = 'teacher';
        }

        console.log('accessType: ' + accessType);
        console.log('teacherNum: ' + teacherNum);
    </script>
    <?php include 'partials/footer.php'; ?>
    <script src="js/Grade_Setting.js" type="text/javascript"></script>
</body>
</html>
    
