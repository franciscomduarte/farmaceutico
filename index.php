<?php
	
	ini_set('display_errors', 1);
	ini_set('display_startup_erros', 1);
	error_reporting(E_ALL & ~E_NOTICE);

	session_start();
	
	// Faz o carregamento das classes
	// Função nova para autoload PHP 7
	spl_autoload_register(function ($class) {
		include 'classes/'.$class .'.php';
	});


	include_once 'config.php';
	include_once 'util/functions.php';
	
	
	
 	if (!isset($_SESSION["usuario"])) {
 	   	redirecionar("/login.php");
 	} else {
 		include_once 'head.php';
 		include_once 'menu.php';
 		include_once "modulos/index.php";
 	}

 	include_once 'footer.php';
?>
