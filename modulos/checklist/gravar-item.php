<?php 
    
	#dados do formulario
	$checklist = new Checklist();
	$checklist = $checklist->listarPorId($_REQUEST['id_checklist']);
	if ($checklist) {
    	$item  = new Item();
    	
    	$item->id        = $_REQUEST['id'];
    	$item->enunciado = $_REQUEST['nome'];
    	$item->tipo		 = $_REQUEST['tipo'];
    		
    	if($item->id){
    	    $item->editar($item);
    	} else {
    	    $item->inserir($item);
    	}
    	redirecionar("/checklist/".$checklist->id."?add");
	}
?>