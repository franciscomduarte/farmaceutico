<?php 
    
	#dados do formulario
	$checklist = unserialize($_SESSION['checklist']);
	
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
    	    $_SESSION['item'] = serialize($item);
    	}
    	redirecionar("/checklist/add-item/".$checklist->id."?add");
	}
	
?>