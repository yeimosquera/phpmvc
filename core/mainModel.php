<?php

if ($peticionAjax) {
	require_once '../core/configAPP.php';
	require_once '../core/configGeneral.php';
}else{
	require_once './core/configAPP.php';
	require_once './core/configGeneral.php';
}

class mainModel {

	protected function conectar(){

		try {
	   		 $enlace = new PDO(SGBD, usuario, clave);
	   		 return $enlace;

		} catch (PDOException $e) {
		   return 'Falló la conexión: '.$e->getMessage();
		}
	}

	protected function ejecutar_consulta_simple($consulta){
		$respuesta = self::conectar()->prepare($consulta);
		$respuesta->execute();
		return $respuesta;
	}

	public static function encryption($string){
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
		return $output;
	}

	public static function decryption($string){
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
		return $output;
	}

	protected function limpiar_cadena($cadena){
		$cadena = trim($cadena);
		$cadena = stripcslashes($cadena);
		$cadena = str_ireplace("<script>", "", $cadena);
		$cadena = str_ireplace("<\script>", "", $cadena);
		$cadena = str_ireplace("<script src>", "", $cadena);
		$cadena = str_ireplace("<script type=>", "", $cadena);
		$cadena = str_ireplace("SELECT * FROM", "", $cadena);
		$cadena = str_ireplace("DELETE FROM", "", $cadena);
		$cadena = str_ireplace("INSERT INTO", "", $cadena);
		$cadena = str_ireplace("--", "", $cadena);
		$cadena = str_ireplace("{", "", $cadena);
		$cadena = str_ireplace("}", "", $cadena);
		$cadena = str_ireplace("[", "", $cadena);
		$cadena = str_ireplace("]", "", $cadena);
		$cadena = str_ireplace("==", "", $cadena);
		return $cadena;
	}

	protected function sweetalert ($datos){
		if ($datos['Alerta'] == 'simple') {
			$alerta = "
			<script>
			swal(
			  '".$datos['Titulo']. "',
			  '".$datos['Texto']."',
			  '".$datos['Tipo']."'
			)

			</script>
			";
		}elseif ($datos['Alerta'] == 'recargar') {
			$alerta = "
			<script>
			swal({
			  title: '".$datos['Titulo']."',
			  text: '".$datos['Texto']."',
			  type: '".$datos['Tipo']."',
			  confirmButtonText: 'Aceptar'
			}).then(function() { 
				location.reload();
			});
			</script>
			";			
		}elseif ($datos['Alerta'] == 'limpiar') {
			$alerta = "
			<script>
			swal({
			  title: '".$datos['Titulo']."',
			  text: '".$datos['Texto']."',
			  type: '".$datos['Tipo']."',
			  confirmButtonText: 'Aceptar'
			}).then(function() { 
				$('.FormularioAjax')[0].reset();
			});
			</script>
			";
		}

		return $alerta;
	}

	protected function agregar_usuario($datos){
		
		$sql = self::conectar()->prepare("INSERT INTO usuario (nombre_usuario,correo,contrasena) 
											VALUES (:nombre,:correo,:contrasena)");

		$sql->bindParam(":nombre",$datos['nombre']);
		$sql->bindParam(":correo",$datos['correo']);
		$sql->bindParam(":contrasena",$datos['contrasena']);
		$sql->execute();
		return $sql;

	}

}