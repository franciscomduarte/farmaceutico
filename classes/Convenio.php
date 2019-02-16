<?php

class Convenio extends Base
{
	
	public $id;
	public $nome;
	
	public function __construct(){
	    $this->tabela = "convenio";
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
	    
	    $convenios = [];
	    
	    foreach ($this->array as $linha) {
	        $convenio       = new Convenio();
	        $convenio->id   = $linha['id'];
	        $convenio->nome = $linha['nome'];
	        $convenios[] = $convenio;
	    }
	   
	    
	    return $convenios;
	}
	
	public function listarPorId($id){
	    self::listarObjetosPorId($id);
	    
	    $convenio = new Convenio();

	    foreach ($this->array as $linha) {
	        $convenio->id     = $linha['id'];
	        $convenio->nome   = $linha['nome'];
	    }
	    return $convenio;
	}
	
}