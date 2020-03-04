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
	<!-- <button>SUBMIT</button> -->
	<button class="rounded-pill">RESET</button>
	<button class="rounded-pill">SUBMIT</button>
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
function Get1stRowCell(i, j){
	parentCol = j;
	parentRow = i;
	time = table.rows[i].cells[0].innerHTML;
	day = table.rows[0].cells[j].innerHTML;

	// console.log(time);
	// console.log(day);
	if(table.rows[i].cells[j].innerHTML == ""){
		theadID = "SubjectCode@SubjectDescription@GradeLevel@Frequency";
		theadHTML = "Subject Code@Description@Grade Level@Units";
		CreateSearchBox(theadID, theadHTML, '@', 'SubjectCode', 'search', modal_body);
		// CreateInput("SearchSubjectCode", "search", modal_body);
		modal_cat = document.querySelector("#modal-body select");
		CreateTable("SubjectCodeTable", theadID, theadHTML, "@", modal_body, 0, null);

		searchSubjectCode = document.getElementById("SubjectCode");
		openModal("Subject Code", "SubjectCode");

		Search(window.location.href+"#SubjectCode"+txt_GradeLevel.innerHTML, "", PickSubjectCode);
		searchSubjectCode.addEventListener('change', function(){
			let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchSubjectCode.value;
			Search(window.location.href + "#SubjectCode"+txt_GradeLevel.innerHTML, searchBox_value, PickSubjectCode);
		});
	}
}

// function PickSubjectCode(xhttp){
// 	CreateTBody(xhttp, PickSubjectCode);
// 	let tbody_tr = document.querySelectorAll("#SubjectCodeTable tbody tr");
// 	for(let i = 0; i < tbody_tr.length; i++){
// 		tbody_tr[i].addEventListener("click", function(){
// 			closeModal(modal_body);
// 			let subjectcode = this.childNodes[0].innerHTML;
// 			let units = this.childNodes[3].innerHTML;
// 			// console.log(content[0]["SubjectCode"]);
// 			let count = 0;
// 			for(let i = 0; i < content.length; i++){
// 				if(content[i]["SubjectCode"] == subjectcode){
// 					count++;
// 				}
// 			}

// 			if(count < units){
// 				table.rows[parentRow].cells[parentCol].innerHTML = subjectcode;
// 				let sub_content = {};
// 				sub_content["SubjectCode"] = subjectcode;
// 				sub_content["Day"] = table.rows[0].cells[parentCol].innerHTML;
// 				sub_content["Time"] = table.rows[parentRow].cells[0].innerHTML;

// 				content.push(sub_content);
// 				console.log("Time:" + table.rows[parentRow].cells[0].innerHTML);
// 				console.log("Day:" + table.rows[0].cells[parentCol].innerHTML);
// 			}
// 			else{
// 				alert(subjectcode +" is only " + units + " times a week");
// 			}
// 		});
// 	}
// }

var subj_tr_container = [];
var tr_display;

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
			// 	if(content[i]["SubjectCode"] == subjectcode){
			// 		count++;
			// 	}
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
		// 	alert(i);
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
				console.log(subj_tr_container);
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
		console.log(searchBox_value);
		Search(window.location.href + "#Section", searchBox_value, PickSection);
	}
	SearchSectionModal();
	searchSection.addEventListener("change", SearchSectionModal);
});

function PickSection(xhttp){
	for(let i = 1; i < tr.length+1; i++){
		for(let j = 1; j < tr[0].childElementCount; j++){
			table.rows[i].cells[j].addEventListener("click", Get1stRowCell.bind(null, i, j));
		}
	}
	CreateTBody(xhttp, PickSection);
	console.log(modal_body);
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
		});
	}
}

btn[1].addEventListener("click", function(){ //RESET BUTTON
	// if(txt_SectionNum.value != ''){
	// 	var query;
	// 	Search = function(){
	// 		RetrieveSectionSchedule();
	// 	}
	// 	query = "SubjectID LIKE '" + txt_SectionNum.value + "-%'";
	// 	// console.log(query);
	// 	DeleteRecord("sched", query, DeleteSubjID);
	// 	function DeleteSubjID(xhttp){
	// 		DeleteRecord("subject", query, null);
	// 	}
	// }
	// else{
	// 	alert("Select section first");
	// 	openSectionModal.style.backgroundColor = "pink";
	// }	
	for(let i = 1; i < tr.length+1; i++){
		for(let j = 1; j < tr[0].childElementCount; j++){
			// table.rows[i].cells[j].addEventListener("click", Get1stRowCell.bind(null, i, j));
			table.rows[i].cells[j].innerHTML = "";
		}
	}
	content = [];
});

btn[2].addEventListener("click", function(){
	// console.log(content);
	content = JSON.stringify(content);
	data = "content=" + content;
	data += "&section=" + txt_SectionNum.value;
	data += "&userID=" + userID;
	// Create("", content, messageAlert);	
	AJAX(data, true, "post", "php/Schedule.php", true, messageAlert);
});

function messageAlert(xhttp){
	console.log(xhttp.responseText);
	// console.log(JSON.parse(xhttp.responseText));
	// location.reload(true);
}
</script>


