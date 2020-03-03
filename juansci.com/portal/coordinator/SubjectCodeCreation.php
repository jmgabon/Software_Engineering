<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Subjects');
    $('#subject').addClass('active');
</script>
<div class="content-main mt-5 row">
	<div class="col-12 col-xl-11" id="SubjectCodeForm">
		<style type="text/css">
			#SubjectCodeForm input, #SubjectCodeForm select{
                width: 30% !important;
                float:right !important;
                margin-right: 35% !important;
            }
            #Buttons {
                margin-right: 31% !important;   
                margin-top: 2% !important;
            }
		</style>
		<form>
        <p class="h4 pb-2">Create Subject</p>

        <p class="p-0 mt-4"><label for="SubjectCode">Subject Code:</label><input type="text" name="SubjectCode" id="SubjectCode" required/></p>
        <p><label for="SubjectDescription">Description: </label><input type="text" name="SubjectDescription" id="SubjectDescription" required/></p>
        <p><label for="Frequency">Number of Days: </label><input type="number" min="1" id="Frequency" name="Frequency" max="9" required></p>
        <p><label for="GradeLevel">Grade Level: </label><select id="GradeLevel" name="GradeLevel">
            <option selected="selected" value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select></p>
        <div id="Buttons">
        <button class="rounded-pill create-button" id="CreateSubjectCode">Create</button>
        <button class="rounded-pill reset-button" id="ResetSubjectCode">Reset</button>
        </div>
        </form>
	</div>
    <!-- <button class="rounded-pill create-button" id="ShowRequests" style="width: 20% !important;">Show Requests</button> -->
    <div class="col col-xl-12" style="margin-top: 10% !important;">
        <p class="h4 pb-2">List of Requests
        <label class="float-right" for="Results">
            <!-- <input placeholder="Search for subject codes.." class="mt-1 form-control rounded-0 bg-light" type="search" id="SearchSubjectCode" style="width: 200px !important;"> -->
        <select class="mt-1 form-control rounded-0 bg-light" id="Category">
            <option value="ControlNum" selected="selected">Request Number</option>
            <option value="SubjectCode">Subject Code</option>
            <option value="SubjectDescription">Description</option>
            <option value="Frequency">Number of Days</option>
            <option value="GradeLevel">Grade Level</option>
            <option value="Action_">Action</option>
            <option value="Status_">Status</option>
        </select>
        <input type="search" name="" class="mt-1 form-control rounded-0 bg-light" id="Results">
        </label></p>
        <table id="ResultsTable">
            <thead class="dark">
                <tr>
                <td scope="col" id="ControlNum">Request Number</td>
                <td scope="col" id="SubjectCode">Subject Code</td>
                <td scope="col" id="SubjectDescription">Description</td>
                <td scope="col" id="Frequency">Units</td>
                <td scope="col" id="GradeLevel">Grade Level</td>
                <td scope="col" id="DateCreated">Date Requested</td>
                <td scope="col" id="CreatedBy" style="display: none;"></td>
                <td scope="col" id="RequestedBy" style="display: none;"></td>
                <td scope="col" id="Action_">Action</td>
                <td scope="col" id="Status_">Status</td>
                <!-- <td scope="col"></td> -->
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
<script type="text/javascript">
    // let a = document.querySelectorAll(".ml-auto d-none d-md-block a");

	Search(window.location.href, "", null);
    let resetSubjectCode = document.querySelector("#ResetSubjectCode");
    let createSubjectCode = document.querySelector("#CreateSubjectCode");
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");
    initialValue = null;
    resetSubjectCode.addEventListener("click", function(event){
        event.preventDefault();
        ResetInput(initialValue, "SubjectCodeForm");
    });

    results_input.addEventListener("change", function(){
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        Search(window.location.href, content, null);
    });

    createSubjectCode.addEventListener("click", function(event){
        event.preventDefault();
        let content = GetContent("#SubjectCodeForm");

        if(userID !== null){
            content["CreatedBy"] = userID; 
        }
        content["Status_"] = "PENDING";
        content["Action_"] = "INSERT";

        Create(window.location.href, content, requestStatus);
        // console.log(userID);    
    });
</script>
<!-- <script type="text/javascript" src="../js/SubjectCode.js"></script> -->
