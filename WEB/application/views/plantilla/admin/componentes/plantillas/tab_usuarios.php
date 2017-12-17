
<nav class="navbar content">
  <div class="navbar-header">
  </div>

  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <a href="<?php echo BASE_URL?>usuarios/panel/usuarios/nuevo" class="btn btn-default">Nuevo</a>
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
          <div>NOMBRES</div>
          <div>APPPATERNO</div>
          <div>CORREO</div>
          <div>SALDO</div>
          <div>TIPO</div>
          <div class="text-right">OPCIONES</div>
      </li>

      <!--Listado de peliculas -->

      <?php if(isset($datos)){

        if(count($datos->ListaUsuarioResult) > 0){
            for ($i=0; $i < count($datos->ListaUsuarioResult->Usuario); $i++) { 
              
      ?>
        <li>
          <div><?php echo $datos->ListaUsuarioResult->Usuario[$i]->id; ?></div>
          <div><?php echo $datos->ListaUsuarioResult->Usuario[$i]->nombres; ?></div>
          <div><?php echo $datos->ListaUsuarioResult->Usuario[$i]->appaterno; ?></div>
          <div><?php echo $datos->ListaUsuarioResult->Usuario[$i]->correo; ?></div>
          <div><?php echo $datos->ListaUsuarioResult->Usuario[$i]->saldo; ?></div>
          <div><?php echo ($datos->ListaUsuarioResult->Usuario[$i]->tipo == "1") ? "Cliente" : "Admin" ; ?></div>
          <div class="text-right">
            <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL?>usuarios/panel/usuarios/editar/<?php echo $datos->ListaUsuarioResult->Usuario[$i]->id;?>">
              <span class="glyphicon glyphicon-edit"></span> 
              Editar
            </a>
              
            <a class="btn btn-danger btn-xs eliminar" href="<?php echo BASE_URL?>usuarios/EliminarUsuario/<?php echo $datos->ListaUsuarioResult->Usuario[$i]->id;?>">
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
        if(count($datos->ListaUsuarioResult) < 0){ ?>
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

      <form class="form-horizontal" method="POST" action="<?php echo BASE_URL; ?>usuarios/<?php if($accion != null){ echo ($accion['accion'] != "nuevo") ? 'ModificarUsuario/'.$accion['id'] : 'panel/usuarios/nuevo' ;} ?>">

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label col-sm-1" for="nombre">Nombres:</label>
            <div class="col-sm-11">
              <input type="text" class="form-control" placeholder="Nombres" name="txt_nombres" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->nombres: '' ?>">
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label col-sm-1" for="url">Ape Paterno:</label>
            <div class="col-sm-11">
              <input type="text" class="form-control" placeholder="Apellido Paterno" name="txt_appaterno" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->appaterno: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label col-sm-1" for="nombre">Ape Materno:</label>
            <div class="col-sm-11">
              <input type="text" class="form-control" placeholder="Apellido Materno" name="txt_apmaterno" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->apmaterno: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Correo:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Correo Electronico" name="txt_correo" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->correo: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Usuario:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Usuario" name="txt_usuario" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->usuario: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Clave:</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" placeholder="Clave" name="txt_clave" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->contrasena: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">DNI:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="Numero de DNI" name="txt_dni" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->dni: '' ?>">

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Tipo:</label>
            <div class="col-sm-10">
              <select class="form-control" id="tipo" name="tipo">
                <option value="1" <?php echo (isset($this->var) && count($this->var) > 0) ? ($this->var->ObtenerUsuarioResult->tipo == "1") ? "selected": "" : ''; ?>>Cliente</option>
                <option value="2" <?php echo (isset($this->var) && count($this->var) > 0) ? ($this->var->ObtenerUsuarioResult->tipo == "2") ? "selected": "" : ''; ?>>Admin</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Saldo:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" placeholder="Numero de DNI" name="txt_saldo" value="<?php echo (isset($this->var) && count($this->var) > 0) ? $this->var->ObtenerUsuarioResult->saldo: '' ?>">

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
