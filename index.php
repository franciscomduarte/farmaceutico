<?php
	
	ini_set('display_errors', 1);
	ini_set('display_startup_erros', 1);
	error_reporting(E_ALL);

	session_start();
	
	// Faz o carregamento das classes
	function __autoload( $class ) {
		include_once("classes/{$class}.php");
	}
	
	include_once 'config.php';
	include_once 'util/functions.php';
	
	include_once 'head.php';
	include_once 'menu.php';
	include_once "modulos/index.php";
 	include_once 'footer.php';
?>