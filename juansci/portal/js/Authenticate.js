let button = document.querySelectorAll('button');
let input = document.querySelectorAll('input');
// let select = document.querySelector('select');
let verify = document.getElementById("verify");
//LOGIN
// console.log(window.location.href.search("/Portal.php") != -1);
// console.log(window.location.href.toString());
button[0].addEventListener("click", function(event){
	event.preventDefault();
	// console.log("HELLO");
	var data = 'username=' + input[0].value;
	data += '&pass=' + input[1].value;
	// data += '&access=' + select.options[select.selectedIndex].value;
	if(this.innerHTML == "Confirm"){
		if(input[1].value == input[2].value){
			data += "&state=changepass";
			AJAX(data, true, "post", "php/Authenticate.php", true, PasswordChanged);
		}
		else{
			alert("PASSWORD NOT MATCH");
		}
	}
	else if(this.innerHTML == "Log In"){
		console.log(data);
		data += "&state=login"; 
		AJAX(data, true, "post", "php/Authenticate.php", true, test);
	}
});

function PasswordChanged(xhttp){
	alert("PASSWORD CHANGED");
	verify.value = "";
	verify.style.display = "none";
	button[0].innerHTML = "Log In";
}

input[1].addEventListener("change", function(){
	if(input[1].value == "1234" || input[1].value == "5678" || input[1].value == "admin"){
		alert("Password not secured");
	}
});

function test(xhttp){
	// console.log("ok");
	if(xhttp.responseText != "failed"){
		if(input[1].value == "1234" || input[1].value == "5678" || input[1].value == "admin"){
			alert("PLEASE CHANGE YOUR PASSWORD IMMEDIATELY");
			input[1].value = "";
			disabled = document.createAttribute("disabled");
			input[0].setAttributeNode(disabled);
			// button[1].setAttributeNode(disabled);
			verify.style.display = "";
			button[0].innerHTML = "Confirm";
		}
		else{
			// console.log(xhttp.responseText);
			window.location.href = xhttp.responseText + "/Dashboard.php";
		}
	}
	else{
		alert("Wrong username or password");
	}
	// console.log("HELLo");
}

//RESET
// button[1].addEventListener("click", function(){
// 	input.forEach((input)=>{
// 		input.value = "";
// 		console.log(this);
// 	});
// 	console.log("RESET");
// });
// [1,2,3].map(AA);

// function AA(){
// 	console.log("HEY")
// }