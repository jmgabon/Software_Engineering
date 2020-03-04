<?php
include 'partials/header.php';
?>
<script type="text/javascript">
    $('#lead').text('Requests');
    $('#schedule').addClass('active');
</script>
<div class="content-main mt-4">
<div id="div_schedule">
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
    <div class="float-right">
        <input type="text" id="txt_SectionNum" style="display: none;"/>
            <label for="">Section Name: <input class="ml-2 sec-name" type="text" id="txt_SectionName" required/></label>
            <button class="modal-button"><i class="far fa-window-restore"></i></button>
        
    </div>
    <br/>
    <p><b>Grade Level: </b><span id="txt_GradeLevel"></span></p>
    <p><b>Adviser: </b><span id="txt_Adviser"></span></p>
    <table class="mt-3 s-table">
        <thead class="dark">
            <tr>
                <td>TIME</td>
                <td>Monday</td>
                <td>Tuesday</td>
                <td>Wednesday</td>
                <td>Thursday</td>
                <td>Friday</td>
            </tr>
        </thead>
            <tr>
                <td>6:00-7:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>7:00-8:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>8:00-9:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>9:00-9:20</td>
                <!-- AM BREAK -->
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>9:20-10:20</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>10:20-11:20</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>11:20-12:20</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>12:20-1:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1:00-2:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2:00-3:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3:00-4:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <tbody>
            
        </tbody>
    </table>
    <button class="rounded-pill">GO BACK</button>   
    <button class="rounded-pill">REJECT</button>
    <button class="rounded-pill">APPROVE</button>
</div>
    <!-- <button>SUBMIT</button> -->
    <div id="div_base">
    <div class="col-xl-12">
    <p class="h5 pb-2">
        <label class="float-right" for="Results">
            <select id="Category" class="mt-1 form-control rounded-0 bg-light">
                <option value="ControlNum" selected = "selected">Request Number</option>
                <option value="SectionNum">Section Number</option>
                <option value="SectionName">Section Name</option>
                
                <option value="GradeLevel">Grade Level</option>
                <option value="SchoolYear">School Year</option>
            
            
                <option value="DateCreated">Date</option>
                <option value="CreatedBy">Teacher ID</option>
                <option value="RequestedBy">Name</option>
                <option value="Action_" style="display: none;">Action</option>
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
            <td id="SectionNum">Section Number</td>
            <td id="SectionName">Section Name</td>
            
            <td id="GradeLevel">Grade Level</td>
            <td id="SchoolYear">School Year</td>
            
            <td id="CreatedBy">ID</td>
            <td id="RequestedBy">Created By</td>
            <td id="DateCreated">Date</td>
            <td id="Action_" style="display: none;">Action</td>
            <td id="Status_">Status</td>
            <td style="width: 2% !important;"></td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</div>
</div>
<?php
include 'partials/footer.php';
?>
<script type="text/javascript">
    Search(window.location.href, "", "", tableUI);
    let results_input = document.querySelector("#Results");
    let category = document.querySelector("#Category");
    let base = document.querySelector("#div_base");
    let schedule = document.querySelector("#div_schedule");
    let base_button = document.querySelectorAll("#div_base button");
    let schedule_button = document.querySelectorAll("#div_schedule button");

    console.log("BASE BUTTONS:"+base_button);
    console.log("SCHEDULE BUTTONS:"+schedule_button);
    schedule.style.display = "none";

    schedule_button[1].addEventListener("click", function(){//GO BACK BUTTOn
        base.style.display = "";
        schedule.style.display = "none";
    });


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

        let btn1, btn2, btn0, class_btn1, class_btn2, class_btn0;
        // console.log(td);
        btn0 = document.createElement('button');
        btn1 = document.createElement('button');
        btn2 = document.createElement('button');
        // btn_Block.innerHTML = "Block";
        // btn_Privilege.innerHTML = "Set as Coordinator";
        btn0.innerHTML = "Show"
        btn1.innerHTML = "Approve";
        btn2.innerHTML = "Reject";

        // btn1.style.width = "100% !important";
        // btn2.style.width = "100% !important";
        if(results[i]["Status_"] == "PENDING"){
            td.appendChild(btn0);
            td.appendChild(btn1);
            td.appendChild(btn2);

        }
        // // td.appendChild(btn_Delete);
        class_btn0 = document.createAttribute("class");
        class_btn1 = document.createAttribute("class");
        class_btn2 = document.createAttribute("class");
        class_btn1.value = "btn_Table";
        class_btn2.value = "btn_Table";
        class_btn0.value = "btn_Table";
        // btn0.setAttibuteNode(class_btn0);
        // btn1.setAttibuteNode(class_btn1);
        // btn2.setAttributeNode(class_btn2); 

        btn0.addEventListener("click", ShowMore.bind(null, i));
        btn1.addEventListener("click", Approval.bind(null, i, "APPROVED"));
        btn2.addEventListener("click", Approval.bind(null, i, "REJECTED"));
    }

    function ShowMore(i){
        schedule.style.display = '';
        base.style.display = "none";
        // console.log(button);
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
    }
</script>