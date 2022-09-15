$(document).ready(function(){
	$("#elemento1").mouseenter(function(e){
		$("#tip1").css("left", e.pageX + 5);
		$("#tip1").css("top", e.pageY + 5);
		$("#tip1").css("color", "white");
		$("#tip1").css("display", "block");
	});
	$("#elemento1").mouseleave(function(e){
		$("#tip1").css("display", "none");
	});
	
	
})