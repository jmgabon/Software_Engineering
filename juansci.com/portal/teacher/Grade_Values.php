    <?php
        include 'partials/header.php';

        // if not Adviser, logout
        if (empty($col[0])) {
            header('Location: ../');
        }
    ?>


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
            <input type="text" id="txt_LRNNum" style="display: none;" />
            <label for="">Select Student: <input class="ml-2 sec-name" type="text" id="txt_StudentModal" required disabled/></label>
            <button class="modal-button"><i class="far fa-window-restore"></i></button>
        </div>

        <br /><br /><br /><br />
        <p><b>Section Name: </b><span id="txt_SectionName"></span></p>
        <p><b>Grade Level: </b><span id="txt_GradeLevel"></span></p>
        <p><b>Student Name: </b><span id="txt_StudentName"></span></p>

        <div class="row">
            <div class="col-9 p-0 m-0">
                <table id="gradeTable" class="g-table">
                    <thead class="dark">
                        <tr>
                            <th rowspan="2">Core Values</th>
                            <th rowspan="2">Behavior Statement</th>
                            <th colspan="4">Quarter</th>
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
                            <td rowspan="2"><b>1. Maka-Diyos</b></td>
                            <td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Shows adherence to ethical principles by upholding truth</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="2"><b>2. Makatao</b></td>
                            <td>Is sensitive to individual, social, and cultural differences</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Demonstrates contributions towards solidarity</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="2"><b>3. Makakalikasan</b></td>
                            <td>Cares for the environment and utilizes resources wisely, judiciously, and economically</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Demonstrates pride in being a Filipino; exercises the right and responsibilities of Filipino citizen</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><b>4. Makabansa</b></td>
                            <td>Demonstrates appropriate behavior in carrying out activities in the school community, and country</td>
                            <td>
                                <select class="grValQ1">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ2">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ3">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                            <td>
                                <select class="grValQ4">
                                    <option selected value="--" disabled>--</option>
                                    <option value="AO">AO</option>
                                    <option value="SO">SO</option>
                                    <option value="RO">RO</option>
                                    <option value="NO">NO</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button id="save1">SAVE</button>
                            </td>
                            <td>
                                <button id="save2">SAVE</button>
                            </td>
                            <td>
                                <button id="save3">SAVE</button>
                            </td>
                            <td>
                                <button id="save4">SAVE</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-0 mt-3">
                <pre style="font-size: 20px">
                    <b>Marking          Non-numerical Rating</b>
                    <b> AO</b> -            Always Observed
                    <b> SO</b> -            Sometimes Observed
                    <b> RO</b> -            Rarely Observed
                    <b> NO</b> -            Not Observed
                </pre>
            </div>
        </div>
    </div>
    <?php include 'partials/footer.php'; ?>

    <script>
        let TeacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessType = '<?php echo $_SESSION['AccessType']?>';
        if (accessType === '') {
            accessType = 'teacher';
        }

        console.log('accessType: ' + accessType);
        console.log('TeacherNum: ' + TeacherNum);
    </script>
    <script src="js/Grade_Values.js" type="text/javascript"></script>