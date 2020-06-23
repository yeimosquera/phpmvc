<?php

if ($peticionAjax) {
	require_once '../core/mainModel.php';
}else{
	require_once './core/mainModel.php';
}



class LoginModelo extends mainModel
{
	protected function iniciar_sesion_modelo($datos){
		$sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE nombre_usuario = :usuario AND contrasena = :clave");
		$sql->bindParam(":usuario", $datos['usuario']);
		$sql->bindParam(":clave", $datos['clave']);
		$sql->execute();
		return $sql;
	}	
	
}