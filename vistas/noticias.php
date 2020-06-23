

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

<?php
  require_once './controladores/NoticiasControlador.php';
  $insNoticias = new NoticiasControlador();
?>

<div class="container">
    <div class="row">
    <h1>Panel de noticias</h1>     
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                   <br>
                   <br>
                  </div>
                  <div class="col col-xs-6 text-right">                    
                    <a href="<?php echo SEVERURL ?>?c=noticias&a=crear" class="btn btn-sm btn-primary btn-create">Nueva Noticia</a>
                  </div>
                </div>
              </div>

              <?php
                $pagina = $_GET['pagina'];                
                echo $insNoticias->paginador_noticias($pagina,5);
              ?>

            </div>

</div></div></div>