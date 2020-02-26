var searchStudent = document.getElementById("SearchStudent");

var modal_body = document.getElementById("modal-body");
let cat = document.getElementById("Category");
var parent_id = "Student";
var saved_id;

var Search = function(){
	SearchWithoutQuery(
		parent_id,
		cat.options[cat.selectedIndex].value + "=" + searchStudent.value,
		GetID(document.querySelectorAll("#SearchStudentTable thead td"), 1),
		null
	);
	// console.log("SEARCHING")
}

Search();
function Edit(whatToEdit){
	console.log(whatToEdit[0]);
	sessionStorage.setItem('StudentInfo', JSON.stringify(whatToEdit));
	window.open("student_reg.php");
}
searchStudent.addEventListener("change", Search);