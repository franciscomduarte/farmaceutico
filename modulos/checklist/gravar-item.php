<?php 
    
	#dados do formulario
	$checklist = new Checklist();
	$checklist = $checklist->listarPorId($_REQUEST['id_checklist']);

	$_SESSION['checklist'] = $checklist;
	
	
	
	if ($checklist) {
    	$item  = new Item();
    	
    	$item->id        = $_REQUEST['id_item'];
    	$item->enunciado = $_REQUEST['enunciado'];
    	$item->tipo		 = $_REQUEST['tipo'];
    	$item->checklist = $checklist;

    	if($item->id){
    	    $item->editar($item);
    	} else {
    	    $item->inserir($item);
    	}
    	redirecionar("/checklist/novo/".$checklist->id."?add");
	}
?>