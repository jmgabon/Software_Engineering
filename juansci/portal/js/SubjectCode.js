var searchSubjectCode = document.getElementById("SearchSubjectCode");
var createSubjectCode = document.getElementById("CreateSubjectCode");
var resetSubjectCode = document.getElementById("ResetSubjectCode");
var cat = document.querySelector("#Category");
// var createSection = document.getElementById("CreateSection");

var parent_id = "SubjectCode";
var Search = function(){
	SearchWithoutQuery(
		parent_id,
		cat.options[cat.selectedIndex].value + "=" + searchSubjectCode.value, 
		GetID(document.querySelectorAll("#SearchSubjectCodeTable thead td"), 1)
	);
}
var initialValue = null;
Search();
searchSubjectCode.addEventListener("change", Search);
createSubjectCode.addEventListener("click", function(){
	Create( 
		createSubjectCode, 
		null, 
		0, //If autoincrement
		null, //FK
		null, //ToUpdate
		CheckIfCreated,
		CheckIfUpdated
	);
});

resetSubjectCode.addEventListener("click", ResetInput.bind(null, initialValue));