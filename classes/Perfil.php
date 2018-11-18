<?php

class Perfil
{
	
	protected $id;
	protected $descricao;
	
	public function inserir($obj){
		$sql = "INSERT INTO perfil (id, descricao) VALUES (null, '$obj->descricao')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE perfil set descricao = '$obj->descricao' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM perfil WHERE 1=1";
		$query = executarSql($sql);
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		$perfis = [];
		
		foreach ($array as $linha) {
		    $perfil = new Perfil();
		    $perfil->id         = $linha['id'];
		    $perfil->descricao  = $linha['descricao'];
		    
		    $perfis[] = $perfil;
		}
		return $perfis;
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM perfil WHERE id = $id ";
		$query = executarSql($sql);
		
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		foreach ($array as $linha) {
		    $perfil = new Perfil();
		    $perfil->id         = $linha['id'];
		    $perfil->descricao  = $linha['descricao'];
		}
		
		return $perfil;
	}
	
	public function deletar($id){
		$sql = "DELETE FROM perfil WHERE id = " . $id;
		return executarSql($sql);
	}
	
	public function retornaIdInserido() {
		return retornaId();
	}
	
	// Criação dos métodos __Get e __Set
	public function __get($valor){
		return $this->$valor;
	}
	public function __set($propriedade,$valor){
		$this->$propriedade = addslashes($valor);
	}
	
	
}