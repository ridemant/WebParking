$(document).on("click", ".eliminar", function(e){
    if(confirm('¿Estas seguro de visitar esta url?'))
      return true;
    else
      return false;
  });