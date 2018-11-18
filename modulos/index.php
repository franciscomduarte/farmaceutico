<?php
    
	include 'mensagens.php';
	
	$roteador = new Roteador();
	$controlador = $roteador->controlador();
	$acao = $roteador->acao();
	
	$modulo = (	is_dir ( 	'modulos' . DIRECTORY_SEPARATOR . $controlador )) ?
							'modulos' . DIRECTORY_SEPARATOR . $controlador :
							'modulos' . DIRECTORY_SEPARATOR . 'index';
	
	$pagina = ( is_file ( 	$modulo . DIRECTORY_SEPARATOR . $acao . '.php' )) ?
							$acao . '.php' : 'index.php';

	if ($controlador == 'index' && $acao == 'index') {
	    require_once 'dashboard.php';
	} else if ($controlador == 'index') {
		require_once ($modulo . '.php');
	} else if ( is_file ( $modulo . DIRECTORY_SEPARATOR . $pagina )) {
		require_once $modulo . DIRECTORY_SEPARATOR . $pagina;
	} else {
		require_once'404.php';
	}
	
	
?>