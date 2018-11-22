<?php 
    
	// dados da url
    $params = retornaParametrosUrl($_SERVER['QUERY_STRING']);
	$id = $params[2];

	#dados do formulario
	$usuario = new Usuario();
	$usuario->deletar($id);
	redirecionar("/usuario");
?>