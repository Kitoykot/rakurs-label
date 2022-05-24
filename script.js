$(function(){

	$('.about_us').click(function(){
		$('#popup_container').show(400);
	});
	
	$('#popup_container').click(function(event){
		if(event.target == this) {
			$(this).hide(200);
		}
	});

	$('#cancel').click(function(){
		$('#popup_container').hide(200);
	});

	$('#hamburger_pic').click(function(){
		var menu = $('#hamburger_line');
		if(menu.is(':visible')){
			menu.slideUp(300);
		}
		else {
			menu.slideDown(300);
		};
	});
	
	$('.mnu_about_us').click(function(){
		$('#popup_container').show(400);
	});
	
	$('#popup_container').click(function(event){
		if(event.target == this) {
			$(this).hide(200);
		}
	});	

	$('#mnu_cancel').click(function(){
		$('#hamburger_line').slideUp(300);
	});
});