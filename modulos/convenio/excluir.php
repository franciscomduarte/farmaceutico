<?php 

	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$convenio = new Convenio();
	$convenio->deletar($id);
	redirecionar("/convenio");
?>