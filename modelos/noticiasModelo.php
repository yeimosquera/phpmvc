<?php

if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}


class NoticiasModelo extends mainModel
{	
	protected function agregar_noticia_modelo($datos){

		$sql = mainModel::conectar()->prepare("INSERT INTO noticias(titulo,imagen,descripcion) 
											VALUES (:titulo,:imagen,:descripcion)");

		$sql->bindParam(":titulo",$datos['titulo']);
		$sql->bindParam(":imagen",$datos['imagen']);
		$sql->bindParam(":descripcion",$datos['descripcion']);
		$sql->execute();
		return $sql;
	}
	
}