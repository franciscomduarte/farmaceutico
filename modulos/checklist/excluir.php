<?php 
    
	// dados da url
	$params = retornaParametrosUrl($_GET['r']);
	$id = $params[2];

	#dados do formulario
	$checklist = new Checklist();
	$checklist->desativar($id);
	redirecionar("/checklist");
?>