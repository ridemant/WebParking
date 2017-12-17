<nav class="navbar content">
  <div class="navbar-header">
  </div>

  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <a href="<?php echo BASE_URL?>sucursales/panel/sucursales/nuevo" class="btn btn-default">Nuevo</a>
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
          <div>SUCURSAL</div>
          <div>TARIFA</div>
          <div class="text-right">OPCIONES</div>
      </li>

      <!--Listado de peliculas -->

      <?php if(isset($datos)){
        if(count($datos->ListaSucursalResult->Sucursal) > 0){
            for ($i=0; $i < count($datos->ListaSucursalResult->Sucursal); $i++) { 
              
      ?>
        <li>
          <div><?php echo $datos->ListaSucursalResult->Sucursal[$i]->id; ?></div>
          <div><?php echo $datos->ListaSucursalResult->Sucursal[$i]->nombre; ?></div>
          <div><?php echo $datos->ListaSucursalResult->Sucursal[$i]->tarifa; ?></div>
          <div class="text-right">
            <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL?>sucursales/panel/sucursales/editar/<?php echo $datos->ListaSucursalResult->Sucursal[$i]->id;?>">
              <span class="glyphicon glyphicon-edit"></span> 
              Editar
            </a>
              
            <a class="btn btn-danger btn-xs eliminar" href="<?php echo BASE_URL?>sucursales/EliminarSucursal/<?php echo $datos->ListaSucursalResult->Sucursal[$i]->id;?>">
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
        if(count($datos->ListaSucursalResult->Sucursal) < 0){ ?>
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

      <form class="form-horizontal" method="POST" action="<?php echo BASE_URL; ?>sucursales/<?php if($accion != null){ echo ($accion['accion'] != "nuevo") ? 'ModificarSucursal/'.$accion['id'] : 'panel/sucursales/nuevo' ;} ?>">

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Nombre:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Nombre de Sucursal" name="txt_sucursal" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerSucursalResult->nombre: '' ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="url">Tarfa:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="Tarifa de Sucursal" name="txt_tarifa" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerSucursalResult->tarifa: '' ?>">

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
