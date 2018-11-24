<?php

class RespostaChecklist extends Base
{	
    protected $id;
    protected $checklist;
	protected $data_resposta;
	protected $internacao;
	protected $itens = [];
	
	public function __construct(){
	    $this->tabela = "resposta_checklist";
	    $this->checklist = new Checklist();
	    $this->internacao = new Internacao();
	}
	
	public function inserir($obj){
	    echo $sql = "INSERT INTO ".$this->tabela." (id, id_checklist, id_internacao) 
				               VALUES (null,".$obj->checklist->id.",".$obj->internacao->id.")";
        return  executarSql($sql);
	}
    public function deletar($id)
    {}

    public function listar(){
        self::listarObjetos();
        $respostas_checklist = [];
        $checklist = new Checklist();
        $internacao = new Internacao();
        foreach ($this->array as $linha) {
            $resposta_checklist = new RespostaChecklist();
            $resposta_checklist->id            = $linha['id'];
            $resposta_checklist->data_resposta = $linha['data_resposta'];
            $resposta_checklist->checklist     = $checklist->listarPorId($linha['id_checklist']);
            $resposta_checklist->internacao    = $internacao->listarPorId($linha['id_internacao']);
            
            $respostas_checklist[] = $resposta_checklist;
        }
        return $respostas_checklist;
    }

    public function editar($obj)
    {}

    public function listarPorId($id)
    {}

	
}