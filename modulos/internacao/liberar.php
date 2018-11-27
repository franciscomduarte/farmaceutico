<?php 

	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$internacao = new Internacao();
	$internacao->atualizarDataSaida($id);
	redirecionar("/checklist-resposta");
?>