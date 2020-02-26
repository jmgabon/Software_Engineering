var searchEmployee = document.getElementById("SearchEmployee");

var modal_body = document.getElementById("modal-body");
var cat = document.getElementById("Category");
var parent_id = "Employee";
var saved_id;

var Search = function(){
	SearchWithoutQuery(
		parent_id,
		cat.options[cat.selectedIndex].value + "=" + searchEmployee.value, 
		GetID(document.querySelectorAll("#SearchEmployeeTable thead td"), 1),
		null
	);
	// console.log("SEARCHING")
}

Search();
function Edit(whatToEdit){
	console.log(whatToEdit[0]);
	sessionStorage.setItem('EmployeeInfo', JSON.stringify(whatToEdit));
	window.open("employee_reg.php");
}
searchEmployee.addEventListener("change", Search);