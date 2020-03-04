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
    <p><b>Section Number: </b><span id="txt_GradeLevel"></span></p>
    <p><b>Section Name: </b><span id="txt_Adviser"></span></p>
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
    <button class="rounded-pill">RESET</button>
    <button class="rounded-pill">SUBMIT</button>
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
    // let tbody_tr;
// function Get1stRowCell(i, j){


//     parentCol = j;
//     parentRow = i;
//     time = table.rows[i].cells[0].innerHTML;
//     day = table.rows[0].cells[j].innerHTML;

//     if(content.length == 0){
        
//     }
//     // console.log(time);
//     // console.log(day);
//     if(table.rows[i].cells[j].innerHTML == ""){
//         theadID = "SubjectCode@SubjectDescription@GradeLevel@Frequency";
//         theadHTML = "Subject Code@Description@Grade Level@Units";
//         CreateSearchBox(theadID, theadHTML, '@', 'SubjectCode', 'search', modal_body);
//         // CreateInput("SearchSubjectCode", "search", modal_body);
//         modal_cat = document.querySelector("#modal-body select");
//         CreateTable("SubjectCodeTable", theadID, theadHTML, "@", modal_body, 0, null);

//         searchSubjectCode = document.getElementById("SubjectCode");
//         openModal("Subject Code", "SubjectCode");

//         Search(window.location.href+"#SubjectCode"+txt_GradeLevel.innerHTML, "", PickSubjectCode);
//         searchSubjectCode.addEventListener('change', function(){
//             let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchSubjectCode.value;
//             Search(window.location.href + "#SubjectCode"+txt_GradeLevel.innerHTML, searchBox_value, PickSubjectCode);
//         });
//     }
//     else{
//         // console.log(content.indexOf(table.rows[i].cells[j]));
//         // let sub_content = time
//         // table.rows[i].cells[j].innerHTML = "";
//         // content.splice(index, 1);
//         // sub_content["Day"] = table.rows[0].cells[parentCol].innerHTML;
//         //      sub_content["Time"] = table.rows[parentRow].cells[0].innerHTML;
//         //      sub_content["Teacher"] = teacher;
//         for(let k = 0; k < content.length; k++){
//             if(content[k]["SubjectCode"] == table.rows[i].cells[j].innerHTML){
//                 if(content[k]["Time"] == time && content[k]["Day"] == day){
//                     content.splice(k, 1);
//                     break;
//                 }
//             }
//         }
//         // content.splice(1, 1);
//         table.rows[i].cells[j].innerHTML = "";
//         // console.log(content);
//     }
// }
var subj_tr_container = [];
var tr_display;

btn[1].addEventListener("click", function(){ //RESET BUTTON
    RemoveTD_InnerHTML();
    content = [];
});

btn[2].addEventListener("click", function(){
    // console.log(content);
    if(content.length > 0){
        content = JSON.stringify(content);
        data = "content=" + content;
        data += "&section=" + txt_SectionNum.value;
        data += "&userID=" + userID;
        // Create("", content, messageAlert);   
        AJAX(data, true, "post", "php/Schedule.php", true, requestStatus);
    }
});

function PickSubjectCode(xhttp){
    CreateTBody(xhttp, PickSubjectCode);
    var tbody_tr = document.querySelectorAll("#SubjectCodeTable tbody tr");
    for(let i = 0; i < tbody_tr.length; i++){
        tbody_tr[i].addEventListener("click", function(){
            subjectcode = this.childNodes[0].innerHTML;
            units = this.childNodes[3].innerHTML;
            // alert("GAGO");
            // let count = 0;
            // for(let i = 0; i < content.length; i++){
            //  if(content[i]["SubjectCode"] == subjectcode){
            //      count++;
            //  }
            // }
            // subj_tr_container[];
            


            // console.log(subj_tr_container.length);
            closeModal(modal_body);
            theadID = "TeacherNum@LastName@ExtendedName@FirstName@MiddleName@Shift@Major";
            theadHTML = "Teacher ID@Last Name@Extended Name@First Name@Middle Name@Shift@Major";
            CreateSearchBox(theadID, theadHTML, '@', 'Teacher', 'search', modal_body);
            // CreateInput("SearchSubjectCode", "search", modal_body);
            modal_cat = document.querySelector("#modal-body select");
            CreateTable("TeacherTable", theadID, theadHTML, "@", modal_body, 0, null);

            searchTeacher = document.getElementById("Teacher");
            openModal("Teachers", "Teacher");

            Search(window.location.href+"#Teacher", "", PickTeacher);
            searchTeacher.addEventListener('change', function(){
                let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchTeacher.value;
                Search(window.location.href + "#Teacher", searchBox_value, PickTeacher);
            });
        });
    }
}
// console.log(tr_display);
function PickTeacher(xhttp){
    CreateTBody(xhttp, PickTeacher);
    var tbody_tr = document.querySelectorAll("#TeacherTable tbody tr");
    // console.log(tr_display);
    // alert(tr_display);
    for(let i = 0; i < tbody_tr.length; i++){

        for(let j = 0; j < subj_tr_container.length; j++){
            if(subj_tr_container[j]["SubjectCode"] == subjectcode) {
                if(subj_tr_container[j]["Row"] == i){
                    tbody_tr[i].style.display = ""
                }
                else{
                    tbody_tr[i].style.display = "none"; 
                }
            }
        }
        // if(tr_display == i){
        //  alert(i);
        // }
        tbody_tr[i].addEventListener("click", function(){
            let teacher = this.childNodes[0].innerHTML;
            // subjectcode = this.childNodes[0].innerHTML;
            // units = this.childNodes[3].innerHTML;
            // console.log(content[0]["SubjectCode"]);
            let count = 0;
            for(let j = 0; j < content.length; j++){
                if(content[j]["SubjectCode"] == subjectcode){
                    count++;
                }
            }
            // console.log(tr_display);
            if(count < units){
                let subj_tr_pair = {};
                subj_tr_pair["SubjectCode"] = subjectcode;
                subj_tr_pair["Row"] = i;
                subj_tr_container.push(subj_tr_pair);
                // console.log(subj_tr_container);
                table.rows[parentRow].cells[parentCol].innerHTML = subjectcode;
                let sub_content = {};
                sub_content["SubjectCode"] = subjectcode;
                sub_content["Day"] = table.rows[0].cells[parentCol].innerHTML;
                sub_content["Time"] = table.rows[parentRow].cells[0].innerHTML;
                sub_content["Teacher"] = teacher;
                content.push(sub_content);
                // console.log("Time:" + table.rows[parentRow].cells[0].innerHTML);
                // console.log("Day:" + table.rows[0].cells[parentCol].innerHTML);
            }
            else{
                alert(subjectcode +" is only " + units + " times a week");
            }
            closeModal(modal_body);
        });
    }
}


btn[0].addEventListener("click", function(){
    this.style.backgroundColor = "";
    theadID = "SectionNum@SectionName@RoomNum@GradeLevel@SchoolYear@Adviser@AdviserName";
    theadHTML = "Section Number@Section Name@Room Number@Grade Level@School Year@Adviser@Adviser Name";
    // CreateInput("SearchSection", "search", modal_body);
    CreateSearchBox(theadID, theadHTML, '@', 'SearchSection', 'search', modal_body);
    // theadID = "SectionNum@" + theadID;
    // theadHTML = "Section Number@" + theadHTML;
    modal_cat = document.querySelector("#modal-body select");
    // document.querySelector("#SearchSection").className = "modal-search";
    CreateTable("SearchSectionTable", theadID, theadHTML, "@", modal_body, 0, null);
    document.querySelector("thead").className = "dark";
    openModal("Section", "SearchSection");
    searchSection = document.getElementById("SearchSection");
    SearchSectionModal = function(){
        let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchSection.value;
        // console.log(searchBox_value);
        Search(window.location.href + "#Section", searchBox_value, PickSection);
    }
    SearchSectionModal();
    searchSection.addEventListener("change", SearchSectionModal);
});

function PickSection(xhttp){
    content = [];
    CreateTBody(xhttp, PickSection);
    // console.log(modal_body);
    var tbody_tr = document.querySelectorAll("#SearchSectionTable tbody tr");
    for(var i = 0; i < tbody_tr.length; i++){
        tbody_tr[i].addEventListener("click", function(){
            document.querySelector("#SearchSection").value = "";
            // console.log(this);
            closeModal(modal_body);
            txt_SectionNum.value = this.childNodes[0].innerHTML;
            txt_SectionName.value = this.childNodes[1].innerHTML;
            txt_GradeLevel.innerHTML = this.childNodes[3].innerHTML;
            txt_Adviser.innerHTML = this.childNodes[6].innerHTML;

            // RetrieveSectionSchedule();
            AddListenersTD();
        });
    }
}

btn[3].addEventListener("click", function(){
    theadID = "ControlNum@SectionNum@none@DateCreated@Action_@Status_";
    theadHTML = "Control No.@Section No.@none@DateCreated@Action_@Status_";
    CreateSearchBox(theadID, theadHTML, '@', 'Request', 'search', modal_body);
    // CreateInput("SearchSubjectCode", "search", modal_body);
    let hiddenCol = "none"
    modal_cat = document.querySelector("#modal-body select");
    CreateTable("RequestTable", theadID, theadHTML, "@", modal_body, 0, hiddenCol);

    let searchRequest = document.getElementById("Request");
    openModal("Requests", "Request");

    Search(window.location.href+"#Request", "", PickRequest);
    // url = "php/ScheduleRequest.php";
    // AJAX(data, true, "post", url, true, PickRequest);
    searchRequest.addEventListener('change', function(){
        let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchRequest.value;
        Search(window.location.href + "#Request", searchBox_value, PickRequest);
        // AJAX(data, true, "post", url, true, PickRequest);
    });
});

function PickRequest(xhttp){
    CreateTBody(xhttp, PickRequest);
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
            data += this.childNodes[0].innerHTML;
            // RemoveListenersTD();
            AJAX(data, true, "post", "php/ScheduleRequest.php", true, Retrieve);
            // Create("php/ScheduleRequest.php", content, Retrieve);
        });
    }
}

function Retrieve(xhttp){
    content = [];
    let json = JSON.parse(xhttp.responseText);
    txt_Adviser.innerHTML = json[0][3];
    txt_GradeLevel.innerHTML = json[0][2];
    txt_SectionName.value = json[0][1];
    txt_SectionNum.value = json[0][0];

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


