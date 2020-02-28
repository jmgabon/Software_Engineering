<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Rooms');
    $('#room').addClass('active');
</script>
<div class="content-main mt-5 row">
    <div class="col-12 col-xl-4" id="Room">
        <p class="h5 mb-2">Add New Room</p>
        <p class="p-0 mt-4"><label for="txt_RoomNum">Room Number: <input class="small" type="text" name="txt_RoomNum" id="txt_RoomNum" required/></label></p>
        <p><label for="txt_RoomName">Room Name: <input class="float-left mb-2" type="text" name="txt_RoomName" id="txt_RoomName" required/></label></p>
        <p"><label for="txt_Floor">Floor: <input class="ml-2" type="number" name="txt_Floor" id="txt_Floor" min = "1" required/></label>
        <!-- <label class="pl-3" for="txt_Capacity">Capacity: <input class="ml-2 mb-2" type="number" name="txt_Capacity" id="txt_Capacity" min="5" max="50" required/></label></p> -->
        <p><label for="txt_Type">Room Type: <select id="txt_Type" name="txt_Type">
            <option selected="selected">Classroom</option>
            <option>Laboratory</option>
            <option>Office</option>
        </select></label></p>
    
        <!-- <button class="rounded-pill create-button" id="CreateRoom">Create Room</button> -->
        <button class="rounded-pill create-button" id="CreateRoom">Create</button>
        <button class="rounded-pill reset-button" id="ResetRoom">Reset</button>
        <!-- <button id="EditRoom">Edit Room</button> -->
        <!-- <p><label for="SubName">Subject Name: <input type="text" name="SubName" id="SubName"/></label></p> -->
    </div>
    <div class="secondCol col col-xl-8">
        <p class="h5 pb-2">List of Rooms

        <!-- <label class="float-right" for="SearchRoom"> -->
        <label class="float-right" for="SearchRoom">
        <select class="mt-1 form-control rounded-0 bg-light" id="Category">
            <option value="RoomNum" selected="selected">Room Number</option>
            <option value="RoomName">Room Name</option>
            <option value="Floor">Floor</option>
            <option value="Type">Type</option>
        </select>
        <input type="search" name="" class="mt-1 form-control rounded-0 bg-light" id="SearchRoom">
        <!-- <input placeholder="Search for rooms.." class="mt-1 form-control rounded-0 bg-light" type="search" id="SearchRoom" style=""> -->
        </label></p>
        <table id="SearchRoomTable">
            <thead class="dark">
                <tr>
                <td scope="col" id="RoomNum">Room Number</td>
                <td scope="col" id="RoomName">Room Name</td>
                <td scope="col" id="Floor">Floor</td>
                <!-- <td scope="col" id="Capacity">Capacity</td> -->
                <td scope="col" id="Type">Type</td>
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
	<script type="text/javascript">
		var user = "<?php echo($_SESSION['access']);?>";
		// console.log(user);
	</script>
	

    <?php include 'partials/footer.php'; ?>
	<script type="text/javascript" src="../js/Room.js"></script>
 