
<nav class="navbar content">
  <div class="navbar-header">
  </div>

  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <a href="<?php echo BASE_URL?>estacionamientos/panel/estacionamientos/nuevo" class="btn btn-default">Nuevo</a>
      </ul>
    </div>
  </div>

</nav>


<div class="content">
  <div class="bs-example" data-example-id="hoverable-table">
    <?php if( $accion == null ){ ?>
    <ul class="s-tabla">

      <li class="header">
          <div>ID</div>
          <div>Estacionamiento</div>
          <div>NUMERO</div>
          <div>PISO</div>
          <div>ESTADO</div>
          <div class="text-right">OPCIONES</div>
      </li>

      <!--Listado de peliculas -->

      <?php if(isset($datos)){

        if(count($datos->ListaEstacionamientoResult) > 0){
            for ($i=0; $i < count($datos->ListaEstacionamientoResult->Estacionamiento); $i++) { 
              
      ?>
        <li>

          <div><?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->id; ?></div>
          <div><?php echo $datos_sucursal->obtenerNombreSucursal($datos->ListaEstacionamientoResult->Estacionamiento[$i]->idsucursal )->ObtenerSucursalResult->nombre; ?></div>
          <div><?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->piso; ?></div>
          <div><?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->numero; ?></div>
          <div><?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->estado; ?></div>
          <div class="text-right">
            <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL?>estacionamientos/panel/estacionamientos/editar/<?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->id;?>">
              <span class="glyphicon glyphicon-edit"></span> 
              Editar
            </a>
              
            <a class="btn btn-danger btn-xs eliminar" href="<?php echo BASE_URL?>estacionamientos/EliminarEstacionamiento/<?php echo $datos->ListaEstacionamientoResult->Estacionamiento[$i]->id;?>">
              <span class="glyphicon glyphicon-remove"></span> 
              Borrar
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
        if(count($datos->ListaEstacionamientoResult) < 0){ ?>
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

      <form class="form-horizontal" method="POST" action="<?php echo BASE_URL; ?>estacionamientos/<?php if($accion != null){ echo ($accion['accion'] != "nuevo") ? 'ModificarEstacionamiento/'.$accion['id'] : 'panel/estacionamientos/nuevo' ;} ?>">

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Sucursal:</label>
            <div class="col-sm-10">
              <select class="form-control" id="sucursal" name="sucursal">
                <?php echo (isset($this->var) && count($this->var) > 0) ? $datos_sucursal->listar_sucursales($this->var->ObtenerEstacionamientoResult->idsucursal): $datos_sucursal->listar_sucursales() ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="url">Numero:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="Tarifa de Estacionamiento" name="txt_numero" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerEstacionamientoResult->numero: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Piso:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="Nombre de Estacionamiento" name="txt_piso" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerEstacionamientoResult->piso: '' ?>">

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