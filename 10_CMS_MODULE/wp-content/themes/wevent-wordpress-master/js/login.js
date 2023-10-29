

$(document).ready(function(){
  
  $("#entrar").click(function(e){
    $("#login").css("visibility","visible");
	$(".pointyarrow").css("visibility","hidden");
	$("#login").css("opacity","1");
	$("#entrar").addClass("greyedOut");
	setTimeout( function() {$( "#e-mail" ).focus()}, 140 );
   e.stopPropagation();
});

$("#login").click(function(e){
   e.stopPropagation();
});

$("body").click(function(e){
    $("#login").css("visibility","hidden");
	$("#login").css("opacity","0");
	$("#entrar").removeClass("greyedOut");
	$(".pointyarrow").css("visibility","visible");
});


  
 });