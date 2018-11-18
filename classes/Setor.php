<?php

class Setor
{
	
	protected $id;
	protected $nome;
	
	public function inserir($obj){
		$sql = "INSERT INTO setor (id, nome) VALUES (null, '$obj->nome')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE setor set nome = '$obj->nome' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM setor WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM setor WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM setor WHERE id = " . $id;
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