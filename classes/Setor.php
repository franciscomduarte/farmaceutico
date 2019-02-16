<?php

class Setor extends Base
{
	
	public $id;
	public $nome;
	
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
	
	public function listarComChecklist($id_checklist){
	    
	    $sql = "select i.id_setor, concat(s.nome,' (',count(i.id_setor),')') as nome_sigla
                from   resposta_checklist r, internacao i, setor s
                where  i.id = r.id_internacao
                and    i.id_setor = s.id
                and    r.id_checklist = '".$id_checklist."' 
                group by i.id_setor";
	    
	    $this->array = executarSql($sql);
	    
	    $setores = [];
	    
	    foreach ($this->array as $linha) {
	        $setor = new Setor();
	        $setor->id            = $linha['id_setor'];
	        $setor->nome          = $linha['nome_sigla'];
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