<?php
	
	class DataBase {
		
		const servidor = 'localhost';
		const usuario = 'root';
		const clave = 'Asd789';
		const nombrebd = 'prueba_tecnica';

		public static function Conectar(){
			try {

				$conexion = new PDO("mysql::host=".self::servidor.";dbname=".self::nombrebd.";chartset=utf8",self::usuario,self::clave);

				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $conexion;
				
			} catch (PDOException $e) {
				return "Falló ". $e->getMessage();
			}
		}
	}

?>