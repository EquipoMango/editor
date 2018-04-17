var valor = "";
$( '.lista li a' ).click(function(){
  	valor = $( this ).html();
  	
  	$('.buscar').val(valor).show().focus();

  	
		/*if ( valor2 != valor ) {
	    	alert( $( valor2 + valor );
	  	}*/
});
  	
var despues = "";
$( '.aceptar' ).click(function() {
	
	despues = $('.buscar').val();
	
	$('.lista li a').each(function(){
        if ( $(this).text() == valor){
        	$( this ).html(despues);
        }
    });
  		
});
$( '.eliminar' ).click(function() {
	
	$('.lista li a').each(function(){
        if ( $(this).text() == valor){
        	$( this ).remove();
        }
    });
  		
});