
$(function(){
	$( ".datepicker" ).datepicker();
});
function mover(){
	$("#new1").animate({left:'57%'});
}
function mostrar(div){
		$(div).slideToggle("slow");
}