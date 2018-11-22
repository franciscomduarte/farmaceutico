<?php 

	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$setor = new Setor();
	$setor->deletar($id);
	redirecionar("/setor");
?>