<!DOCTYPE html>
<html lang="es-ES">
    <head>

        <title>Panel de Estacionamiento</title>

        <meta charset='UTF-8'>
        <base href="<?php echo BASE_URL;?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_CSS; ?>admin/estilo-panel.css">

        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="<?php echo URL_JSC; ?>jsc.js"></script>

    </head>
    
    <body class="home">
        <div class="container-fluid display-table">
            <div class="row display-table-row">
                <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                    <div class="logo">
                        <a hef="home.html">
                            <img src="<?php echo URL_IMG; ?>logo-panel.png"/>
                        </a>
                    </div>
                    <div class="navi">
                        <ul>
                            <li <?php if($mod == 'home') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>inicio/panel">
                                    <span class="glyphicon glyphicon-home"></span>
                                    <span class="hidden-xs hidden-sm">Home</span>
                                </a>
                            </li>
                            <li <?php if($mod == 'usuarios') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>usuarios/panel/">
                                    <span class="glyphicon glyphicon-user"></span>
                                    <span class="hidden-xs hidden-sm">Usuarios</span>
                                </a>
                            </li>
                            <li <?php if($mod == 'estacionamientos') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>estacionamientos/panel/">
                                    <span class="glyphicon glyphicon-th"></span>
                                    <span class="hidden-xs hidden-sm">Estacionamientos</span>
                                </a>
                            </li>
                            <li <?php if($mod == 'sucursales') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>sucursales/panel/">
                                    <span class="glyphicon glyphicon-th-list"></span>
                                    <span class="hidden-xs hidden-sm">Sucursales</span>
                                </a>
                            </li>
                            <li <?php if($mod == 'reservas') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>reservas/panel/">
                                    <!--<i class="fa fa-calendar" aria-hidden="true"></i>-->
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                    <span class="hidden-xs hidden-sm">Reservas</span>
                                </a>
                            </li>
                            <li <?php if($mod == 'facturas') echo 'class="active"';?>>
                                <a href="<?php echo BASE_URL; ?>facturacion/panel/">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="hidden-xs hidden-sm">Facturacion</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                    <div class="row">
                        <header>
                            <div class="col-md-7">
                                <nav class="navbar-default pull-left">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                </nav>
                                <div class="search hidden-xs hidden-sm">
                                    <!--<input type="text" placeholder="Search" id="search">-->
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="header-rightside">
                                    <ul class="list-inline header-top pull-right">
                                        
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <span class="glyphicon glyphicon-user"></span>
                                                <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <div class="navbar-content">
                                                        <span>JS Krishna</span>
                                                        <p class="text-muted small">
                                                            me@jskrishna.com
                                                        </p>
                                                        <div class="divider">
                                                        </div>
                                                        <a href="<?php echo BASE_URL; ?>admin/salir" class="view btn-sm active">Cerrar Session</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </header>
                    </div>

                    <div class="user-dashboard">
                        <!-- Contenido -->

                        <h1><?php if(isset($titulo)) echo $titulo;?></h1>

                        <div class="col-md-12 col-sm-12 col-xs-12 gutter sales">
                            <?php (isset($vista)) ?  $this->load->view($vista) : ''; ?>
                        </div>
                        <!-- End Contenido -->
                    </div>

                </div>
            </div>

        </div>

    </body>
</html>