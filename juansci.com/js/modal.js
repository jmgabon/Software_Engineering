var btn_close = document.querySelector("#modal #close");
var modal_title = document.querySelector("#modal-title");
var modal = document.querySelector("#modal");
var saved_id = null;
var saved_page = null;
// btn_close.addEventListener("click", closeModal);

function closeModal(modalContent){
	// Search();
	modal.style.display = "none";
	parent_id = saved_id;
	saved_id = null;
	RemoveChildNodes(modalContent);
	currentpage = saved_page;

	if(parent_id != undefined && document.querySelector("table").id != ''){
		CreateTBody(null);
	}
	
	// console.log("Parent: " + parent_id);
	// results = [];
	// currentpage = 1;
	// console.log(parent_id);
}

function openModal(header, dbname){
	saved_id = parent_id;
	modal_title.innerHTML = header;
	parent_id = dbname;
	modal.style.display = "block";
	saved_page = currentpage;
	currentpage = 1;
	// console.log(parent_id);
}


