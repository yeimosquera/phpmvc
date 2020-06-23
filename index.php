<?php

	require_once 'modelos/database.php';
	require_once 'core/configGeneral.php';

	if (!isset($_GET['c'])) {
		require_once('controladores/InicioControlador.php');
		$controlador = new InicioControlador();
		call_user_func(array($controlador, 'Login'));
	}else {
		$controlador = ucwords($_GET['c']);
		require_once('controladores/'.$controlador.'Controlador.php');
		$controlador = $controlador.'Controlador';
		$controlador = new $controlador;
		$accion = isset($_GET['a']) ? $_GET['a'] : "Inicio";
		call_user_func(array($controlador, $accion));
		session_start();
	}

?>