<?php 

	// dados da url
	$params = retornaParametrosUrl($_GET['r']);
	$id = $params[2];

	#dados do formulario
	$internacao = new Internacao();
	$internacao->deletar($id);
	redirecionar("/internacao");
?>