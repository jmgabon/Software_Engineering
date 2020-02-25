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
	if(currentpage > 1){
		currentpage--;
		
		if(typeof cfunction === "function"){
			// cfunction(xhttp);
		}
		else{
			// CreateTBody(xhttp);		
		}
	}
});

btn_Next.addEventListener("click", function(){
	// main_body.removeChild(pagination);
	console.log("next");
	if(currentpage < Math.ceil(results.length/eachpage)){
		currentpage++;
		if(typeof cfunction === "function"){
			// cfunction(xhttp);
		}
		else{
			// CreateTBody(xhttp);		
		}
	}

});
console.log(currentpage);