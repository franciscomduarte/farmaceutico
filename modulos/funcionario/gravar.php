<?php 
	#dados do formulario
	$funcionario = new Funcionario();
	$funcionario->id = $_REQUEST['id'];
	$funcionario->nome = $_REQUEST['nome'];
	$funcionario->matricula = $_REQUEST['matricula'];
	
	if($funcionario->id){
	    $funcionario->editar($funcionario);
	} else {
	    $funcionario->inserir($funcionario);
	}
	redirecionar("/funcionario");
?>