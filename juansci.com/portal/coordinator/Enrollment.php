<?php include 'partials/header.php'; ?>
<style type="text/css">
	.rounded-pill{
		float:left !important;
	}

	.btn-active {
        background-color: white;
        border: 2px solid #dc3545;
        color: #dc3545;
    }
	/*.rounded-pill :active{
		background-color: black !important;
	}*/
</style>
<script type="text/javascript">
    $('#lead').text('Student Drafting');
    $('#student').addClass('active');
</script>
<style type="text/css">
	input{
		width: 100% !important;
		/*float: right;*/
	}
	input, #form_enroll button{
		/*float: left;*/
		display: block !important;
		float: right !important;
	}

	#Col2 button{
		height: 2.4em !important;
		width: 20% !important;
	}

	/*#Col2 button:active{
		background-color: black !important;
	}*/

	#Col1 p{
		font-weight: bold;
		margin-bottom: 1rem !important;
	}

	#Col2 p{
		padding-bottom: 3rem !important;
		/*color: pink !important;*/
	}
	
</style>
<div class="content-main mt-4">
	<div class="row">
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
	<div id="firstCol" class="ml-5">
		<div id="form_GradeLevel">
			<h4 style="border-bottom: solid black 0.1em; margin: 2rem 0rem -0.3rem 0rem;">Select a Grade Level:</h4>
			<button class="rounded-pill btn-active">Grade 7</button>
			<button class="rounded-pill">Grade 8</button>
			<button class="rounded-pill">Grade 9</button>
			<button class="rounded-pill">Grade 10</button>
		</div>
		<!-- <button class="btn-sm btn-light border-dark ml-4">Grade 7</button> -->
		<div id="form_enroll" style="margin-top: 15% !important;">
			<div style="float: left; width: 30%;" id="Col1">
				<p style="margin-top: 8% !important;"><label for="">LRN Number:</label> </p>
				<p><label for="txt_StudentName">Student Name: </label></p>
				<p style="margin-top: -5% !important;"><label for="txt_GWA">Final Average Grade: </label></p>
			</div>
			<div style="float: right; width: 70%;" id="Col2">
				<p>
					<button class="modal-button"><i class="far fa-window-restore"></i></button>
					<input class="form-control" type="search" id="txt_LRNNum" disabled style="width: 80% !important;" />
				</p>
				<p>
					<input class="form-control" type="search" id="txt_StudentName" disabled/>
				</p>
				<p>
					<input class="form-control" type="number" id="txt_GWA" max="100" min="60" maxlength=3 oninput="GWAValidity()">
				</p>
			</div>
			<!-- <button class="rounded-pill" id="btn_Transferee"></button> -->
			<button class="rounded-pill" style="position: fixed !important; bottom: 0 !important; margin-bottom: 2rem !important;" id="btn_Enroll">ENROLL</button>
		</div>
		
	</div>
<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
let col2 = document.querySelector("#Col2");
let col1 = document.querySelector("#Col1");
let btn_Enroll = document.querySelector("#btn_Enroll");
let modal_Button = document.querySelector(".modal-button");
let modal_body = document.querySelector("#modal-body");
let form_enroll = document.querySelector("#form_enroll");
let gradeLevel = 7;
let btn_GradeLevel = document.querySelectorAll("#form_GradeLevel button");

for(let i = 0; i < btn_GradeLevel.length; i++){ //SHOW form_enroll
	btn_GradeLevel[i].addEventListener("click", function(){
		gradeLevel = 0;
		gradeLevel = i + 7;
		let current = document.querySelector(".btn-active");
		current.className = current.className.replace(" btn-active", "");
		this.className += " btn-active";
	});
}

modal_Button.addEventListener("click", function(){
	// alert("HI");
	let theadID, theadHTML, modal_cat;
	theadID = "LRNNum@LastName@ExtendedName@FirstName@MiddleName";
	theadHTML = "LRN@LastName@ExtendedName@FirstName@MiddleName";
	CreateSearchBox(theadID, theadHTML, '@', 'AvailableStudents', 'search', modal_body);
	CreateTable("AvailableStudentsTable", theadID, theadHTML, "@", modal_body, 0, null);
	searchStudent = document.getElementById("AvailableStudents");
	modal_cat = document.querySelector("#modal-body select");

	
	openModal("Grade " + gradeLevel, "AvailableStudents");

	// let data = "";
	// data += "gradeLevel=" + gradeLevel;
	SearchStudent();
	searchStudent.addEventListener("change", SearchStudent);
	function SearchStudent(){
	    let searchBox_value = modal_cat.options[modal_cat.selectedIndex].value + "=" + searchStudent.value;
	    Search(window.location.href + "#"+gradeLevel, searchBox_value, PickRoom)
	}
	// AJAX(data, true, "post", "php/Enrollee.php", true, checkEnrolled);
});

function checkEnrolled(xhttp){

}







// btn_GradeLevel[0].addEventListener("click", function(){
	
// });
// btn_GradeLevel[1].addEventListener("click", function(){
	
// });
// btn_GradeLevel[2].addEventListener("click", function(){
	
// });
// btn_GradeLevel[3].addEventListener("click", function(){
	
// });


btn_GradeLevel[0].addEventListener("click", function(){
	if(!document.querySelector("#txt_GWA")){
		
	}
});

function GWAValidity(){
	let GWA = document.querySelector("#txt_GWA");
	if(!GWA.checkValidity()){
		GWA.reportValidity();
	}

	if(GWA.value > 100){
		GWA.value = (GWA.value).slice(0,-1);
	}
	if(GWA.value < 60){
		if(GWA.value.length > 2){
			GWA.value = (GWA.value).slice(0,-1);
		}
		GWA.value = GWA.value.replace("-", "");
	}
}

btn_Enroll.addEventListener("click", function(){
	GWAValidity();
	let data = "";
	data += "gradeLevel=" + gradeLevel;
	AJAX(data, true, "post", "php/Enrollee.php", true, callback);
	// alert(gradeLevel);	
});	

// alert(btn_Enroll);


// function CreateGWA(){
// 	let p1 = document.createElement("p");
// 	let p2 = document.createElement("p");
// 	let label = document.createElement("label");
// 	let input = document.createElement("input");

// 	let input_class = document.createAttribute("class");
// 	let input_onblur = document.createAttribute("onblur");
// 	let label_for = document.createAttribute("for");

// 	label_for.value = "txt_GWA";
// 	label.setAttributeNode(label_for);

// 	input_onblur.value = "GWAValidity()";
// 	input_class.value = "form-control";
// 	input.setAttributeNode(input_class);
// 	input.setAttributeNode(input_onblur);

// 	input.type = "number";
// 	input.id = "txt_GWA";
// 	input.max = 100;
// 	input.min = 60;	
// 	input.value = 85;

// 	label.for = "txt_GWA";
// 	label.innerHTML = "Final Grade: ";

// 	p1.appendChild(label);
// 	p2.appendChild(input);
// 	col1.appendChild(p1);
// 	col2.appendChild(p2);
// }

// var parent_id;
// var saved_id;

// var buttons = document.querySelectorAll("button");
// var inputs = document.querySelectorAll("input");
// var modal_body = document.getElementById("modal-body");
// var txt_StudentName = document.getElementById("txt_StudentName");
// var txt_LRNNum = document.getElementById("txt_LRNNum");
// var txt_GradeLevel = document.getElementById("txt_GradeLevel");
// var tr = document.querySelectorAll("tbody tr");
// var table = document.querySelector("table");

// var parent_id;
// var saved_id;
// var theadID;
// var theadHTML; 
// var SubjectID;
// var Search;

// // var state = "";

// buttons[0].addEventListener("click", function(){
// 	state = "Add";
// 	this.style.backgroundColor = "#dc3545";
// 	this.style.color="white";
// 	buttons[1].style.backgroundColor = "";
// 	buttons[1].style.color="black";
// 	EmptyNode(inputs);
// });

// buttons[1].addEventListener("click", function(){
// 	state = "Change";
// 	this.style.backgroundColor = "#dc3545";
// 	this.style.color="white";
// 	buttons[0].style.backgroundColor = "";
// 	buttons[0].style.color="black";
// 	for(var i = 0; i < inputs.length; i++){
// 		inputs[i].value = "";
// 	}
// });

// buttons[2].addEventListener("click", function(){
// 	// console.log(typeof state);
// 	if(state !== ""){
// 		buttons[2].style.backgroundColor = '';

// 		if(state == "Add"){
// 			theadID = "LRNNum@LastName@FirstName@MiddleName@GradeLevel";
// 			theadHTML = "LRN Number@Last Name@First Name@Middle Name@Grade Level";
// 		}
// 		else if(state == "Change"){
// 			theadID = "LRNNum@LastName@FirstName@MiddleName@GradeLevel@section.SectionName@section.SectionNum";
// 			theadHTML = "LRN Number@Last Name@First Name@Middle Name@Grade Level@Section Name@SectionNum";
// 		}
		
// 		CreateInput("SearchStudent", "search", modal_body);
// 		CreateTable("SearchStudentTable", theadID, theadHTML, "@", modal_body, 0, "EmployeeNum@section.SectionNum");
// 		document.querySelector("thead").className = "dark";
// 		openModal("List of Students", "Student");
// 		var searchStudent = document.getElementById('SearchStudent'); 
// 		Search = function(){
// 			if(state == "Add"){
// 				SearchWithQuery(
// 					"Student", 
// 					"Student_Section", 
// 					GetID(document.querySelectorAll("#SearchStudentTable thead td"), 0), 
// 					null, 
// 					"LEFT JOIN", 
// 					"student.LRNNum = student_section.LRNNum AND student.GradeLevel = student_section.GradeLevel", 
// 					searchStudent, 
// 					"student_section.LRNNum IS NULL", 
// 					PickStudent
// 				);
// 			}
// 			else if(state == "Change"){
// 				SearchWithQuery(
// 					"Student", 
// 					"Student_Section", 
// 					GetID(document.querySelectorAll("#SearchStudentTable thead td"), 0), 
// 					"Section Name = section.SectionName", 
// 					"INNER JOIN", 
// 					"student.LRNNum = student_section.LRNNum AND student.GradeLevel = student_section.GradeLevel INNER JOIN section on student_section.SectionNum = section.SectionNum", 
// 					searchStudent, 
// 					null, 
// 					PickStudent
// 				);
// 			}
// 		}
// 		Search();

// 		searchStudent.addEventListener('change', Search);
// 	}
// 	else{
// 		alert("Select first: Add or Change Section");
// 		buttons[0].style.backgroundColor = "pink";
// 		buttons[1].style.backgroundColor = "pink";
// 	}
// });

// function PickStudent(xhttp){
// 	CreateTBody(xhttp, PickStudent);
// 	var tbody_tr = document.querySelectorAll("#SearchStudentTable tbody tr");
// 	for(var i=0; i < tbody_tr.length; i++){
// 		tbody_tr[i].addEventListener("mouseover", function(){
// 			this.style.backgroundColor = '#dc3545';
// 			this.style.color = "white";
// 		});
// 		tbody_tr[i].addEventListener("mouseout", function(){
// 			this.style.backgroundColor = '';
// 			this.style.color = "";
// 		});
// 		tbody_tr[i].addEventListener("click", function(){
// 			txt_StudentName.value = this.children[1].innerHTML + ", " + this.children[2].innerHTML + " " + (this.children[3].innerHTML).substr(0,1) + ".";
// 			txt_LRNNum.value = this.children[0].innerHTML;
// 			txt_GradeLevel.value =  this.children[4].innerHTML;
// 			if(state == "Change"){
// 				txt_SectionName.value =  this.children[5].innerHTML;
// 				txt_SectionNum.value =  this.children[6].innerHTML;
// 			}
// 			closeModal(modal_body);
// 		});
// 	}
// }

// buttons[3].addEventListener("click", function(){
// 	if(state !== ""){
// 		if(txt_LRNNum.value == ""){
// 			buttons[2].style.backgroundColor = 'pink';
// 			alert("Choose a student first");
// 		}
// 		else{
// 			theadID = "SectionNum@SectionName@Adviser@Population";
// 			theadHTML = "SectionNum@Section Name@Adviser@Population";
// 			CreateInput("SearchSection", "search", modal_body);
// 			CreateTable("SearchSectionTable", theadID, theadHTML, "@", modal_body, 0, "SectionNum");
// 			document.querySelector("thead").className = "dark";
// 			openModal("List of Sections", "Section");
// 			var searchSection = document.getElementById('SearchSection'); 
// 			Search = function(){ //set Search function inside cms.js
// 				var query = "";
// 				var crud = "";
// 				var basequery = query;
// 				var nospaces;
// 				var content;
// 				query += "SELECT section.SectionNum,section.SectionName, ";
// 				query += "IF(MiddleName IS NULL, CONCAT(LastName , IF(Extension is NULL, '', Extension), ', ' , FirstName, '' , ''), CONCAT(LastName, IF(Extension is NULL, '', Extension), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Adviser, ";
// 				query += "COUNT(LRNNum) AS Population ";
// 				query += "FROM section LEFT JOIN employee ON employee.EmployeeNum = section.EmployeeNum ";
// 				query += "LEFT JOIN student_section ON student_section.SectionNum = section.SectionNum ";
// 				query += "WHERE section.GradeLevel =" + txt_GradeLevel.value +" ";
// 				crud = "SELECT";
// 				basequery = query;
// 				nospaces;
// 				content;
// 				nospaces = (searchSection.value).trim();
// 				content = nospaces.split("=");
// 				if(content.length > 1){
// 					content[0] = content[0].replace(/ /g, "");
// 					content[0] = content[0].replace("Number" , "Num");
// 					content[1] = content[1].trim();
// 						// console.log(content[0].toLowerCase() == "adviser");
// 					if(content[0].toLowerCase() != "teacher" && content[0].toLowerCase() != "adviser"){
// 						query += " WHERE " + "section." +content[0] + " LIKE '" + content[1]+ "%'";
// 					}
// 					else{
// 						query += " WHERE " + "teacher.Name LIKE'" + content[1]+ "%'";
// 					}
// 				}
// 				else if(content.length == 1){
// 					query += "";
// 				}
// 				query += "GROUP BY section.SectionNum";
// 				SimplifiedQuery(crud, query, searchSection, PickSection);
// 			}
// 			Search();

// 			searchSection.addEventListener('change', Search);
// 		}
// 	}
// 	else{
// 		alert("Select first: Add or Change Section");
// 		buttons[0].style.backgroundColor = "pink";
// 		buttons[1].style.backgroundColor = "pink";
// 	}
// });

// function PickSection(xhttp){
// 	CreateTBody(xhttp, PickSection);
// 	var tbody_tr = document.querySelectorAll("#SearchSectionTable tbody tr");
// 	for(var i=0; i < tbody_tr.length; i++){
// 		tbody_tr[i].addEventListener("mouseover", function(){
// 			this.style.backgroundColor = '#dc3545';
// 			this.style.color = "white";
// 		});
// 		tbody_tr[i].addEventListener("mouseout", function(){
// 			this.style.backgroundColor = '';
// 			this.style.color = "";
// 		});
// 		tbody_tr[i].addEventListener("click", function(){
// 			var crud;
// 			var query;
// 			if(state == "Change"){
// 				crud = "UPDATE";
// 				query = "UPDATE student_section SET SectionNum = " + this.children[0].innerHTML;
// 				query += ", User = '" + user + "' WHERE ";
// 				query += "LRNNum = " + txt_LRNNum.value + " AND GradeLevel = " + txt_GradeLevel.value;
// 			}
// 			else if(state == "Add"){
// 				crud = "INSERT";
// 				query = "INSERT into student_section";
// 				query += "(LRNNum, SectionNum, GradeLevel, User) ";
// 				query += "VALUES("+txt_LRNNum.value+", "+this.children[0].innerHTML+", "+txt_GradeLevel.value+", '"+user+"')";

// 			}

// 			SimplifiedQuery(crud, query, null, UpdateSection);
// 			closeModal(modal_body); 
// 		});
// 	}
// }

// function UpdateSection(xhttp){
	
// 	alert(xhttp.responseText);
// 	EmptyNode(inputs);
// }
</script>