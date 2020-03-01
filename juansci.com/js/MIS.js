// function AJAX(data, out, method, url, async, cfunction){

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