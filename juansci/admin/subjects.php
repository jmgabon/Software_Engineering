<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Subjects');
    $('#subject').addClass('active');
</script>
<div class="content-main mt-5 row">
	<div class="col-12 col-xl-4" id="SubjectCode">
        <p class="h5 pb-2">Create Subject</p>
        <p class="p-0 m-0"><label for="txt_SubjectCode">Subject Code:<br/><input type="text" name="txt_SubjectCode" id="txt_SubjectCode" required/></label></p>
        <p><label for="txt_SubjectDescription">Description: <br/><input type="textarea" name="txt_SubjectDescription" id="txt_SubjectDescription"/></label></p>
        <p class="mt-2"><label for="txt_Frequency">Frequency: <input type="number" min="0" id="txt_Frequency" name="txt_Frequency"></label></p>
        <p class="mt-2"><label for="txt_GradeLevel">Grade Level: <select id="txt_GradeLevel" name="txt_GradeLevel">
            <option selected="selected">7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select></label></p>
        <button class="rounded-pill mt-3 create-button" id="CreateSubjectCode" style="width: 200%;">Create</button>
        <button class="rounded-pill mt-3 reset-button" id="ResetSubjectCode">Reset</button>
	</div>
    <div class="secondCol col col-xl-8">
        <p class="h5 pb-2">List of Subject Codes
        <label class="float-right" for="SearchSubjectCode">
            <input placeholder="Search for subject codes.." class="mt-1 form-control rounded-0 bg-light" type="search" id="SearchSubjectCode" style="width: 200px !important;">
        </label></p>
        <table id="SearchSubjectCodeTable">
            <thead class="dark">
                <tr>
                <td scope="col" id="SubjectCode">Subject Code</td>
                <td scope="col" id="SubjectDescription">Description</td>
                <td scope="col" id="Frequency">Units</td>
                <td scope="col" id="GradeLevel">Grade Level</td>
                <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
                <!-- <td></td> -->
            </tbody>
        </table>
        <!-- <button id="First">Create Room</button>
        <button id="Las">Reset</button> -->
    </div>
		
</div>	

<?php include 'partials/footer.php'; ?>
<script type="text/javascript" src="../js/SubjectCode.js"></script>
