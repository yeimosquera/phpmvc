<?php

	class InicioControlador
	{		
		public function Login(){
			require_once 'vistas/login.php';
		}

		public function Inicio(){			
			require_once 'vistas/encabezado.php';
			require_once 'vistas/principal.php';
			require_once 'vistas/pie.php';
		}
	}

?>