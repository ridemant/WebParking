<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="es-ES">
<head>
  <title>Acceso a Estacionamiento</title>

  <meta charset='UTF-8'>
  <base href="<?php echo BASE_URL;?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>admin/estilo.css">
  
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</head>

<body>
   <div class="container">
      <div class="info">
         <h1>Estacionamiento</h1>
      </div>
   </div>
   <div class="form">
      <div class="thumbnail">
        <img src="<?php echo URL_IMG; ?>logo-login.jpg"/>
      </div>

      <form class="login-form" action="" method="POST">
        
         <input type="text" name="usuario" value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : '' ?>" placeholder="Nombre de usuario"/>
         <?php if(isset($this->error['usuario'])){ ?>
            <div class="alert alert-danger">
              <strong>Error: </strong> <?php echo isset($this->msj) ? $this->msj : ''; ?>
            </div>
        <?php } ?>
         
         <input type="password" name="clave" placeholder="Clave"/>
         <?php if(isset($this->error['clave'])){ ?>
            <div class="alert alert-danger">
              <strong>Error: </strong> <?php echo isset($this->msj) ? $this->msj : ''; ?>
            </div>
        <?php } ?>
         <!--<button name="btn_login">login</button>-->
         <input type="submit" class="btn-form" name="btn_login" value="Entrar"/>
      </form>
   </div>

   
</body>
</html>