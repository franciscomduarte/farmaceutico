<?php

class RespostaChecklistItem extends Base
{	
    protected $id_resposta_checklist;
    protected $id_item;
	protected $id_resposta_alternativa;
	
	public function __construct(){
	    $this->tabela = "resposta_checklist_item";
	}
	
	public function inserir($obj){
		echo $sql = "INSERT INTO ".$this->tabela." (id_resposta_checklist, id_item, id_resposta_alternativa) 
				               VALUES ($obj->id_resposta_checklist, $obj->id_item, $obj->id_resposta_alternativa)";
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