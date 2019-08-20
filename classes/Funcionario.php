<?php

class Funcionario extends Base
{
	
	public $id;
	public $nome;
	public $matricula;
	
	public function __construct() {
	    $this->tabela = "funcionario";
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO funcionario (id, nome, matricula) VALUES (null, '$obj->nome', '$obj->matricula')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE funcionario set nome = '$obj->nome', matricula = '$obj->matricula' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
	    self::listarObjetos();
		
		$funcionarios = [];
		
		foreach ($this->array as $linha) {
		    $funcionario = new Funcionario();
		    $funcionario->id         = $linha['id'];
		    $funcionario->nome  = $linha['nome'];
		    $funcionario->matricula = $linha['matricula'];
		    
		    $funcionarios[] = $funcionario;
		}
		return $funcionarios;
	}
	
	public function listarPorId($id){
		self::listarObjetosPorId($id);
		
		foreach ($this->array as $linha) {
		    $funcionario = new Funcionario();
		    $funcionario->id         = $linha['id'];
		    $funcionario->nome  = $linha['nome'];
		    $funcionario->matricula = $linha['matricula'];
		}
		return $funcionario;
	}
	
}