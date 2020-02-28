var hidden = true;
$("#slide").on("click", function () {
	if(!hidden){
        $(function () {
            $("#navbarNav").animate({
                width: '0'
             }, { duration: 300, queue: false });
            $("#navbarNav").hide({
                queue: false });
            
        });
	   hidden=true;
	}
	else{
        $(function () {
            $("#navbarNav").show({
                queue: false });
            $("#navbarNav").animate({
               width: '230px'
            }, { duration: 300, queue: false });
        });
		hidden=false;
	}
});

$('#profileDropdown').on('click', function(){
    $('#divDropdown').toggleClass('d-block');
})
$(window).click(function() {
    $('#divDropdown').removeClass('d-block');
    });
    
