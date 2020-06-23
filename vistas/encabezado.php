<?php    
    $peticionAjax = false;
     require_once './controladores/LoginControlador.php';
?>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MovilBox - Yeison Hinestroza</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="assets/css/simple-sidebar.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css"> 
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css"> 

</head>

  <div class="d-flex" id="wrapper">

    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">MovilBox</div>
      <div class="list-group list-group-flush">
        <strong><a href="<?php echo SEVERURL ?>?c=inicio" class="list-group-item list-group-item-action bg-light">Inicio</a></strong>
        <strong><a href="<?php echo SEVERURL ?>?c=noticias&pagina=1" class="list-group-item list-group-item-action bg-light">Noticias</a></strong>        
      </div>
    </div>
    
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menú</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">              
              <a href="<?php echo SEVERURL ?>" class="btn btn-outline-danger">Salir</a>
          </ul>
        </div>
      </nav>

      <?php

        session_start(['name' => 'logueado']);

        $lc = new LoginControlador();

        if (!isset($_SESSION['token']) || !isset($_SESSION['usurio_logeado'])) {
            $lc->forzar_cierre_sesion_controlador();
        }

      ?>
     
