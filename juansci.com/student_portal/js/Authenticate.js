let button = document.querySelectorAll('button');
let input = document.querySelectorAll('input');
let verify = document.getElementById("verify");
button[0].addEventListener("click", function(event){
	event.preventDefault();
	var data = 'username=' + input[0].value;
	data += '&pass=' + input[1].value;
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
	if(xhttp.responseText != "failed"){
		if(xhttp.responseText == "BLOCKED"){
			alert("You have been blocked, contact school administrator");
		}
		else{
			if(input[1].value == "1234" || input[1].value == "5678" || input[1].value == "admin"){
				alert("PLEASE CHANGE YOUR PASSWORD IMMEDIATELY");
				input[1].value = "";
				disabled = document.createAttribute("disabled");
				input[0].setAttributeNode(disabled);
				verify.style.display = "";
				button[0].innerHTML = "Confirm";
			}
			else{
				window.location.href = xhttp.responseText + "student/Dashboard.php";
				console.log(xhttp.responseText);
			}
		}
	}
	else{
		alert("Wrong username or password");
	}
}