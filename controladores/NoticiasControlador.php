<?php

if ($peticionAjax) {
	require_once '../modelos/noticiasModelo.php';
}else{
	require_once './modelos/noticiasModelo.php';
}


class NoticiasControlador extends NoticiasModelo
{
	public function inicio(){
		require_once 'vistas/encabezado.php';
		require_once 'vistas/noticias.php';
		require_once 'vistas/pie.php';
	}

	public function crear(){
		require_once 'vistas/encabezado.php';
		require_once 'vistas/crear_noticias.php';
		require_once 'vistas/pie.php';
	}
	//Funcion para agregar las noticias
	public function agregar_noticia_controlador(){

		$not_titulo = mainModel::limpiar_cadena($_POST['noticia_titulo']);
		$not_imagen = mainModel::limpiar_cadena($_FILES['imagen']['name']);
		$not_drescripcion = mainModel::limpiar_cadena($_POST['descripcion']);
		$dir = SEVERURL.'assets/imagenes/';

		if ($_FILES['imagen']['size'] > 2000000) {
			$alerta = [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'Solo se permiten archivos menores a 2 MB',
				'Tipo'=>'error'
			];

			return mainModel::sweetalert($alerta);
		}

		if ($_FILES['imagen']['type'] != 'image/png') {
			$alerta = [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'Solo se permiten archivos de tipo imagen',
				'Tipo'=>'error'
			];

			return mainModel::sweetalert($alerta);
		}

		/*if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $dir.$not_imagen)) {
			$alerta = [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'Error al subir archivo',
				'Tipo'=>'error'
			];

			return mainModel::sweetalert($alerta);
		}*/

		$notDatos = [
			'titulo' => $not_titulo,
			'imagen' => $not_imagen,
			'descripcion' => $not_drescripcion
		];

		$respuesta = NoticiasModelo::agregar_noticia_modelo($notDatos);

		if ($respuesta->rowCount() >= 1) {
			$alerta = [
				'Alerta' => 'limpiar',
				'Titulo'=>'Bien hecho!',
				'Texto'=>'La noticia se registró exitosamente',
				'Tipo'=>'success'
			];
		}else{
			$alerta = [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'No se pudo registrar la noticia',
				'Tipo'=>'error'
			];
		}

		return mainModel::sweetalert($alerta);

	}

	//funcion para paginar noticias
	public function paginador_noticias($pagina, $registros){

		$pagina = mainModel::limpiar_cadena($pagina);
		$registros = mainModel::limpiar_cadena($registros);
		$tabla = "";

		$pagina = (isset($pagina) && $pagina > 0) ? (int)$pagina : 1;
		$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros): 0;

		$conexio = mainModel::conectar();

		$data = $conexio->query("
				SELECT SQL_CALC_FOUND_ROWS * FROM noticias ORDER BY titulo ASC LIMIT $inicio , $registros 
			");

		$data = $data->fetchAll();

		$total = $conexio->query("SELECT FOUND_ROWS()");
		$total = (int) $total->fetchColumn();

		$nPaginas = ceil($total/$registros);

		$tabla .= '<div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th class="hidden-xs">Título</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Editar</em></th>
                        <th>Eliminar</em></th>
                    </tr> 
                  </thead>
                  <tbody>';

        if ($total >= 1 && $pagina <= $nPaginas) {
        	$contador = $inicio+1;
        	foreach ($data as $row) {
        		$tabla .='
					<tr>
	                    <td class="hidden-xs">'.$row['titulo'].'</td>
	                    <td>'.$row['imagen'].'</td>
	                    <td>'.$row['descripcion'].'</td>
	                    <td align="center"> 
	                      <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
	                    </td>
	                    <td align="center">                              
	                      <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
	                    </td>
	                  </tr>
        		';
        	}
        }else{
 			$tabla .= '<tr>
        				<td colspan="5">No hay registros en el sistema</td>        				
        			</tr>';
        }   
         $tabla .= '</tbody></table></div>';

		if ($total >= 1 && $pagina <= $nPaginas) {
         	$tabla .= '<nav class="text-center"><ul class="pagination pagination-sm">';

            if ($pagina == 1) {
            	$tabla .= '<li class="disabled"><a><strong>Anterior</strong></a></li>';
            } else {
            	$tabla .= '<li class="disabled"><a href="'.SEVERURL.'?c=noticias&pagina='.($pagina - 1).'"><strong>Anterior</strong></a></li>';
            }

            for ($i=1; $i <= $nPaginas; $i++) { 
            	if ($pagina == $i) {
            		$tabla .= '<li class="active"><a href="'.SEVERURL.'?c=noticias&pagina='.$i.'"  class="btn btn-info"><strong>'.$i.'</strong></a></li>';
            	} else {
            		$tabla .= '<li><a href="'.SEVERURL.'?c=noticias&pagina='.$i.'" class="btn btn-info"><strong>'.$i.'</strong></a></li>';
            	}
            	
            }

            if ($pagina == $nPaginas) {
            	$tabla .= '<li class="disabled"><a><strong>Siguiente</strong></a></li>';
            } else {
            	$tabla .= '<li class="disabled"><a href="'.SEVERURL.'?c=noticias&pagina='.($pagina + 1).'"><strong>Siguiente</strong></a></li>';
            }
            

            $tabla .= '</ul></nav>';
         }

		return $tabla;
	}
	
		
}
