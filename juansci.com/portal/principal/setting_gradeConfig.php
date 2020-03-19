<?php
    // session_start();
    
    // if($_SESSION['TeacherNum'] === null || $_SESSION['AccessType'] !== 'principal'){
    //     header('Location: ../');
    // }

    // include '../php/Header_User.php';
?>

<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Set Quarter | Start/End Class | Close/Open Encoding of Grades');
    $('#setting').addClass('active');
</script>
    <div class="content-main mt-4">
        <div class="secondCol col-xl-12">
            <!-- <div class="newcontainer mt-5"> -->
                <style>
                    .switch {
                    position: relative;
                    display: inline-block;
                    width: 60px;
                    height: 34px;
                    }

                    .switch input {display:none;}

                    .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: #ccc;
                    -webkit-transition: .4s;
                    transition: .4s;
                    }

                    .slider:before {
                    position: absolute;
                    content: "";
                    height: 26px;
                    width: 26px;
                    left: 4px;
                    bottom: 4px;
                    background-color: white;
                    -webkit-transition: .4s;
                    transition: .4s;
                    }

                    input:checked + .slider {
                    background-color: #800000;
                    }

                    input:focus + .slider {
                    box-shadow: 0 0 1px #800000;
                    }

                    input:checked + .slider:before {
                    -webkit-transform: translateX(26px);
                    -ms-transform: translateX(26px);
                    transform: translateX(26px);
                    }
                </style>


                <div class="float-left">
                    <h3>School Year: <b><span id="txt_SchoolYear"></span></b></h3>
                    <br />
                    <h3><span id="txt_Quarter"></span></h3>
                    <h3><b><span id="txt_CaseApproved"></span></b> Approved by the Principal</h3>
                    <h3><b><span id="txt_CaseTotal"></span></b> Total Number of Teachers * Subjects</h3>
                    <p>Note: Wait Subject Teachers to finish their grading.</p>
                    <p><b>Approved</b> must be equal to <b>Total</b> to close the encoding of grades.</p>
                    <br /><br /><br /><br /><br />

                    <div style="text-align: center">
                    <h5>CLOSE/OPEN Encoding of Grades</h5>
                        <label class="switch">
                            <input id="chk_EncodingEnabled" type="checkbox">
                            <div class="slider"></div>
                        </label>
                    </div>

                    <!-- <div> -->
                        <button id="btnStartClass" class="rounded-pill" style="width: 50% !important">START CLASS</button>
                    <!-- </div> -->


                    <!-- <label>Quarter SAVE Button Enabled:
                        <select id="setQuarter">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </label> -->

                    <!-- <div class = "col">
                        <button id="btnSaveQuarter">SAVE Enabled Quarter</button>
                    </div>

                    <div class = "col">
                        Incorrect assignment of Quarter?
                        <button id="btnBypassGradeCase">Bypass Grade Cases</button>
                    </div>

                    <div class = "col">
                        Sudden Updation and Deletion of Subjects in the middle of School Year?
                        <button id="btnUpdateGradeCase">Update Grade Cases</button>
                    </div> -->
                </div>
            <!-- </div> -->
        </div>
    </div>

    <script>
        let TeacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let AccessType = '<?php echo $_SESSION['AccessType']?>';

        console.log('AccessType: ' + AccessType);
        console.log('TeacherNum: ' + TeacherNum);
    </script>
    <?php include 'partials/footer.php'; ?>
    <script src="js/MIS_Grade_Principal.js" type="text/javascript"></script>
    <script src="js/setting_gradeConfig.js" type="text/javascript"></script>
</body>
</html>
    
