// function AJAX(data, out, method, url, async, cfunction){

function Create(url, content, callback){
	let data = "";
	let ifblank  = "";

	let input = document.querySelectorAll("form input");
	let form = document.querySelector("form");
	// if(user != null){
	// 	content["User"] = user;
	// }
	for(var i = 0; i < input.length; i++){
		if(!input[i].checkValidity()){
			ifblank++;
			form.reportValidity();
		}
	}

	if(ifblank == 0){
		content = JSON.stringify(content);
		data += "&url=" + url;
		data += "&content=" + content;
		if(callback === null){
			AJAX(data, false, "post", "php/Create.php", true, callback);
		}
		else if(typeof callback == "function"){
			AJAX(data, true, "post", "php/Create.php", true, callback);
		}
		else{
			
		}
	}
}
function Search(url, content, callback){
	data = "";
	// content = JSON.stringify(content);
	data += "&url=" + url;
	data += "&content=" + content;		
	// console.log(data);
	if(callback === null){
		AJAX(data, true, "post", "php/Search.php", true, CreateTBody);
	}
	else if(typeof callback == "function"){
		AJAX(data, true, "post", "php/Search.php", true, callback);
	}
	else{
	}
}

function requestStatus(xhttp){
	let message = xhttp.responseText;
    if(message == "Successful"){
        alert("Request Created!");
        location.reload(true);
    }
    else if (message == "Duplicate Request") {
        alert(message);
    }
    // else if (message.indexOf("null")){
    // 	alert("Please fill up missing fields");
    // }
    else{
        console.log(message);
    }
}