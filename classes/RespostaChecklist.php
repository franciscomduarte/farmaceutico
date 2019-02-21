<?php

class RespostaChecklist extends Base
{	
    public $id;
    public $checklist;
	public $data_resposta;
	public $internacao;
	public $itens = [];
	
	public function __construct(){
	    $this->tabela = "resposta_checklist";
	    $this->checklist = new Checklist();
	    $this->internacao = new Internacao();
	}
	
	public function inserir($obj){
	    $sql = "INSERT INTO ".$this->tabela." (id, id_checklist, id_internacao) 
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
    
    public function verificarPreenchimento($id_internacao, $id_checklist) {
        $obj = new Checklist();
        $checklist = $obj->listarPorId($id_checklist);
        
        if($checklist->tipo == 'UNICO') {
            $sql = "SELECT * FROM `resposta_checklist` 
                    WHERE id_internacao = " . $id_internacao . " and id_checklist = " . $id_checklist ;
        } else {
            $sql = "SELECT * FROM `resposta_checklist`
                    WHERE id_internacao = $id_internacao and id_checklist = $id_checklist and date(data_resposta) = date(now())";
        }
        
        $query = executarSql($sql);
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $resposta_checklist = null;
        foreach ($array as $linha) {
            $resposta_checklist = new RespostaChecklist();
            $checklist = new Checklist();
            $internacao = new Internacao();
            $resposta_checklist->id            = $linha['id'];
            $resposta_checklist->data_resposta = $linha['data_resposta'];
            $resposta_checklist->checklist     = $checklist->listarPorId($linha['id_checklist']);
            $resposta_checklist->internacao    = $internacao->listarPorId($linha['id_internacao']);
        }
        return $resposta_checklist;
        
    }

    public function editar($obj)
    {}

    public function listarPorId($id)
    {}

	
}