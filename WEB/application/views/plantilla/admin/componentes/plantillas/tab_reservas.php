<script type="text/javascript">
	
$(document).ready(function(){

	var count = 1;
	setInterval(function()
	{ 
		//$(".lista-reservas").siblings(".lista-reservas").remove();
		$.post( '<?php echo BASE_URL; ?>reservas/actualizar/', { 

      }).done(function( datos ) {
        try {
          var obj = $.parseJSON(datos);
		  $(".lista-reservas").siblings(".lista-reservas").remove();
          $(".s-tabla").append(obj.nombre); 
			//console.log("Respuesta  : " + obj.nombre + count );
        } catch (e) {
          console.log('ERROR');
        }

      });

	   console.log("Ana Rivera Muñoz  :  "  + count);
		count++;
	}, 700);//time in milliseconds 

});

</script>

<div class="prueba">
	
</div>


<div class="content">
  <div class="bs-example" data-example-id="hoverable-table">
  <?php if( $accion == null ){ ?>
    <ul class="s-tabla">

      <li class="header">
          <div>ID</div>
          <div>ESTACIONAMIENTO</div>
          <div>FECHA</div>
          <div>ESTADO</div>
          <div class="text-right">OPCIONES</div>
      </li>

      <!--Listado de peliculas -->

      <?php if(isset($datos)){

        if(count($datos->ListaReservaResult) > 0){
            for ($i=0; $i < count($datos->ListaReservaResult->Reserva); $i++) { 
      ?>
        <li class="lista-reservas">
          <div><?php echo $datos->ListaReservaResult->Reserva[$i]->id; ?></div>
          <div><?php echo $datos->ListaReservaResult->Reserva[$i]->estacionamiento_id; ?></div>
          <div><?php echo $datos->ListaReservaResult->Reserva[$i]->fecha; ?></div>
          <div><?php echo $datos_reservas->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado); ?></div>
          <div class="text-right">
            <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL?>reservas/panel/reservas/editar/<?php echo $datos->ListaReservaResult->Reserva[$i]->id;?>">
              <span class="glyphicon glyphicon-edit"></span> 
              Editar
            </a>
          </div>
        </li>

  <?php }
        }
        
      }?>

    </ul>
  </div>
<?php
  if(isset($datos)){
        if(count($datos->ListaReservaResult) < 0){ ?>
        <div class="sin-resultados" style="padding: 10% 0">
          <h3 style="text-align: center;display: block;">Lo sentimos, no se encontro resultados de busqueda.</h3>
          <p style="font-size: 14px; text-align: center;">Por favor, intente nuevamente.</p>
        </div>
        <?php
        }
      }

    }else{ ?>

    <div class="cp">
          <?php 
    if(isset($this->error)){
      if($this->error == "true"){
  ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>¡ Exito !</strong> <?php echo $this->msj; ?>
    </div>
  <?php }
    else{
  ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>¡ Error !</strong> <?php echo $this->msj; ?>
      <!--La pelicula no se guardo exitosamente.-->
    </div>
  <?php }
  } ?>

      <form class="form-horizontal" method="POST" action="<?php echo BASE_URL; ?>reservas/<?php if($accion != null){ echo ($accion['accion'] != "nuevo") ? 'ModificarReserva/'.$accion['id'] : 'panel/reservas/nuevo' ;} ?>">

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-3" for="url">Estacionamiento:</label>
            <div class="col-sm-9">
              <select class="form-control" id="estacionamiento" name="estacionamiento">
                <?php echo (isset($this->var) && count($this->var) > 0) ? $datos_estacionamiento->listar_estacionamiento($this->var->ObtenerReservaResult->estacionamiento_id) : ''; ?>
              </select>

            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="url">Fecha:</label>
            <div class="col-sm-10">
              <input type="datetime-local" class="form-control" placeholder="Fecha" name="txt_fecha" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerReservaResult->fecha: '' ?>">
              <input type="hidden" class="form-control" name="txt_estado" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerReservaResult->estado: '' ?>">
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">        
            <div class="col-sm-offset-1 col-sm-11">
              <button type="submit" class="btn btn-default" name="btn_enviar"><?php if($accion != null){ echo ($accion['accion'] != "nuevo") ? 'Editar' : 'Insertar' ;} ?></button>
            </div>
          </div>
        </div>
  
      </form>

    <div style="clear: both;"></div>
  </div>
<?php } ?>


</div>