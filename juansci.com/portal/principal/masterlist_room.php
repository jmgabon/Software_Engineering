<?php
include 'partials/header.php';
?>
<script type="text/javascript">
    $('#lead').text('Masterlist');
    $('#room').addClass('active');
</script>
<div class="content-main mt-4">
    <div class="col-xl-12">
    <p class="h5 pb-2">
        <label class="float-right" for="Results">
            <select id="Category" class="mt-1 form-control rounded-0 bg-light">
                
                <option value="RoomNum" selected="selected">Room Number</option>
                <option value="RoomName">Room Name</option>
                <option value="Building">Building</option>
                <option value="Floor">Floor</option>
                <option value="Type">Type</option>
                <option value="DateCreated">Date Requested</option>
                <!-- <option value="Action_">Action</option>
                <option value="Status_">Status</option> -->
            </select>   
            <input placeholder="Search" type="search" class="mt-1 form-control rounded-0 bg-light" id="Results">
        </label>
    </p>
    <table id="ResultsTable">
        <thead class="dark">
            <tr>
            <!-- <td>Section Number</td> -->
            <td id="RoomNum">Room Number</td>
            <td id="RoomName">Room Name</td>
            <td id="Building">Building</td>
            <td id="Floor">Floor</td>
            <td id="Type">Type</td>
            <td id="DateCreated">Date Requested</td>
            <!-- <td id="URL_Picture" style="display: none;"></td> -->
            <!-- <td id="Action_">Action</td>
            <td id="Status_">Status</td> -->
            <td></td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</div>
<?php
include 'partials/footer.php';
?>
<script type="text/javascript">
    let td = document.querySelectorAll("#ResultsTable tr td");
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");

    Search(window.location.href, "", GetIDinString(td, 0), tableUI);
    //EventListener
    results_input.addEventListener("change", function(){
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        Search(window.location.href, content, GetIDinString(td, 0), tableUI);
    });
    
    function tableUI(xhttp){
        CreateTBody(xhttp, null, null);
        let tr = document.querySelectorAll("#ResultsTable tbody tr");
    }
    function Blocking(td, i){
        console.log(td.innerHTML);

        let btn_Block, class_btn1, class_btn2, btn_Privilege;
        btn_Block = document.createElement('button');
        btn_Privilege = document.createElement('button');

        if(results[i]["Access"] == 1){
            btn_Block.innerHTML = "Block";
        }
        else{
            btn_Block.innerHTML = "Unblock";
        }
        if(results[i]["AccessType"] == "coordinator"){
            btn_Privilege.innerHTML = "Remove Privileges";
        }
        else{
            btn_Privilege.innerHTML = "Set as Coordinator";
        }

        btn_Block.addEventListener("click", Block.bind(null, i));
        btn_Privilege.addEventListener("click", Privilege.bind(null, i));
        td.appendChild(btn_Block);
        td.appendChild(btn_Privilege);
        // // td.appendChild(btn_Delete);
        class_btn1 = document.createAttribute("class");
        class_btn2 = document.createAttribute("class");
        class_btn1.value = "btn_Table"; //
        class_btn2.value = "btn_Table";
        btn_Block.setAttributeNode(class_btn1);
        btn_Privilege.setAttributeNode(class_btn2); 
    }
    function Block(i){
        // console.log(i);
        let data = "";
        data += "key=Access";
        data += "&value=" + results[i]['Access'];
        data += "&user=" + results[i]['TeacherNum'];
        AJAX(data, true, "post", "php/Access.php", true, messageAlert);
        // console.log(results[i]['Access']);
        // Search(window.location.href, "", GetIDinString(td, 0), display);
    }
    function Privilege(i){
        // console.log(i);
        let data = "";
        data += "key=Type";
        data += "&value="+ results[i]['AccessType'];
        data += "&user=" + results[i]['TeacherNum'];

        AJAX(data, true, "post", "php/Access.php", true, messageAlert);
        // console.log(results[i]['AccessType']);
        // Search(window.location.href, "", GetIDinString(td, 0), display);
    }

    function messageAlert(xhttp){
        alert(xhttp.responseText);
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        Search(window.location.href, content, GetIDinString(td, 0), tableUI);   
    }
</script>