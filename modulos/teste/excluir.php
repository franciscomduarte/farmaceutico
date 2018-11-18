<?php 

	// dados da url
	$params = retornaParametrosUrl($_GET['r']);
	$id = $params[2];

	#dados do formulario
	$teste = new Teste();
	$teste->deletar($id);
	redirecionar("/teste");
?>