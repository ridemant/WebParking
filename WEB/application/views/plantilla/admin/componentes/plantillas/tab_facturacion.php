
<div class="content">
  <div class="bs-example" data-example-id="hoverable-table">
    <ul class="s-tabla">

      <li class="header">
          <div>ID</div>
          <div>DOCUMENTO</div>
          <div>SERIE</div>
          <div>CORRELATIVO</div>
          <div>FECHA</div>
      </li>

      <!--Listado de peliculas -->

      <?php if(isset($datos)){
        if($datos->resultados() != false){
          foreach ($datos->resultados() as $value) {
      ?>
        <li>
          <div><?php echo $value->fac_id; ?></div>
          <div><?php echo $value->fac_documento; ?></div>
          <div><?php echo $value->fac_serie; ?></div>
          <div><?php echo $value->fac_correlativo; ?></div>
          <div><?php echo $value->fac_fecha; ?></div>
        </li>

  <?php }
        }
        
      }
    ?>

    </ul>
  </div>
  <?php
  if(isset($datos)){
        if($datos != false){
          echo $this->Admin_model->crearPagina;
        }
        else{ ?>
        <div class="sin-resultados" style="padding: 10% 0">
          <h3 style="text-align: center;display: block;">Lo sentimos, no se encontro resultados de busqueda.</h3>
          <p style="font-size: 14px; text-align: center;">Por favor, intente nuevamente.</p>
        </div>
        <?php
        }
      }
  ?>




</div>