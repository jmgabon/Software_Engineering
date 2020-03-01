let picture = document.querySelector("#FirstCol img");
let input_picture = document.querySelector(".photo-div input");
let imageToUpload = document.getElementById("file");
input_picture.addEventListener("change", SeePicture);
function SeePicture(){
	// console.log(input_std_picture.files[0]);
	picture.src = window.URL.createObjectURL(this.files[0]); //Previews the picture 
}

let input = document.querySelectorAll("body input"); //Gets all input tags
let select = document.querySelectorAll("body select");

let submitForm = document.querySelector("#submitForm");

submitForm.addEventListener("click", function(event){
	event.preventDefault();
	if(Permanent_Address.style.display == "none"){
		window.location.href = "TeacherRegistration.php#Present_Address";
	}
	else{
		let ifblank = 0;
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
			InsertInfo();
		}
	}
});

function InsertInfo(){
	var content = {};
	
	for(var i = 0; i < input.length; i++){
		if(input[i].type == "file"){
			content["URL_Picture"] = input[i].files[0]['name'];
		}
		else if(input[i].type == "checkbox"){
			content[input[i].name] = input[i].checked;
		}
		else{
			content[input[i].id] = input[i].value;
		}
	}
	if(userID !== null){
		content["CreatedBy"] = userID; 
	}
	content["Status"] = "PENDING";
	content["Action"] = "INSERT";

	for(var i=0; i < select.length; i++){
		content[select[i].id] = select[i].options[select[i].selectedIndex].value;
	}
	console.log(content);
	// UploadPhoto(imageToUpload, "../../php/UploadTeacherPhoto.php", null);
	UploadPhoto(imageToUpload, "../../php/UploadTeacherPhoto.php", null);
	Create(window.location.href, content, Registered);
}

function Registered(xhttp){
	if(xhttp.responseText == "Successful"){
		alert("REGISTERED");
		location.reload(false);
	}
}

function Uploaded(xhttp){
	console.log(xhttp.responseText);
}