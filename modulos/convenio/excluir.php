<?php 

	// dados da url
	$params = retornaParametrosUrl($_GET['r']);
	$id = $params[2];

	#dados do formulario
	$convenio = new Convenio();
	$convenio->deletar($id);
	redirecionar("/convenio");
?>