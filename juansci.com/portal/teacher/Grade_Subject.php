<?php
    // session_start();
    // if($_SESSION['id'] === null || !($_SESSION['access'] === 'principal' xor $_SESSION['access'] === 'coordinator' xor $_SESSION['access'] === 'teacher')){
    //     header('Location: ../');
    // }

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
            <label id="labelMAPEH" for="" style="display: none">Selected MAPEH:
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
        <p><b>Section Name: </b><span id="txt_Section"></span></p>
        <p><b>Grade Level: </b><span id="txt_GradeLevel"></span></p>
        <p><b>Adviser Name: </b><span id="txt_Adviser"></span></p>
        <p><b>Subject Code: </b><span id="txt_SubjectCode"></span></p>

        <br /><br />
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

    <script>
        let EmployeeNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessRole = '<?php echo $_SESSION['AccessType']?>';
        if (accessRole === '') {
            accessRole = 'teacher';
        }
    </script>
    <script src="js/ajax.js" type="text/javascript"></script>
    <script src="js/utility.js" type="text/javascript"></script>
    <script src="js/cms.js" type="text/javascript"></script>
    <script src="js/modal.js" type="text/javascript"></script>
    <script src="js/Grade_Subject.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/script.js" ></script>
    <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
    <?php //include 'partials/footer.php'; ?>
</body>

</html>