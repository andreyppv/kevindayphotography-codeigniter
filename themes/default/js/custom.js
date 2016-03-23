/*** HOVER MENU ***/
$(document).ready(function(){
	$(".dropdown, .btn-group").hover(function(){
		var dropdownMenu = $(this).children(".dropdown-menu");
		if(dropdownMenu.is(":visible")){
			dropdownMenu.parent().toggleClass("open");
		}
	});
});	

$(window).load(function() {
$('.flexslider').flexslider({
	animation: "slide",
	pauseOnHover: true,
	slideshowSpeed: 7000 
	});
});

     