<?php 
    
	#dados do formulario
	$checklist         = new Checklist();
	
	$checklist->id 	   = $_REQUEST['id'];
	$checklist->nome   = strtoupper($_REQUEST['nome']);
	$checklist->ativo  = $_REQUEST['ativo'];
	$checklist->meta   = $_REQUEST['meta'];
	$checklist->cor   = $_REQUEST['cor'];
	$checklist->sigla   = $_REQUEST['sigla'];
		
	if($checklist->id){
		$checklist->editar($checklist);
	} else {
		$checklist->inserir($checklist);
	}
	redirecionar("/checklist");

?>