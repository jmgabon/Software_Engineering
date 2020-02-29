//POPULATION IS THE PROBLEM
var searchSection = document.getElementById("SearchSection");
var createSection = document.getElementById("CreateSection");
var resetSection = document.getElementById("ResetSection");
var modal_body = document.getElementById("modal-body");
var cat;
// var cat = document.getElementById("Category");
var searchTeacher;
var searchRoom;
// var modal_cat;


var parent_id = "Section"; //
var saved_id;

var theadID;
var theadHTML;
var Search;
console.log(GetID(document.querySelectorAll("#SearchSectionTable thead td"), 0));
var table1, table2;

Search = function(){ //set Search function inside cms.js
	cat = document.getElementById("Category");
	var query = "";
	var crud = "";
	var basequery = query;
	var nospaces;
	var content;
	// query += "SELECT section.SectionNum,section.SectionName, RoomNum, teacher.EmployeeNum, teacher.Name, ";
	query += "SELECT section.SectionNum,section.SectionName, RoomNum, ";
	query += "employee.EmployeeNum, "
	query += "IF(MiddleName IS NULL, CONCAT(LastName , IF(Extension is NULL, '', Extension), ', ' , FirstName, '' , ''), CONCAT(LastName, ' ', IF(Extension is NULL, '', Extension), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Adviser, ";
	query += "COUNT(LRNNum) AS Population, section.GradeLevel ";
	query += "FROM section LEFT JOIN employee ON employee.EmployeeNum = section.EmployeeNum ";
	query += "LEFT JOIN student_section ON student_section.SectionNum = section.SectionNum ";
	crud = "SELECT";
	console.log(query);
	query += "GROUP BY section.SectionNum ";
	query += "HAVING " + cat.options[cat.selectedIndex].value + " LIKE '" + searchSection.value + "%'", 
	console.log(query);
	SimplifiedQuery(crud, query, searchSection, CreateTBody);
}

var initialValue = function(){ //set initialValue of inputs
	document.getElementById("Population").value = 0;
}

Search();

createSection.addEventListener("click", function(){
	Create(
		createSection, 
		"Teacher", 
		1, //If autoincrement
		"SectionNum", //Foreign Key
		"EmployeeNum", //fieldToUpdate
		CheckIfCreated,
		CheckIfUpdated
	);
	// document.getElementById("Population").value = 0;
});

resetSection.addEventListener("click", function(){
	ResetInput(initialValue);
});

searchSection.addEventListener("change", Search);

// function CreateInput(input_id, type, parentNode){	//Creates input tag with id 
function CreateModal(header, title){ //Shows modal in html that is hidden then creates content
	if(title == 'Room'){
		theadID = "RoomNum@RoomName";
		theadHTML = "Room Number@Room Name";
		// function CreateSearchBox(thead_id, theadHTML, seperator, input_id, type, parentNode){
		// CreateSelect(theadID, theadHTML, "@", modal_body);
		// CreateInput("SearchRoom", "search", modal_body);
		CreateSearchBox(theadID, theadHTML, '@', 'SearchRoom', 'search', modal_body);
		CreateTable("SearchRoomTable", theadID, theadHTML, "@", modal_body, 0, null);
		searchRoom = document.getElementById("SearchRoom");
		cat = document.querySelector("#modal-body select");
		// console.log(cat.options[cat.selectedIndex]);
		SearchRoomSection();
		searchRoom.addEventListener("change", SearchRoomSection);
		function SearchRoomSection(){
			SearchWithQuery(
				"Room",
				"Section",
				GetID(document.querySelectorAll("#SearchRoomTable thead td"), 0),
				null,
				"LEFT JOIN",
				"room.RoomNum = section.RoomNum",
				cat.options[cat.selectedIndex].value + "=" + searchRoom.value,
				// searchRoom,
				"section.SectionName IS NULL AND Type = 'Classroom'",
				PickRoom
			);
		}
	}

	else if(title == 'Teacher'){
		theadID = "employee.EmployeeNum@LastName@Extension@FirstName@Middle Name";
		theadHTML = "Employee Number@Last Name@Extension@First Name@Middle Name";
		CreateSearchBox(theadID, theadHTML, '@', 'SearchTeacher', 'search', modal_body);
		hiddenCol = "Name";
		theadHTML += "@" + hiddenCol;
		theadID += "@" + hiddenCol;
		
		// CreateInput("SearchTeacher", "search", modal_body);
		CreateTable("SearchTeacherTable", theadID, theadHTML, "@", modal_body, 0, hiddenCol);
		columnIDS = GetID(document.querySelectorAll("#SearchTeacherTable thead td"), 0);
		cat = document.querySelector("#modal-body select");
		searchTeacher = document.getElementById("SearchTeacher");
		SearchTeacherSection();
		searchTeacher.addEventListener("change", SearchTeacherSection);
		function SearchTeacherSection(){
			var query = "";
			var crud = "";
			var basequery = query;
			var nospaces;
			var content;
			query += "SELECT employee.EmployeeNum, LastName, Extension,FirstName, MiddleName, ";
			query += "IF(MiddleName IS NULL, CONCAT(LastName , IF(Extension is NULL, '', CONCAT(' ', Extension)), ', ' , FirstName, '' , ''), CONCAT(LastName, IF(Extension is NULL, '', CONCAT(' ', Extension)), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Name ";
			query += "FROM section RIGHT JOIN employee ON employee.EmployeeNum = section.EmployeeNum ";
			query += "WHERE section.EmployeeNum IS NULL ";
			query += "GROUP BY employee.EmployeeNum ";
			query += "HAVING " + cat.options[cat.selectedIndex].value + " LIKE '" + searchTeacher.value + "%'"
			crud = "SELECT";
			SimplifiedQuery(crud, query, searchTeacher, PickAdviser);
			console.log(query);
		}
	}
	openModal(header, title);
}

function PickRoom(xhttp){
	// console.log(xhttp.responseText);
	CreateTBody(xhttp, PickRoom);
	var tbody_tr = document.querySelectorAll("#SearchRoomTable tbody tr");
	// var tbody = document.querySelector("#SearchRoomTable tbody");
	for(var i = 0; i < tbody_tr.length; i++){
		tbody_tr[i].addEventListener("click", function(){
			document.getElementById("txt_RoomNum").value = this.childNodes[0].innerHTML;
			// RemoveChildNodes(tbody); //Deletes whole table after click of a row

			searchRoom.value = "";
			closeModal(modal_body);
		});
		tbody_tr[i].addEventListener("mouseover", function(){
			this.style.backgroundColor = "maroon";
			this.style.color = "white";
		});
		tbody_tr[i].addEventListener("mouseout", function(){
			this.style.backgroundColor = "";
			this.style.color = "";
		});	
	}
	txt_search = searchSection;
	columnIDS = GetID(document.querySelectorAll("#SearchSectionTable thead td"), 1);
}

function PickAdviser(xhttp){
	// console.log(xhttp.responseText);
	CreateTBody(xhttp, PickAdviser);
	var tbody_tr = document.querySelectorAll("#SearchTeacherTable tbody tr");
	// var tbody = document.querySelector("#SearchRoomTable tbody");
	for(var i = 0; i < tbody_tr.length; i++){
		tbody_tr[i].addEventListener("click", function(){
			// document.getElementById("txt_TeacherName").value = this.childNodes[1].innerHTML;
			document.querySelectorAll("input")[4].value = this.childNodes[5].innerHTML;
			document.getElementById("txt_EmployeeNum").value = this.childNodes[0].innerHTML;
			// RemoveChildNodes(tbody); //Deletes whole table after click of a row

			searchTeacher.value = "";
			closeModal(modal_body);
		});
		tbody_tr[i].addEventListener("mouseover", function(){
			this.style.backgroundColor = "maroon";
			this.style.color = "white";
		});
		tbody_tr[i].addEventListener("mouseout", function(){
			this.style.backgroundColor = "";
			this.style.color = "";
		});	
	}
	txt_search = searchSection;
	// console.log(columnIDS);
	columnIDS = GetID(document.querySelectorAll("#SearchSectionTable thead td"), 1);
	// console.log(columnIDS);
}

function Edit(whatToEdit){ //whatToEdit is an array 
	//JUST copies the table depending on their order

	console.log(whatToEdit);
	var disabled; 
	var input = document.querySelectorAll("#" + parent_id + " input");
	var btn = document.querySelectorAll("#" + parent_id + " button");

	for(var i = 0; i < input.length; i++){
		if(i == 0){
			disabled = document.createAttribute("disabled");
			input[i].setAttributeNode(disabled); //disabled input
		}
		input[i].value = whatToEdit[i];
	}
	
	var select = document.querySelectorAll("#" + parent_id + " select");
	for(var i = 0; i < select.length; i++){			//Selected option is matched
		for(var j = 0; j < select[i].options.length; j++){
			if(select[i].options[j].text == whatToEdit[i + input.length +1]){
				select[i].selectedIndex = j;
				break;
			}
		}
	}
	//THIS CAN BE CHANGED
	for(i = 0; i < btn.length; i++){
		if(btn[i].innerHTML == "Create"){
			btn[i].innerHTML = "Update";		
			break;
		}
	}
}