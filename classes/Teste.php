<?php

class Teste extends Base
{
	
	public $id;
	public $descricao;
	
	public function inserir($obj){
		$sql = "INSERT INTO teste (id, descricao) VALUES (null, '$obj->descricao')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE teste set descricao = '$obj->descricao' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM teste WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM teste WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM teste WHERE id = " . $id;
		return executarSql($sql);
	}
	
}