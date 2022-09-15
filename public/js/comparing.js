$(document).ready(function() {
          $("img#limpar").click(function(){
                $("input#pesquisar").val("");
    	});
       $('#subir').click(function(){ 
          $('html, body').animate({scrollTop:0}, 'slow');
      return false; 
         });
     });