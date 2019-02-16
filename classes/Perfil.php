<?php

class Perfil extends Base
{
	
	public $id;
	public $descricao;
	
	public function __construct() {
	    $this->tabela = "perfil";
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO perfil (id, descricao) VALUES (null, '$obj->descricao')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE perfil set descricao = '$obj->descricao' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
	    self::listarObjetos();
		
		$perfis = [];
		
		foreach ($this->array as $linha) {
		    $perfil = new Perfil();
		    $perfil->id         = $linha['id'];
		    $perfil->descricao  = $linha['descricao'];
		    
		    $perfis[] = $perfil;
		}
		return $perfis;
	}
	
	public function listarPorId($id){
		self::listarObjetosPorId($id);
		
		foreach ($this->array as $linha) {
		    $perfil = new Perfil();
		    $perfil->id         = $linha['id'];
		    $perfil->descricao  = $linha['descricao'];
		}
		
		return $perfil;
	}
	
}