<?php

$peticionAjax = true;

if (isset($_POST['inputUserame_log']) && isset($_POST['inputPassword_log'])) {
    require_once '../controladores/LoginControlador.php';
    $login = new LoginControlador();
    echo $login->iniciar_sesion_controlador();

 }elseif(isset($_POST['inputUserame'])) {
	require_once '../controladores/UsuarioControlador.php';
	$isnUsuario = new UsuarioControlador();

	echo $isnUsuario->agregar_usuario_controlador();

}elseif (isset($_POST['noticia_titulo'])) {
	require_once '../controladores/NoticiasControlador.php';
	$isnNoticias = new NoticiasControlador();
	
	echo $isnNoticias->agregar_noticia_controlador();
	
} else {
	session_start();
	session_destroy();
	
}
