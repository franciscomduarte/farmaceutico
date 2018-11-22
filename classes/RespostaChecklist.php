<?php

class RespostaChecklist extends Base
{	
    protected $id;
    protected $id_checklist;
	protected $data_resposta;
	protected $id_internacao;
	protected $itens = [];
	
	public function __construct(){
	    $this->tabela = "resposta_cecklist";
	    $this->checklist = new Checklist();
	    $this->internacao = new Internacao();
	}
	
	public function inserir($obj){
	    echo $sql = "INSERT INTO ".$this->tabela." (id, id_checklist, id_internacao) 
				               VALUES (null,$obj->id_checklist, $obj->id_internacao)";
        
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