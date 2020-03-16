<?php
    session_start();
    
    if($_SESSION['TeacherNum'] === null || !($_SESSION['AccessType'] === ''
    xor $_SESSION['AccessType'] === 'principal'
    xor $_SESSION['AccessType'] === 'coordinator')){
        header('Location: ../');
    }

    // include '../php/Header_User.php';
?>

<?php include 'partials/header.php'; ?>
    <script type="text/javascript">
        $('#lead').text('Student Grading on Subjects');
    </script>     
    <div class="room-container mt-5">
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

        <div class="float-right">
            <input type="text" style="display: none;" />
            <label for="">Select Subject: 
                <input class="ml-2 sec-name" type="text" id="input_SubjectCode" required disabled/>
            </label>
            <button class="modal-button"><i class="far fa-window-restore"></i></button>
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

        <br /><br />
        <p><b>Grade Level: </b><span id="txt_GradeLevel"></span></p>
        <p><b>Section Name: </b><span id="txt_Section"></span></p>
        <p><b>Adviser Name: </b><span id="txt_Adviser"></span></p>
        <br />
        <p><b>Subject Code: </b><span id="txt_SubjectCode"></span></p>
        <p><b>Subject Teacher Name: </b><span id="txt_SubjTeacher"></span></p>

        <br /><br />
        <p><b>Encoding: </b><span id="txt_encoding"></span></p>
        <p><b>Quarter: </b><span id="txt_quarter"></span></p>
        <p><b>Status: </b><span id="txt_gradeCaseStatus"></span></p>

        <div class="row">
            <div class="col-9 p-0 m-0">
                <table id="CreateGradeTable" class="g-table">
                    <thead class="dark">
                        <tr>
                            <th id="LRNNum" rowspan="2">No.</th>
                            <th id="student" rowspan="2">Name of the Student</th>
                            <th colspan="4">Grading Period</th>
                            <th id="final" rowspan="2">Final Grade</th>
                            <th id="remark" rowspan="2">Remarks</th>
                        </tr>
                        <tr>
                            <th>First</th>
                            <th>Second</th>
                            <th>Third</th>
                            <th>Fourth</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

                <button id="btn_approve" style="display: none" disabled>APPROVE</button>
                <button id="btn_disapprove" style="display: none" disabled>NEEDS CORRECTION</button>
            </div>
        </div>    
    </div>
    <?php include 'partials/footer.php'; ?>

    <script>
        let teacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessType = '<?php echo $_SESSION['AccessType']?>';
        if (accessType === '') {
            accessType = 'teacher';
        }

        console.log('accessType: ' + accessType);
        console.log('teacherNum: ' + teacherNum);
    </script>
    <script src="js/Grade_Subject.js" type="text/javascript"></script>
</body>
</html>