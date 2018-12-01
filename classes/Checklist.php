<?php

class Checklist extends Base
{	
    protected $id;
	protected $data_cadastro;
	protected $nome;
	protected $usuario;
	protected $ativo;
	protected $meta;
	protected $sigla;
	protected $itens = [];
	
	public function __construct(){
	    $this->tabela = "checklist";
	    $this->usuario = new Usuario();
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO ".$this->tabela." (id,nome,usuario_id,ativo,meta,sigla) 
				               VALUES (null,'$obj->nome','".$_SESSION['usuario']['id']."',$obj->ativo,'$obj->meta','$obj->nome')";
        
        return  executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE ".$this->tabela." 
                SET nome 	= '$obj->nome',
					ativo 	= '$obj->ativo',
                    meta    = '$obj->meta',
                    sigla   = '$obj->sigla'
                WHERE id 	= $obj->id";
		
		return executarSql($sql);
	}
	
	public function desativar($id){
		$sql = "UPDATE ".$this->tabela." set ativo = 0 WHERE id = $id ";
		
		return executarSql($sql);
	}
	
	public function listar(){
		self::listarObjetos();
		$checklists = [];
		
		foreach ($this->array as $linha) {
		    $checklist = new Checklist();
		    $checklist->id            = $linha['id'];
		    $checklist->nome          = $linha['nome'];
		    $checklist->data_cadastro = $linha['data_cadastro'];
		    $checklist->ativo         = $linha['ativo'];
		    $checklist->meta          = $linha['meta'];
		    $checklist->sigla          = $linha['sigla'];
		    $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
		    
		    $checklists[] = $checklist;
		}
		return $checklists;
	}
	
	public function listarAtivos(){
	    self::listarObjetosAtivos();
	    $checklists = [];
	    
	    foreach ($this->array as $linha) {
	        $checklist = new Checklist();
	        $checklist->id            = $linha['id'];
	        $checklist->nome          = $linha['nome'];
	        $checklist->data_cadastro = $linha['data_cadastro'];
	        $checklist->ativo         = $linha['ativo'];
	        $checklist->meta          = $linha['meta'];
	        $checklist->sigla          = $linha['sigla'];
	        $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
	        
	        $checklists[] = $checklist;
	    }
	    return $checklists;
	}
	
	public function listarPendentesPorInternacao($id_paciente){
	    
	    echo $sql = "SELECT * FROM checklist where id NOT IN (SELECT c.id
                FROM checklist c, internacao_checklist ic, internacao i, paciente p
                WHERE 1 = 1
                AND c.id = ic.id_checklist
                AND i.id = ic.id_internacao
                AND i.data_saida is null
                AND i.id_paciente = p.id
                AND c.ativo = 1
                AND p.id = $id_paciente) 
                WHERE ativo = 1 ";

	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    
	    $checklists = array();
	    foreach ($array as $linha) {
	        $checklist = new Checklist();
	        $checklist->id            = $linha['id'];
	        $checklist->nome          = $linha['nome'];
	        $checklist->data_cadastro = $linha['data_cadastro'];
	        $checklist->ativo         = $linha['ativo'];
	        $checklist->meta          = $linha['meta'];
	        $checklist->sigla          = $linha['sigla'];
	        $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
	        
	        $checklists[] = $checklist;
	    }
	    return $checklists;
	}
	
	public function listarAtivasPorInternacao($id_internacao){
	    
	    $sql = "SELECT *
                FROM checklist i, internacao_checklist ic
                WHERE 1 = 1
                AND i.id = ic.id_checklist
                AND i.ativo = 1
                AND ic.id_internacao = $id_internacao
                ORDER BY i.id ";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    
	    $checklists = array();
	    foreach ($array as $linha) {
	        $checklist = new Checklist();
	        $checklist->id            = $linha['id'];
	        $checklist->nome          = $linha['nome'];
	        $checklist->data_cadastro = $linha['data_cadastro'];
	        $checklist->ativo         = $linha['ativo'];
	        $checklist->meta          = $linha['meta'];
	        $checklist->sigla          = $linha['sigla'];
	        $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
	        
	        $checklists[] = $checklist;
	    }
	    return $checklists;
	}
	
	public function listarPorId($id){
		self::listarObjetosPorId($id);
		
		$checklist = new Checklist();
		
		foreach ($this->array as $linha) {
		    $checklist->id            = $linha['id'];
		    $checklist->nome          = $linha['nome'];
		    $checklist->data_cadastro = $linha['data_cadastro'];
		    $checklist->ativo         = $linha['ativo'];
		    $checklist->meta          = $linha['meta'];
		    $checklist->sigla          = $linha['sigla'];
		    $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
		}
		
		return $checklist;
		
	}
	
	public function listarPorNome($nome){
		$sql = "SELECT *
				FROM ".$this->tabela."
				WHERE nome like '%$nome%' order by nome";
		
		$query = executarSql($sql);
		
		return $query->fetch_array(MYSQLI_ASSOC);
	}
		
	public function deletar($id){
		#fazer consulta no checklist_resposta pra verificar se já tem resposta
		#se tiver não pode excluir.
	    self::deletar($id);
	}
	
}