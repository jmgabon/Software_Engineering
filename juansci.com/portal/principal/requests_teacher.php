<?php
include 'partials/header.php';
?>
<script type="text/javascript">
    $('#lead').text('Requests');
    $('#teacher').addClass('active');
</script>
<div class="content-main mt-4">
    <div class="secondCol col-xl-12">
    <p class="h5 pb-2">
        <label class="float-right" for="Results">
            <select id="Category" class="mt-1 form-control rounded-0 bg-light">
                <option value="ControlNum" selected = "selected">Request Number</option>
                <option value="TeacherNum">Teacher ID</option>
                <option value="LastName">Last Name</option>
                <option value="FirstName">First Name</option>
                <option value="CreatedBy">Creator ID</option>
                <option value="RequestedBy">Name</option>
                <option value="MiddleName">Middle Name</option>
                <option value="Action_">Action</option>
                <option value="Status_">Status</option>
            </select>   
            <input placeholder="Search" type="search" class="mt-1 form-control rounded-0 bg-light" id="Results">
        </label>
    </p>
    <table id="ResultsTable">
        <thead class="dark">
            <tr>
            <!-- <td>Section Number</td> -->
            <td id="ControlNum">Request Number</td>
            <td id="TeacherNum">Teacher ID</td>
            <td id="LastName">Last Name</td>
            <!-- <td id="Extension">Extension</td> -->
            <td id="FirstName">First Name</td>
            <td id="MiddleName">Middle Name</td>
            <td id="URL_Picture" style="display: none;"></td>
            <td id="CreatedBy">Creator ID</td>
            <td id="RequestedBy">Name</td>
            <td id="DateCreated">Date Requested</td>
            <td id="Action_">Action</td>
            <td id="Status_">Status</td>
            <td style="width: 2% !important;"></td>
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
    Search(window.location.href, "", "", tableUI);
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");

    results_input.addEventListener("change", function(){
        let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        Search(window.location.href, content, "", tableUI);
    });

    function tableUI(xhttp){
        CreateTBody(xhttp, null, ApprovalButton);
        let tr = document.querySelectorAll("#ResultsTable tbody tr");
        // Hover(tr);
    }
    function ApprovalButton(td, i){
        console.log(td.innerHTML);

        let btn1, btn2, class_btn1, class_btn2;
        // console.log(td);
        btn1 = document.createElement('button');
        btn2 = document.createElement('button');
        // btn_Block.innerHTML = "Block";
        // btn_Privilege.innerHTML = "Set as Coordinator";
        btn1.innerHTML = "Approve";
        btn2.innerHTML = "Reject";

        // btn1.style.width = "100% !important";
        // btn2.style.width = "100% !important";
        if(results[i]["Status_"] == "PENDING"){
            td.appendChild(btn1);
            td.appendChild(btn2);
        }
        // // td.appendChild(btn_Delete);
        class_btn1 = document.createAttribute("class");
        class_btn2 = document.createAttribute("class");
        class_btn1.value = "btn_Table";
        class_btn2.value = "btn_Table";
        btn1.setAttributeNode(class_btn1);
        btn2.setAttributeNode(class_btn2); 

        btn1.addEventListener("click", Approval.bind(null, i, "APPROVED"));
        btn2.addEventListener("click", Approval.bind(null, i, "REJECTED"));
    }

    function Approval(i, decision){
        data = "";
        remarks = "";
        data += "url=" + window.location.href;
        data += "&value=" + results[i]["ControlNum"];
        data += "&decision=" + decision;
        if(decision == "REJECTED"){
            
        }
        data += "&remarks=" + remarks;
        if(results[i]["Action_"] == "UPDATE"){
            // console.log(data);
            AJAX(data, true, "post", "php/Update.php", true, messageAlert);
        }
        else if(results[i]["Action_"] == "INSERT"){
            AJAX(data, true, "post", "php/Create.php", true, messageAlert);
        }

    }

    function messageAlert(xhttp){
        // console.log(xhttp.responseText);
        let message = xhttp.responseText;

        if(message.indexOf("Request No.") !== -1){
            alert(message);
            location.reload(true);
        }
        else{
            alert(message);
        }
        // let content = category.options[category.selectedIndex].value + "=" + results_input.value;
        // Search(window.location.href, content, GetIDinString(td, 0), tableUI);   
    }
    // cat.options[cat.selectedIndex].value + "=" + searchEmployee.value
    // let results_input = document.querySelector("#Results");
    // let category = document.querySelector("#Category");
    // Search(window.location.href, "", null);
    // results_input.addEventListener("change", function(){
    //     let content = category.options[category.selectedIndex].value + "=" + results_input.value;
    //     Search(window.location.href, content, null);
    // });

    // function print(xhttp){
    //     console.log(xhttp.responseText);
    // }
</script>