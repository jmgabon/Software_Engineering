var employeeInfo;
console.log(employeeInfo);
employeeInfo = JSON.parse(sessionStorage.getItem('EmployeeInfo'));

var std_picture = document.querySelector("#SecondCol img");
var input_std_picture = document.querySelector("#SecondCol input");
input_std_picture.addEventListener("change", SeePicture);

var imageToUpload = document.getElementById("file"); //input type = "file"
let EmployeeNum;
//INFO
var input = document.querySelectorAll("body input"); //Gets all input tags
var select = document.querySelectorAll("body select");
var output = document.querySelector("output");
var parent_id = "Employee";
if(employeeInfo != null){
	EmployeeNum = employeeInfo[0];
}

function SeePicture(){
	std_picture.src = window.URL.createObjectURL(this.files[0]); //Previews the picture 
}

var submitForm = document.getElementById("submitForm");
// submitForm.addEventListener("click", ValidateForm.bind(null, "StdReg"));
submitForm.addEventListener("click", function(event){
	event.preventDefault();
	ValidateForm();
});
// console.log(select[0].checkValidity());

if(employeeInfo != null){
	console.log(employeeInfo);
	for(var i = 0; i < input.length-1; i++){
		input[i].value = employeeInfo[i+1];
		// console.log(employeeInfo[i + 1]);
	}
	for(var i = 0; i < select.length; i++){			//Selected option is matched
		// console.log(select[i]);
		// console.log(employeeInfo[i + input.length+1]);
		for(var j = 0; j < select[i].options.length; j++){
			if(select[i].options[j].text == employeeInfo[i + input.length+1]){
				select[i].selectedIndex = j;
				break;
			}
		}
	}
	// input_std_picture.files[0]['name'] = "..\\pictures\\student\\" + employeeInfo[input.length-1];
	// console.log(employeeInfo[input.length]);
	// console.log(employeeInfo);
	std_picture.src = "..\\pictures\\employee\\" + employeeInfo[10];
	console.log(std_picture.src);
	disabled = document.createAttribute("disabled");
	input_std_picture.setAttributeNode(disabled);
	submitForm.innerHTML = "UPDATE";
}
sessionStorage.removeItem('EmployeeInfo');
// employeeInfo = null;
for(var i = 0; i < input.length; i++){
	// input[i].autocomplete = "";
	input[i].addEventListener("change", function(){
		if(!this.checkValidity()){
			document.querySelector("form").reportValidity();
		}
	});
	// console.log(input[i]);
}

function ValidateForm(){ //Validate if Form has no Blanks in every required fields
	var ifblank = 0;

	for(var i = 0; i < input.length; i++){
		if(!input[i].checkValidity()){
			ifblank++;
			document.querySelector("form").reportValidity();
		}
	}

	if(ifblank != 0){ //If some fields are still blank
		alert("PLEASE FILL UP");	
	}
	else{
		if(imageToUpload.files[0] == undefined && employeeInfo == null){
			alert("EMPLOYEE'S PICTURE IS NOT UPLOADED");
		}
		else{
			// UploadPhoto(imageToUpload);
			InsertInfo();
		}
	}
}

function InsertInfo(){
	var data = "";
	var content = {};
	if(employeeInfo != null){
		content["EmployeeNum"] = EmployeeNum;
	}
	for(var i = 0; i < input.length; i++){
		if(input[i].type == "file"){
			if(employeeInfo == null){
				content["URL_Picture"] = imageToUpload.files[0]['name'];
			}
			else{
				content["URL_Picture"] = employeeInfo[input.length-1];
			}
		}
		else{
			content[input[i].id] = input[i].value;
		}
	}

	for(var i=0; i < select.length; i++){
		content[select[i].id] = select[i].options[select[i].selectedIndex].text;
	}
	console.log(content);
	if(employeeInfo != null){
		// console.log("aa")
		UpdateWithPreset(
			parent_id, 
			content, 
			0, 
			isUpdated
		);
	}
	else{
		UploadPhoto(imageToUpload);
		CreateWithPreset(
			parent_id, 
			content, 
			0, 
			CheckIfRegistered
		);
	}
	// else{
	// 	alert("PHOTO NOT UPLOADED");
	// }
	// console.log(UploadPhoto(imageToUpload));
}


function CheckIfRegistered(xhttp){
	if(xhttp.responseText != "Successful"){
		var patt = new RegExp("duplicate", "i");
		if(patt.test(xhttp.responseText)){
			alert("ALREADY REGISTERED");
		}
		else{
  			console.log(xhttp.responseText); //Other error 
  		}
	} 	
	else{
		alert("REGISTERED");
		location.reload(false);
		// location.reload(true); 
	}
}

function isUpdated(xhttp){
	if(xhttp.responseText != "Successful"){
		console.log(xhttp.responseText);
	}
	else{
		alert("UPDATED");
		location.reload(false);
		// window.location.href = window.location.href; 

	}
}

// function CheckIfUploaded(xhttp){
// 	var json;
// 	json = JSON.parse(xhttp.responseText);

// 	if(json == 1){
// 		//alert("PHOTO UPLOADED");
// 		boolean = 1;
// 		console.log(boolean);
// 	}
// 	else{	
// 		//alert("PHOTO NOT UPLOADED");
// 		boolean = 0;
// 		console.log(boolean);
// 	}
// 	//console.log(xhttp.responseText);
// }


//IMAGE UPLOADING

function UploadPhoto(file){
	const formData = new FormData();
	//SIZE OF IMAGE IS NOT YET CONSIDERED

	for(const fileToUpload of file.files){
		formData.append("files[]", fileToUpload);
	}
	AJAX_FILES(formData, false, "post", "../php/UploadEmployee.php", true, null);
}

// function RemoveStorage(){
// 	sessionStorage.removeItem('EmployeeInfo');	
// }