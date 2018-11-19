<?php 
    
	#dados do formulario
	$checklist               = new Checklist();
	
	$checklist->id 			 = $_REQUEST['id'];
	$checklist->nome 		 = $_REQUEST['nome'];
	$checklist->ativo 		 = $_REQUEST['ativo'];
		
	if($checklist->id){
		$checklist->editar($checklist);
	} else {
		$checklist->inserir($checklist);
	}
	redirecionar("/checklist");

?>