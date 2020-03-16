<?php
    // session_start();
    
    // if($_SESSION['TeacherNum'] === null || $_SESSION['AccessType'] !== 'principal'){
    //     header('Location: ../');
    // }

    // include '../php/Header_User.php';
?>

<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Sort Learning Areas in the Report Card');
    $('#setting').addClass('active');
</script>
    <div class="content-main mt-4">
        <div class="secondCol col-xl-12">
            <!-- <div class="newcontainer mt-5"> -->
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

                <div class="float">
                    <label style="width: 50% !important">Select Grade Level:
                        <select id="selectGradeLevel" class="form-control mt-0 form-control-sm rounded-0 bg-dark text-light" onchange="wrapperGradeSorter.selectGradeLevel()">
                            <option selected value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </label>

                    <div class="row">
                        <ul class="ul mt-4" id="uListSubject"></ul>
                    </div>

                    <div class = "row">
                        <button id="btnSaveSubj" class="rounded-pill" style="width: 50% !important">SAVE ARRANGEMENT</button>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </div>

    <script>
        let teacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessType = '<?php echo $_SESSION['AccessType']?>';

        console.log('accessType: ' + accessType);
        console.log('teacherNum: ' + teacherNum);
    </script>
    <?php include 'partials/footer.php'; ?>
    <script src="js/MIS_Grade_Principal.js" type="text/javascript"></script>
    <script src="js/setting_gradeSortable.js" type="text/javascript"></script>
</body>
</html>
    
