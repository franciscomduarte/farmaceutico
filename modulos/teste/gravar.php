<?php 

	#dados do formulario
	$teste = new Teste();
	$teste->id = $_REQUEST['id'];
	$teste->descricao = $_REQUEST['descricao'];
	
	if($teste->id){
		$teste->editar($teste);
	} else {
		$teste->inserir($teste);
	}
	redirecionar("/teste");

?>