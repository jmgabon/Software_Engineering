var columnIDS; //saves the name of table headers
var results = []; //saves content for pagination

var firstResult = null;
var eachpage = 10;
var currentpage = 1;

function CheckIfCreated(xhttp){ //Can be used however Please initialized Search and ResetInput function and var inititalValue
	if(xhttp.responseText != "Successful"){
		var patt = new RegExp("duplicate", "i");
		if(patt.test(xhttp.responseText)){
			alert("ALREADY EXISTED");
		}
		else{
  			console.log(xhttp.responseText); //Other error 
  		}
	} 	
	else{
		alert("CREATED");
		Search();
		ResetInput(initialValue);
	}
}

function CheckIfUpdated(xhttp){ //Can be used however Please initialized Search and ResetInput function and var inititalValue
	if(xhttp.responseText != "Successful"){
  		console.log(xhttp.responseText); //Other error 
	} 	
	else{
		alert("UPDATED");
		Search();
		ResetInput(initialValue);
	}
}

function ResetInput(initialValue, parent_id){//whatToReset - resets the button
	// let parent_id = "Results";
	var disabled;
	var input = document.querySelectorAll("#" + parent_id + " input");
	var select = document.querySelectorAll("#" + parent_id + " select");
	var btn = document.querySelectorAll("#" + parent_id + " button");
	for(var i = 0; i < input.length; i++){
		if(i == 0){
			try{
				disabled = input[i].getAttributeNode("disabled");
				input[i].removeAttributeNode(disabled); //disabled input
			}
			catch(err){
				// console.log(err);
			}
		}
		input[i].value = "";
		input[i].style.backgroundColor = '';
	}
	for(var i = 0; i < select.length; i++){
		select[i].selectedIndex = 0;
	}

	if(initialValue !== null){
		initialValue();
	}

	for(i = 0; i < btn.length; i++){
		if(btn[i].innerHTML == "Update"){
			btn[i].innerHTML = "Create";		
			// if(btn[i].innerHTML == "Create " + parent_id){
			// btn[i].innerHTML = "Update " + parent_id;		
			break;
		}
	}
}

//Function to Create Table 
function CreateTBody(xhttp, cfunction, cfunction2){ //Create Table Body (Imitates result of sql)
	try{
	// var json;
	parent_id = "Results";
	var td;
	var tr;
	var btn_Edit;
	var btn_Delete;
	var class_btn1;
	var class_btn2;

	if(xhttp == null){
		if(firstResult != null){
			results = firstResult;
		}
	}
	else{
		results = JSON.parse(xhttp.responseText);
	}
	if(firstResult == null){
		firstResult = results;
	}
	
	// console.log(firstResult)
	// console.log(results.length);
	console.log(results);

	var thead_td = document.querySelectorAll("#" + parent_id + "Table thead tr td");
	var colNum = document.querySelector("#" + parent_id + "Table thead tr").childElementCount;//childElementCount counts child of parent
	var tbody = document.querySelector("#" + parent_id + "Table tbody");
	// console.log(parent_id);
	var main_body = tbody.parentNode.parentNode;
	// console.log(main_body);
	let limit;
	// console.log(main_body.children.length);
	if(saved_id != null){
		document.querySelector("#modal-footer").removeChild(document.querySelector("#modal-footer").firstChild);
	}
	if(main_body.children.length > 2){
		main_body.removeChild(main_body.children[2]);
	}
	if(eachpage*currentpage < results.length){
		limit = eachpage*currentpage;
	}
	else{
		limit = results.length;
	}
	RemoveChildNodes(tbody);
	// console.log(results.length/eachpage);
	for(var i=eachpage*(currentpage-1); i < limit; i++){//
	// for(var i=0; i < json.length; i++){
		tr = document.createElement('tr');
		for(var j = 0; j < colNum; j++){
			td = document.createElement('td');
			if(j == colNum-1 && thead_td[colNum-1].innerHTML == ""){
				if(typeof cfunction2 === "function"){
					cfunction2(td, i);

				}
				// console.log(cfunction2);
				// cfunction2(td);
				// btn_Block = document.createElement('button');
				// btn_Block.innerHTML = "Block";
				// btn_Block.addEventListener("click", cfunction2.bind(null, results[i]));
				// td.appendChild(btn_Edit);
				// // td.appendChild(btn_Delete);
				// class_btn1 = document.createAttribute("class");
				// class_btn2 = document.createAttribute("class");
				// class_btn1.value = "btn_Table"; //
				// class_btn2.value = "btn_Table";
				// btn_Delete.setAttributeNode(class_btn1);
				// btn_Edit.setAttributeNode(class_btn2); 
			}
			else{
				td.innerHTML = results[i][j];
			}
			if(thead_td[j].style.display == "none"){
				td.style.display = "none";
			}	
			tr.appendChild(td);
		}
 		tbody.appendChild(tr);
	}
	//PAGINATION
	var pagination = document.createElement('ul');
	var btn_Next = document.createElement('button');
	var btn_Previous = document.createElement('button');
	pagination.classList.add("pgn");
	btn_Next.classList.add("pgn-next");
	btn_Previous.classList.add("pgn-prev");

	pagination.appendChild(btn_Previous);
	pagination.appendChild(btn_Next);
	//GROUNDS FOR CHANGING
	if(saved_id != null){
		document.querySelector("#modal-footer").appendChild(pagination);
		console.log("MODAL");
	}
	else{
		main_body.appendChild(pagination);
		console.log("NO MODAL");
	}

	pagination.style.textAlign = "center";
	btn_Previous.innerHTML = "<i class='fas fa-caret-left'></i>";
	btn_Next.innerHTML = "<i class='fas fa-caret-right'></i>";

	btn_Previous.addEventListener("click", function(){
		// main_body.removeChild(pagination);
		console.log("prev");
		console.log(results.length);
		if(currentpage > 1){
			currentpage--;
			// CreateTBody(xhttp);
			if(typeof cfunction === "function"){
				cfunction(xhttp);
			}
			else{
				CreateTBody(xhttp);		
			}
		}
		// console.log(results.length);
//RESULTS.LENGTH problem
	});

	btn_Next.addEventListener("click", function(){
		// main_body.removeChild(pagination);
		console.log("next");
		console.log(results.length);
		if(currentpage < Math.ceil(results.length/eachpage)){
			// console.log("next");
			currentpage++;
			if(typeof cfunction === "function"){
				cfunction(xhttp);
			}
			else{
				CreateTBody(xhttp);		
			}
			// CreateTBody(xhttp);
			// console.log(currentpage);
			// console.log(results.length);
		}
	});
	}
	catch(err){
		alert("CANNOT FIND");
		console.log(xhttp.responseText);
		console.log(err);
	}

	function newFunction() {
		return "dark";
	}
}
//EDIT AND DELETE IS FUNCTION OF BUTTONS INSIDE TBODY ONLY
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
	// console.log(select[0]);
	for(var i = 0; i < select.length; i++){			//Selected option is matched
		for(var j = 0; j < select[i].options.length; j++){
			if(select[i].options[j].text == whatToEdit[i + input.length]){
				select[i].selectedIndex = j;
				break;
			}
		}
	}
	//THIS CAN BE CHANGED
	for(i = 0; i < btn.length; i++){
		if(btn[i].innerHTML == "Create"){
			btn[i].innerHTML = "Update";		
			// if(btn[i].innerHTML == "Create " + parent_id){
			// btn[i].innerHTML = "Update " + parent_id;		
			break;
		}
	}
	// Search(txt_search, columnIDS);	
	// console.log(txt_search);
}

function Delete(whatToDelete){ //DELETES if you have ID
	var r = confirm("Do you want to delete this?"); //confirm alert of js
	var data;
	//DELETE HAS PROBLEM
	data = "whatToDelete=" + parent_id + "&value=" + whatToDelete[0]; 
  	if(r == true){
    	AJAX(data, true, "post", "../php/Delete.php", true, CheckIfDeleted);
  	} 
  	else{
    	txt = "Deletion Cancelled!";
  	}
	// console.log(whatToDelete);
}

function CheckIfDeleted(xhttp){
		// Search(txt_search, columnIDS);
	if(xhttp.responseText == ""){
		Search();
		console.log("Deleted");
		alert("Deleted");
	}
	else{
		console.log(xhttp.responseText);
	}
}