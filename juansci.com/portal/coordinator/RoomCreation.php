<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Rooms');
    $('#room').addClass('active');
</script>
<div class="content-main mt-5 row">
    <div class="col-12 col-xl-11" id="Room">
        <style type="text/css">
            #Room input, #Room select{
                width: 30% !important;
                float:right !important;
                margin-right: 35% !important;
            }
            #Buttons{
                margin-right: 31% !important;   
                margin-top: 2% !important;
            }
        </style>
        <form>
        <p class="h4 mb-2">Add New Room</p>
        <p class="p-0 mt-4"><label for="RoomNum">Room Number: </label><input class="" type="text" name="RoomNum" id="RoomNum" required/></p>
        <p><label for="RoomName">Room Name: </label><input class="" type="text" name="RoomName" id="RoomName" required/></p>
        <p><label for="Building">Building: </label><input class="" type="text" name="Building" id="Building"/></p>
        <p><label for="Floor">Floor: </label><input class="" type="number" name="Floor" id="Floor" min = "1" max="20"/></p>
        <!-- <label class="pl-3" for="txt_Capacity">Capacity: <input class="ml-2 mb-2" type="number" name="txt_Capacity" id="txt_Capacity" min="5" max="50" required/></label></p> -->
        <p>
            <label for="Type">Room Type: </label>
            <select id="Type" name="txt_Type">
            <option selected="selected" value="Classroom">Classroom</option>
            <option value="Laboratory">Laboratory</option>
            <option value="Office">Office</option>
            </select>
        </p>
        <div id="Buttons">
            <button class="rounded-pill create-button" id="CreateRoom">Create</button>
            <button class="rounded-pill reset-button" id="ResetRoom">Reset</button>
        </div>
        </form>
    </div>
    <div class="col col-xl-12" style="margin-top: 10% !important;">
    
   
        <!-- <label class="float-right" for="SearchRoom"> -->
        <div class="form-inline mb-3">
        <h4 class="mb-2">Lists of Requests</h4>
            <label class="ml-auto" for="Results">
            
                <select class="form-control mt-5 form-control-sm rounded-0 bg-dark text-light" id="Category">
                    <option value="ControlNum"  selected="selected">Request Number</option>
                    <option value="RoomNum">Room Number</option>
                    <option value="RoomName">Room Name</option>
                    <option value="Building">Building</option>
                    <option value="Floor">Floor</option>
                    <option value="Type">Type</option>
                    <option value="Action_">Action</option>
                    <option value="Status_">Status</option>
                </select>
                <input type="search" name="" class="form-control form-control-sm rounded-0 border-left-0" id="Results">
                <!-- <input placeholder="Search for rooms.." class="mt-1 form-control rounded-0 bg-light" type="search" id="SearchRoom" style=""> -->
            </label>
        </div>
        <table id="ResultsTable">
            <thead class="dark">
                <tr>
                <td scope="col" id="ControlNum">Request Number</td>
                <td scope="col" id="RoomNum">Room Number</td>
                <td scope="col" id="RoomName">Room Name</td>
                <td scope="col" id="Building">Building</td>
                <td scope="col" id="Floor">Floor</td>
                <td scope="col" id="Type">Type</td>
                <td scope="col" id="DateCreated">Date Requested</td>
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
    let resetRoom = document.querySelector("#ResetRoom");
    let createRoom = document.querySelector("#CreateRoom");
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");
    initialValue = null;
    resetRoom.addEventListener("click", function(event){
        event.preventDefault();
        ResetInput(initialValue, "Room");
    });

    results_input.addEventListener("change", function(){
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        Search(window.location.href, content, null);
    });
    createRoom.addEventListener("click", function(event){
        event.preventDefault();
        let content = GetContent("#Room");

        if(userID !== null){
            content["CreatedBy"] = userID; 
        }
        content["Status_"] = "PENDING";
        content["Action_"] = "CREATE";//CHANGED TO CREATE

        Create(window.location.href, content, requestStatus);
    });
</script>
 