<?php

if ($peticionAjax) {
	require_once '../modelos/usuarioModelo.php';
}else{
	require_once './modelos/usuarioModelo.php';
}

class UsuarioControlador extends UsuarioModelo
{

	public function Registro(){

		$db = DataBase::Conectar();
		require_once 'vistas/registra_usurio.php';		
	}

	public function agregar_usuario_controlador(){

		
		$usu_nombre = mainModel::limpiar_cadena($_POST['inputUserame']);
		$usu_correo = mainModel::limpiar_cadena($_POST['inputEmail']);
		$usu_clave = mainModel::limpiar_cadena($_POST['inputPassword']);

		$consulta_usuario = mainModel::ejecutar_consulta_simple("SELECT nombre_usuario FROM usuario WHERE nombre_usuario = '$usu_nombre'");		

		if ($consulta_usuario->rowCount() > 0) {			
			$alerta= [
				'Alerta' => 'simple',
				'Titulo'=>'Ocurrio un error inesperado',
				'Texto'=>'El usurio ingresado ya existe',
				'Tipo'=>'error'
			];
		}else{

			if($usu_correo != ""){	
				$consulta_correo = mainModel::ejecutar_consulta_simple("SELECT correo FROM usuario WHERE correo = '$usu_correo'");

				if ($consulta_correo->rowCount() > 0) {
					$alerta = [
						'Alerta' => 'simple',
						'Titulo'=>'Ocurrio un error inesperado',
						'Texto'=>'El correo ingresado ya existe',
						'Tipo'=>'error'
					];

					return mainModel::sweetalert($alerta);
				}
			}

			$usu_clave = mainModel::encryption($usu_clave);
			$usuDatos = [
				'nombre' => $usu_nombre,
				'correo' => $usu_correo,
				'contrasena' => $usu_clave
			];

			$respuesta = mainModel::agregar_usuario($usuDatos);

			if ($respuesta->rowCount() >= 1) {
				$alerta = [
					'Alerta' => 'limpiar',
					'Titulo'=>'Bien hecho!',
					'Texto'=>'El usurario se registró exitosamente',
					'Tipo'=>'success'
				];
			}else{
				$alerta = [
					'Alerta' => 'simple',
					'Titulo'=>'Ocurrio un error inesperado',
					'Texto'=>'No se pudo registrar el usuario',
					'Tipo'=>'error'
				];
			}
		}		

		return mainModel::sweetalert($alerta);
	}

}	
