<?php

class Convenio extends Base
{
	
	protected $id;
	protected $nome;
	
	public function inserir($obj){
		$sql = "INSERT INTO convenio (id, nome) VALUES (null, '$obj->nome')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE convenio set nome = '$obj->nome' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM convenio WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
	    $sql = "SELECT * FROM convenio WHERE 1=1 AND id = $id ";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    $convenio = new Convenio();

	    foreach ($array as $linha) {
	        $convenio->id            = $linha['id'];
	        $convenio->nome          = $linha['nome'];
	    }
	    return $convenio;
	}
	
	public function deletar($id){
		$sql = "DELETE FROM convenio WHERE id = " . $id;
		return executarSql($sql);
	}
	
}