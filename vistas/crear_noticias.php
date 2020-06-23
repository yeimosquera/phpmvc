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
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center text-uppercase" >Registrar Noticia</h5>
            <form action="<?php echo SEVERURL ?>ajax/mainAjax.php" method="POST" data-form="save" class="FormularioAjax" enctype="multipart/form-data">
              <div class="form-label-group">
                <input type="text" id="noticia_titulo"  name="noticia_titulo" class="form-control"  required autofocus>
                <label for="noticia_titulo">Título</label>
              </div>

              <div class="form-group">
                <label for="imagen"></label>
                <input type="file" id="imagen" name="imagen">
              </div>
                        
              <br><br>
              <div class="form-label-group">
                <textarea name="descripcion" rows="6" cols="105" placeholder="Descripción"></textarea>
              </div>             
              <br>

              <button class="btn btn-lg btn-primary btn-block" type="submit">Guardar</button>
                           
              <div class="RespuestaAjax"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

 <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
 <script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
 <script src="assets/js/sweetalert2.min.js" type="text/javascript"></script>
 <script src="assets/js/main.js" type="text/javascript"></script>