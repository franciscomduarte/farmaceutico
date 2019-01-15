<?php 

    
    $id_checklist = $_REQUEST['id_checklist'];
    $resposta_checklist = new RespostaChecklist();
    $resposta_checklist->checklist->id = $id_checklist;
    $resposta_checklist->internacao->id = $_REQUEST['id_internacao'];
    // a data de resposta é preenchida pelo banco de dados;
    
    $resposta_checklist->inserir($resposta_checklist);
    $id_resposta_checklist = $resposta_checklist->retornaIdInserido();
    
    $alternativa = new Alternativa();
    $alternativas = $alternativa->listarPorIdCkelist($id_checklist);
    
    // Lógica para salvar as alternativas ME
    foreach ($alternativas as $a) { 
        if(isset($_REQUEST[$a->id])) {
            $resposta_checklist_item = new RespostaChecklistItem();
            $resposta_checklist_item->id_resposta_checklist = $id_resposta_checklist;
            $resposta_checklist_item->id_item = $a->item->id; 
            $resposta_checklist_item->id_resposta_alternativa = $a->id;
            $resposta_checklist_item->inserir($resposta_checklist_item);
        }
    }
    
    // Lógica para salvar as alternativas TX
    if(isset($_REQUEST['tx'])){
        
    }
    
    // Lógica para salvar as alternativas VF
    $item = new Item();
    $itens = $item->listarPorIdChecklist($id_checklist);
    foreach ($itens as $i) { 
        if(isset($_REQUEST['vf-'.$i->id])){
            
            $id_item = $i->id;
            $id_alternativa = $_REQUEST['vf-'.$i->id];
            
            $resposta_checklist_item = new RespostaChecklistItem();
            $resposta_checklist_item->id_resposta_checklist = $id_resposta_checklist;
            $resposta_checklist_item->id_item = $id_item; 
            $resposta_checklist_item->id_resposta_alternativa = $id_alternativa;
            $resposta_checklist_item->inserir($resposta_checklist_item);
        }
    }
    
    redirecionar("/checklist-resposta/" . $id_checklist);

?>