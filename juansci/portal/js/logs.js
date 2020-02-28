let cat = document.querySelector("#Category");
let parentNode = document.querySelector(".s-table");
let selected;

function GetFields(){
	let crud = "SELECT";
	selected = cat.options[cat.selectedIndex].value;
	query = "DESCRIBE " + selected;
	SimplifiedQuery(crud, query, null, CheckField);
}
GetFields();
// function SimplifiedQuery(crud,query,searchbox,callback){
// SimplifiedQuery(crud,query,searchbox,callback)
cat.addEventListener("change", GetFields);

function CheckField(xhttp){
	RemoveChildNodes(parentNode);
	let json = JSON.parse(xhttp.responseText);
	let theadID = "";
	// json = json.slice(1, json.length-1);
	// console.log(json);
	// json = json.split(",");
	// console.log(json);
	for(let i = 0; i < json.length; i++){
		console.log(json[i][0]);
		theadID += json[i][0] + "@";
	}
	theadID = theadID.slice(0, theadID.length - 1);
	console.log(theadID);
	// CreateTable(table_name, thead_id, thead_innerHTML, seperator, parentNode, offset, hiddenCol)
	CreateTable(selected, theadID, theadID, "@", parentNode, 0, null);
}