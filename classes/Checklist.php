<?php

class Checklist extends Base
{	
    protected $id;
	protected $data_cadastro;
	protected $nome;
	protected $usuario;
	protected $ativo;
	protected $itens = [];
	
	public function __construct(){
	    $this->usuario = new Usuario();
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO checklist (id,nome,usuario_id,ativo) 
				               VALUES (null,'$obj->nome','".$_SESSION['usuario']['id']."',$obj->ativo)";
        
        return  executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE checklist 
                SET nome 	= '$obj->nome',
					ativo 	= '$obj->ativo' 
                WHERE id 	= $obj->id";
		
		return executarSql($sql);
	}
	
	public function desativar($id){
		$sql = "UPDATE checklist set ativo = 0 WHERE id = $id ";
		
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM checklist WHERE 1=1 order by nome";
		$query = executarSql($sql);
		
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		$checklists = [];
		
		foreach ($array as $linha) {
		    $checklist = new Checklist();
		    $checklist->id            = $linha['id'];
		    $checklist->nome          = $linha['nome'];
		    $checklist->data_cadastro = $linha['data_cadastro'];
		    $checklist->ativo         = $linha['ativo'];
		   
		    $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
		    
		    $checklists[] = $checklist;
		}
		
		return $checklists;
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM checklist WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		$checklist = new Checklist();
		
		foreach ($array as $linha) {
		    $checklist->id            = $linha['id'];
		    $checklist->nome          = $linha['nome'];
		    $checklist->data_cadastro = $linha['data_cadastro'];
		    $checklist->ativo         = $linha['ativo'];
		    
		    $checklist->usuario       = $checklist->usuario->listarPorId($linha['usuario_id']);
		}
		
		return $checklist;
		
	}
	
	public function listarPorNome($nome){
		$sql = "SELECT *
				FROM checklist
				WHERE nome like '%$nome%' order by nome";
		
		$query = executarSql($sql);
		
		return $query->fetch_array(MYSQLI_ASSOC);
	}
		
	public function deletar($id){
		#fazer consulta no checklist_resposta pra verificar se já tem resposta
		#se tiver não pode excluir.
	    $sql = "DELETE FROM checklist WHERE id = " . $id;
		return executarSql($sql);
	}
	
}