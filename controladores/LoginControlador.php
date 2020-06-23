<?php

if ($peticionAjax) {
	require_once '../modelos/loginModelo.php';
}else{
	require_once './modelos/loginModelo.php';
}


class LoginControlador extends LoginModelo
{
	public function iniciar_sesion_controlador(){


		$usu_nombre = mainModel::limpiar_cadena($_POST['inputUserame_log']);		
		$usu_clave = mainModel::limpiar_cadena($_POST['inputPassword_log']);

		$usu_clave = mainModel::encryption($usu_clave);

		$usuDatos = [
				"usuario" => $usu_nombre,				
				"clave" => $usu_clave
			];

		$consulta_usuario = LoginModelo::iniciar_sesion_modelo($usuDatos);	

		if ($consulta_usuario->rowCount() == 1) {

			$row = $consulta_usuario->fetch(); 
			session_start(['name' => 'logueado']);
			$_SESSION['usurio_logeado'] = $row['nombre_usuario'];
			$_SESSION['token'] = md5(uniqid(mt_rand(),true));

			$url = SEVERURL.'?c=inicio';
			return $urlLocation = '<script> window.location ="'.$url.'" </script>';		
			
		}else{

			$alerta = [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'Usurio y ó contraseña incorrectos',
				'Tipo'=>'error'
			];

			return mainModel::sweetalert($alerta);
		}		

	}

	public function forzar_cierre_sesion_controlador(){
		session_destroy();
		return header("Location: ".SEVERURL);
	}
	
}