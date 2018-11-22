<?php 

	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$paciente = new Paciente();
	$paciente->deletar($id);
	redirecionar("/paciente");
?>