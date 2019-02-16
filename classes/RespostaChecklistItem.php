<?php

class RespostaChecklistItem extends Base
{	
    public $id_resposta_checklist;
    public $id_item;
	public $id_resposta_alternativa;
	public $resposta_texto;
	
	public function __construct(){
	    $this->tabela = "resposta_checklist_item";
	}
	
	public function inserir($obj){
	    if($obj->resposta_texto == null) {
	        $sql = "INSERT INTO ".$this->tabela." (id_resposta_checklist, id_item, id_resposta_alternativa)
				               VALUES ($obj->id_resposta_checklist, $obj->id_item, $obj->id_resposta_alternativa)";
	    } else if ($obj->id_resposta_alternativa == null){
	        $sql = "INSERT INTO ".$this->tabela." (id_resposta_checklist, id_item, resposta_texto)
				               VALUES ($obj->id_resposta_checklist, $obj->id_item, '$obj->resposta_texto')";
	    } else {
	        $sql = "INSERT INTO ".$this->tabela." (id_resposta_checklist, id_item, id_resposta_alternativa, resposta_texto)
				               VALUES ($obj->id_resposta_checklist, $obj->id_item, $obj->id_resposta_alternativa, '$obj->resposta_texto')";
	    }
        return  executarSql($sql);
	}
    public function deletar($id)
    {}

    public function listar()
    {}

    public function editar($obj)
    {}

    public function listarPorId($id)
    {}

	
	
}