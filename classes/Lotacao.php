<?php

class Lotacao
{

	protected $id;
	protected $nome;
	protected $sigla;
	protected $id_suap;
	
	public function inserir($obj){
		
		$sql = " INSERT INTO lotacao (id, nome, sigla, id_suap) VALUES
				                       (null, 
										'$obj->nome',
										'$obj->sigla',
										'$obj->id_suap')";
		executarSql($sql);
	}
	
	public function listar(){
		$sql = " SELECT * FROM lotacao WHERE 1=1 ";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = " SELECT * FROM lotacao WHERE 1=1 and id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
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