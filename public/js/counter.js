  $(document).ready(function(){
		
			  var contagem = $('td#linha', $('table')).length;
		      $('h3.contagem').text('Esta pagina contém ' + contagem + ' registros.');    

		         $('select#selectbasic').change(function () {
		          var contagem = $('td#linha', $('table')).length;
		          $('h3.contagem').text('Foram encontrados ' + contagem + ' registros na pagina');   
		          });

		          $('img.next, img.prev, img.first, img.last').click(function () {
		            var contagem = $('td#linha', $('table')).length;
		            $('h3.contagem').text('Foram encontrados ' + contagem + ' registros na pagina');   
		            });


		            
		          $( "input#pesquisar" ).keydown(function() {
		        	  $("h3.contagem").hide();
		            });
		          $( "input#pesquisar" ).keyup(function() {
		        	  if($(this).val() == "") {
		        		  $("h3.contagem").show()
		        		 }
		        	 ;
		            });

		      });