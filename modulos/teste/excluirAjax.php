<?php 

	include_once '../../classes/Teste.php';
	include_once '../../config.php';
	include_once '../../util/functions.php';

	// dados da url
	$id = $_REQUEST['id'];
	
	#dados do formulario
	$teste = new Teste();
	$teste->deletar($id);
	
	echo $id;
?>