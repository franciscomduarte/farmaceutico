<?php 

	#dados do formulario
    $setor = new Setor();
    $setor->id = $_REQUEST['id'];
    $setor->nome = $_REQUEST['nome'];
	
    if($setor->id){
        $setor->editar($setor);
	} else {
	    $setor->inserir($setor);
	}
	redirecionar("/setor");

?>