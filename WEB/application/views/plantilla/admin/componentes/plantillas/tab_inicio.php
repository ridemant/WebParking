<script type="text/javascript">
  
$(document).ready(function(){

  var count = 1;
  setInterval(function()
  { 
    
    $.post( '<?php echo BASE_URL; ?>inicio/actualizar/', { 

      }).done(function( datos ) {
        try {
          var obj = $.parseJSON(datos);
          $(".ul-estados").siblings("li").remove();
          $(".ul-estados").html(obj.estado); 
      		console.log("Respuesta  : " + obj.estado + count );
        } catch (e) {
          console.log('ERROR');
        }

      });

    count++;
  }, 700);//time in milliseconds 

});

</script>


<ul class="ul-estados">

      <?php if(isset($datos)){

        if(count($datos->ListaReservaResult) > 0){
            for ($i=0; $i < count($datos->ListaReservaResult->Reserva); $i++) { 
      ?>
        <li>
          <a class="<?php echo $datos_inicio->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado); ?>">
            <div><?php echo $datos_inicio->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado); ?></div>
            <div><?php echo $datos->ListaReservaResult->Reserva[$i]->id; ?></div> 
          </a>
        </li>

  <?php }
        }
        
      }?>

    </ul>