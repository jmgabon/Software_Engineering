// function AJAX(data, out, method, url, async, cfunction){
// alert("GAGO");
function Create(url, content, callback){
	let data = "";
	// if(user != null){
	// 	content["User"] = user;
	// }
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
function Search(url, content, content2, callback){
	data = "";
	// content = JSON.stringify(content);
	data += "&url=" + url;
	data += "&content=" + content;		
	data += "&content2=" + content2;
	// console.log(content2);
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
    else{
        console.log(message);
    }
}