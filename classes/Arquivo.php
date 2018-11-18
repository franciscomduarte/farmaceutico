<?php

class Arquivo
{
	
	protected $id;
	protected $nome;
	protected $tipo;
	protected $tamanho;
	protected $url;
	protected $id_curriculo;
	
	public function inserir($obj){
		$sql = "INSERT INTO arquivo (id, nome, tipo, tamanho, url, id_curriculo) VALUES (null, '$obj->nome', '$obj->tipo', '$obj->tamanho', '$obj->url', '$obj->id_curriculo')";
		return executarSql($sql);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM arquivo WHERE id = " . $id;
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