<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Section Scheduling');
    $('#schedule').addClass('active');
</script>
   
    <div class="content-main mt-5">
    <div id="modal">
        <div id="modal-content">
            <span id="close" onclick="closeModal(document.getElementById('modal-body'));">&times;</span>
            <div id="modal-header">
                <h2 id="modal-title"></h2>
            </div>
            <div id= "modal-body">
            </div>
            
            <div id="modal-footer"> 
            </div>
        </div>
    </div>

    <!-- <div class="float-left">
        <input type="text" id="txt_SectionNum" style="display: none;"/>
            <label for="">Section Name: <input class="ml-2 sec-name" type="text" id="txt_SectionName" required/></label>
            <button class="modal-button"><i class="far fa-window-restore"></i></button>
        
    </div>
    <br/> -->
    <p><b>Section Number: </b><span id="txt_SectionNum"></span></p>
    <p><b>Section Name: </b><span id="txt_SectionName"></span></p>
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
    <!-- <button>SUBMIT</button> -->
    <button class="rounded-pill">REJECT</button>
    <button class="rounded-pill">APPROVE</button>
    <button class="rounded-pill" style="width: 20% !important">SHOW REQUESTS</button>
    <!-- <button class="rounded-pill">RESET</button> -->

    <script type="text/javascript">
        // var user = "php echo($_SESSION['access']);?>";
        // console.log(user);
    </script>

    <!-- <script type="text/javascript" src="../js/Scheduling.js"></script> -->

<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
    // parent_id = "Subject";
    let tr = document.querySelectorAll("tbody tr");
    let table = document.querySelector("table");
    let modal_body = document.getElementById("modal-body");
    let btn = document.querySelectorAll("button");
    let modal_cat;
    let parentCol;
    let parentRow;
    let txt_SectionNum = document.getElementById("txt_SectionNum")
    let txt_SectionName = document.getElementById("txt_SectionName")
    let txt_GradeLevel = document.getElementById("txt_GradeLevel")
    let txt_Adviser = document.getElementById("txt_Adviser")
    let content = [];
    let subjectcode;
    let units;

var subj_tr_container = [];
var tr_display;

var controlNum;

btn[0].addEventListener("click", function(){ //REJECT BUTTON
    
    // AJAX(data, true, "post", "php/Create.php", true, callback);
    data = "";
    data += "cnum=" + controlNum;
    AJAX(data, true, "post", "php/ScheduleRequest.php", true, Retrieve);
});

btn[1].addEventListener("click", function(){ //APPROVE BUTTON
    // console.log(content);
    // if(content.length > 0){
    //     content = JSON.stringify(content);
    //     data = "content=" + content;
    //     data += "&section=" + txt_SectionNum.value;
    //     data += "&userID=" + userID;
    //     // Create("", content, messageAlert);   
    //     AJAX(data, true, "post", "php/Schedule.php", true, requestStatus);
    // }
});

btn[2].addEventListener("click", function(){
    theadID = "ControlNum@SectionNum@none@DateCreated@Action_@Status_";
    theadHTML = "Control No.@Section No.@none@DateCreated@Action_@Status_";
    CreateSearchBox(theadID, theadHTML, '@', 'Request', 'search', modal_body);
    // CreateInput("SearchSubjectCode", "search", modal_body);
    let hiddenCol = "none"
    modal_cat = document.querySelector("#modal-body select");
    CreateTable("RequestTable", theadID, theadHTML, "@", modal_body, 0, hiddenCol);

    let searchRequest = document.getElementById("Request");
    openModal("Requests", "Request");
    console.log()
    Search(window.location.href+"#Request", "", "", PickRequest);
    // url = "php/ScheduleRequest.php";
    // AJAX(data, true, "post", url, true, PickRequest);
    searchRequest.addEventListener('change', function(){
        let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchRequest.value;
        Search(window.location.href + "#Request", searchBox_value, "", PickRequest);
        // AJAX(data, true, "post", url, true, PickRequest);
    });
});

function PickRequest(xhttp){
    // alert("GAGO");
    CreateTBody(xhttp, PickRequest, "");

    var tbody_tr = document.querySelectorAll("#RequestTable tbody tr");
    for(var i = 0; i < tbody_tr.length; i++){
        tbody_tr[i].addEventListener("click", function(){
            document.querySelector("#Request").value = "";
            // console.log(this);
            closeModal(modal_body);
            // txt_SectionNum.value = this.childNodes[0].innerHTML;
            // txt_SectionName.value = this.childNodes[1].innerHTML;
            // txt_GradeLevel.innerHTML = this.childNodes[3].innerHTML;
            // txt_Adviser.innerHTML = this.childNodes[6].innerHTML;

            // RetrieveSectionSchedule();
            data = "cnum="
            controlNum = this.childNodes[0].innerHTML; 
            data += this.childNodes[0].innerHTML;
            
            AJAX(data, true, "post", "php/ScheduleRequest.php", true, Retrieve);
            // Create("php/ScheduleRequest.php", content, Retrieve);
        });
    }
}

function Retrieve(xhttp){
    // content = [];
    let json = JSON.parse(xhttp.responseText);
    txt_Adviser.innerHTML = json[0][3];
    txt_GradeLevel.innerHTML = json[0][2];
    txt_SectionName.innerHTML = json[0][1];
    txt_SectionNum.innerHTML = json[0][0];

    RemoveTD_InnerHTML();
    try{
        for(var i = 0; i < json.length; i++){
            // console.log(table.rows[GetParentRow(json[i][1])]);
            // console.log(json[i]);
            table.rows[GetParentRow(json[i][6])].cells[GetParentCol(json[i][5])].innerHTML = json[i][4];
            let sub_content = {};
            sub_content["SubjectCode"] = json[i][4];
            sub_content["Day"] = json[i][5];
            sub_content["Time"] = json[i][6];
            sub_content["Teacher"] = json[i][7];
            content.push(sub_content);
        }
        // json[3] => SubjectCode
        // json[1] => Time //parentRow
        // json[2] => Day //parentCol
        
    }
    catch(err){
        console.log(err);
    }
}

function AddListenersTD(){
    for(let i = 1; i < tr.length+1; i++){
        for(let j = 1; j < tr[0].childElementCount; j++){
            table.rows[i].cells[j].addEventListener("click", Get1stRowCell.bind(null, i, j));
        }
    }
}

function RemoveTD_InnerHTML(){
    for(let j = 1; j < tr.length+1; j++){
        for(let k = 1; k < tr[0].childElementCount; k++){
            table.rows[j].cells[k].innerHTML = "";
            // table.rows[j].cells[k].removeEventListener("click", Get1stRowCell.bind(null, j, k));
            // console.log("GAGO");
        }
    }
    // console.log("GAGO");
    // btn[0].disabled = "disabled";
    // btn[1].disabled = "disabled";
    // btn[2].disabled = "disabled";
}
</script>


