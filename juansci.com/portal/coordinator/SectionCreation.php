<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Sections');
    $('#section').addClass('active');
</script>
<div class="content-main mt-5 row">
    <div id="modal">
        <div id="modal-content">
            <span id="close" onclick="closeModal(document.getElementById('modal-body'));">&times;</span>
            <div id="modal-header" >
                <h2 id="modal-title"></h2>
            </div>
            <div id= "modal-body">
            </div>
            <div id="modal-footer"> 
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-11" id="Section">
        <style type="text/css">
            #Section input, #Section select{
                width: 30% !important;
                /*float:right !important;*/
                margin-right: 35% !important;
            }
            #Buttons{
                margin-right: 31% !important;   
                margin-top: 2% !important;
            }
            
            .span-input-btn{
                float: right; 
                width: 40% !important;
                margin-right: 25%;
            }
            /*.here{*/
                
            /*}*/
        </style>
        <form>
        <p class="h4 mb-2">Add New Section</p>
        <p class="p-0 mt-4"><label for="SectionName">Section Name: </label><input class="" type="text" name="SectionName" id="SectionName" required/></p>
        <p><label for="txt_RoomNum">Room Number: </label>
                <!-- <button id="btn_RoomNum"onclick="CreateModal('Available Rooms', 'Room')"> -->
            <span class="span-input-btn">
            <input type="text" name="txt_RoomNum" id="txt_RoomNum" disabled style="width: 75% !important; 
                float: none !important; 
                margin-right: 0% !important;"/>
            <button id="btn_RoomNum">&check;</button>
            </span>
        </p>
        <!-- <label class="pl-3" for="txt_Capacity">Capacity: <input class="ml-2 mb-2" type="number" name="txt_Capacity" id="txt_Capacity" min="5" max="50" required/></label></p> -->
        <p>
            <label for="GradeLevel">Grade Level: </label>
            <select id="GradeLevel" name="GradeLevel">
            <option selected="selected" value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            </select>
        </p>
        <p>
            <label for="SchoolYear">SchoolYear: </label>
            <select id="SchoolYear" name="SchoolYear"></select>
        </p>
        <p><label for="txt_Adviser">Adviser: </label>
            <span class="span-input-btn">
            <input type="text" name="txt_Adviser" id="txt_Adviser" required disabled style="width: 75% !important; 
                float: none !important; 
                margin-right: 0% !important;"/>
            <button id="btn_Adviser" onclick="">&check;</button>
            </span>
            <!-- <input class="" type="text" name="RoomNum" id="RoomNum" required/> -->
        </p>

        <script type="text/javascript">
            let schoolyear = document.querySelector("#SchoolYear");

            let yearFounded = 2016;
            let yearToday = new Date().getFullYear()
            for(let i = 0; i <= yearToday - yearFounded; i++){
                let option = document.createElement("option");
                option.value = yearFounded + 1;
                option.innerHTML = (yearFounded + i) + "-" + (yearFounded + i + 1);
                schoolyear.appendChild(option);
            }
        </script>

        <div id="Buttons">
            <button class="rounded-pill create-button" id="CreateSection">Create</button>
            <button class="rounded-pill reset-button" id="ResetSection">Reset</button>
        </div>
        </form>
    </div>
    <div class="col col-xl-12" style="margin-top: 10% !important;">
        <p class="h4 pb-2">List of Requests

        <!-- <label class="float-right" for="SearchRoom"> -->
        <label class="float-right" for="Results">
        <select class="mt-1 form-control rounded-0 bg-light" id="Category">
            <option value="ControlNum"  selected="selected">Request Number</option>
            <option value="SectionNum"">Section Number</option>
            <option value="SectionName">SectionName</option>
            <option value="RoomNum">Room Number</option>
            <option value="GradeLevel">Grade Level</option>
            <option value="SchoolYear">School Year</option>
            <option value="Adviser">Adviser</option>
            <option value="Status_">Status</option>
        </select>
        <input type="search" name="" class="mt-1 form-control rounded-0 bg-light" id="Results">
        <!-- <input placeholder="Search for rooms.." class="mt-1 form-control rounded-0 bg-light" type="search" id="SearchRoom" style=""> -->
        </label></p>
        <table id="ResultsTable">
            <thead class="dark">
                <tr>
                <td scope="col" id="ControlNum">Request Number</td>
                <td scope="col" id="SectionNum">Section Number</td>
                <td scope="col" id="SectionName">SectionName</td>
                <td scope="col" id="RoomNum">Room Number</td>
                <td scope="col" id="GradeLevel">Grade Level</td>
                <td scope="col" id="SchoolYear">School Year</td>
                <td style="display: none;"></td>
                <td scope="col" id="Adviser">Adviser</td>
                <td scope="col" id="DateCreated">Date Created</td>
                <td style="display: none;"></td>
                <td style="display: none;"></td>
                <td scope="col" id="Action_">Action</td>
                <td scope="col" id="Status_">Status</td>
                <!-- <td scope="col"></td> -->
                </tr>
            </thead>
            <tbody>
                <!-- <td></td> -->
            </tbody>
        </table>
    </div>
    
</div>
<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    Search(window.location.href, "", null);
    // let parent_id = "Results"
    let btn_RoomNum = document.querySelector("#btn_RoomNum");
    let btn_Adviser = document.querySelector("#btn_Adviser");
    let modal_body = document.getElementById("modal-body");
    btn_RoomNum.addEventListener("click", function(event){
        event.preventDefault();
        CreateModal("Available Rooms", "AvailableRooms");
    });
    btn_Adviser.addEventListener("click", function(event){
        event.preventDefault();
        CreateModal("Available Teachers", "AvailableTeachers");
    });

    let modal_cat;
    let reset = document.querySelector("#ResetSection");
    let create = document.querySelector("#CreateSection");
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");
    initialValue = null;
    reset.addEventListener("click", function(event){
        event.preventDefault();
        ResetInput(initialValue, "Section");
    });

    create.addEventListener("click", function(event){
        event.preventDefault();
        // console.log(GetContent("#Section"));
        let content = GetContent("#Section");
        content["SectionNum"] = null;
        if(userID !== null){
            content["CreatedBy"] = userID; 
        }
        content["Status_"] = "PENDING";
        content["Action_"] = "INSERT";
        Create(window.location.href, content, requestStatus);
    });

    results_input.addEventListener("change", function(){
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;

        Search(window.location.href, content, null);
    });

    function CreateModal(header, title){ //Shows modal in html that is hidden then creates content
    if(title == 'AvailableRooms'){
        theadID = "RoomNum@RoomName@Building@Floor";
        theadHTML = "Room Number@Room Name@Building@Floor";
        CreateSearchBox(theadID, theadHTML, '@', 'AvailableRooms', 'search', modal_body);
        CreateTable("AvailableRoomsTable", theadID, theadHTML, "@", modal_body, 0, null);
        searchRoom = document.getElementById("AvailableRooms");
        modal_cat = document.querySelector("#modal-body select");
        SearchRoomSection();
        searchRoom.addEventListener("change", SearchRoomSection);
        function SearchRoomSection(){
            let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchRoom.value;
            Search(window.location.href + "#Room", searchBox_value, PickRoom)
        }
    }

    else if(title == 'AvailableTeachers'){
        theadID = "TeacherNum@LastName@ExtendedName@FirstName@MiddleName";
        theadHTML = "Teacher ID@Last Name@Extended Name@First Name@Middle Name";
        CreateSearchBox(theadID, theadHTML, '@', 'AvailableTeachers', 'search', modal_body);
        CreateTable("AvailableTeachersTable", theadID, theadHTML, "@", modal_body, 0, null);
        modal_cat = document.querySelector("#modal-body select");
        searchTeacher = document.getElementById("AvailableTeachers");
        SearchTeacherSection();
        searchTeacher.addEventListener("change", SearchTeacherSection);
        function SearchTeacherSection(){
            let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchTeacher.value;
            Search(window.location.href+"#Teacher", searchBox_value, PickAdviser);
        }
    }
    openModal(header, title);
}

function PickRoom(xhttp){
    CreateTBody(xhttp, PickRoom);
    let tbody_tr = document.querySelectorAll("#AvailableRoomsTable tbody tr");
    for(let i = 0; i < tbody_tr.length; i++){
        tbody_tr[i].addEventListener("click", function(){
            document.getElementById("txt_RoomNum").value = this.childNodes[0].innerHTML;
            searchRoom.value = "";
            closeModal(modal_body);
        });
    }
}

function PickAdviser(xhttp){
    CreateTBody(xhttp, PickAdviser);
    let tbody_tr = document.querySelectorAll("#AvailableTeachersTable tbody tr");
    for(let i = 0; i < tbody_tr.length; i++){
        tbody_tr[i].addEventListener("click", function(){
            document.getElementById("txt_Adviser").value = this.childNodes[0].innerHTML;
            searchTeacher.value = "";
            closeModal(modal_body);
        });
    }
}
</script>
 