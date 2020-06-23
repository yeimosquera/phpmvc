
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MovilBox - Yeison Hinestroza</title>

   
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.css">    
    

</head>

<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Bienvenido</h2>
	     <form action="<?php echo SEVERURL ?>ajax/mainAjax.php" method="POST" data-form="" class="FormularioAjax" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1" >Usurio</label>
            <input type="text" class="form-control" placeholder="" name="inputUserame_log" required autocomplete="off">
            
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" >Contraseña</label>
            <input type="password" class="form-control" placeholder="" name="inputPassword_log" required autocomplete="off">
          </div>
          
           <div class="text-center">
           		<button type="submit" class="btn btn-success">Iniciar sesión</button>              
              <a href="?c=Usuario&a=registro" class="btn btn-primary">Registrarse</a>
           </div>
          <div class="RespuestaAjax"></div>
        </form>

		</div>
		<div class="col-md-8 banner-sec">
            
	</div>
</div>
</section>

<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/sweetalert2.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>



