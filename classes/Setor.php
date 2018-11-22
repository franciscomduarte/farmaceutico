<?php

class Setor extends Base
{
	
	protected $id;
	protected $nome;
	
	public function __construct(){
	    $this->tabela = "setor";
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO ".$this->tabela." (id, nome) VALUES (null, '$obj->nome')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE ".$this->tabela." set nome = '$obj->nome' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		self::listarObjetos();
		$setores = [];
		
		foreach ($this->array as $linha) {
		    $setor = new Setor();
		    $setor->id            = $linha['id'];
		    $setor->nome          = $linha['nome'];
		    $setores[] = $setor;
		}
		return $setores;
		
	}
	
	public function listarPorId($id){
		self::listarObjetosPorId($id);
		
		$setor = new Setor();
		
		foreach ($this->array as $linha) {
		    $setor->id    = $linha['id'];
		    $setor->nome  = $linha['nome'];
		}
		return $setor;
		
	}
	
}