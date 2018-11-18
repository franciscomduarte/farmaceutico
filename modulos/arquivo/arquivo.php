<?php

class Aperfeicoamento
{

	protected $id;
	protected $hash;
	protected $nome;
	protected $id_curriculo;
	
	public function inserir($obj){
		
		$sql = " INSERT INTO arquivo (id, hash, nome, id_curriculo) VALUES
				                       (null, 
				                       '$obj->hash',
				                       '$obj->nome',
										'$obj->id_curriculo')";
		executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM arquivo WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function deletar($id) {
		$sql = " DELETE FROM arquivo WHERE id = " . $id;
		return executarSql($sql);
	}
	
	// Criação dos métodos __Get e __Set
	public function __get($valor){
		return $this->$valor;
	}
	public function __set($propriedade,$valor){
		$this->$propriedade = $valor;
	}
	
	
}