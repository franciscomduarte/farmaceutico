<?php 

	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$funcionario = new Funcionario();
	$funcionario->deletar($id);
	redirecionar("/funcionario");
?>