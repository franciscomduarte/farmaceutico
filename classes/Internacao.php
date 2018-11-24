<?php

class Internacao extends Base
{
	
	protected $id;
	protected $numero_internacao;
	protected $data_internacao;
	protected $setor;
	protected $paciente;
	protected $convenio;
	
	public function __construct(){
	    $this->tabela   = "internacao";
	    $this->setor    = new Setor();
	    $this->convenio = new Convenio();
	    $this->paciente = new Paciente();
	    $this->setor = new Setor();
	}
	
	public function inserir($obj){
		echo $sql = "INSERT INTO ".$this->tabela." (id, numero_internacao, data_internacao, id_setor, id_paciente, id_convenio) 
                VALUES (null, '$obj->numero_internacao', '$obj->data_internacao', ".$obj->setor->id.", 
		                ".$obj->paciente->id.", ".$obj->convenio->id.")";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE ".$this->tabela." 
                SET numero_internacao = '$obj->numero_internacao', 
                data_internacao = '$obj->data_internacao',
                id_setor    = ".$obj->setor->id.",
                id_paciente = ".$obj->paciente->id.",
                id_convenio = ".$obj->convenio->id."
                WHERE id = $obj->id ";
		
		return executarSql($sql);
	}
	
	public function listar(){
		self::listarObjetos();
	    $internacoes = [];
	    
	    foreach ($this->array as $linha) {
	        $internacao = new Internacao();
	        $convenio   = new Convenio();
	        $paciente   = new Paciente();
	        $setor   = new Setor();
	        
	        $internacao->id = $linha['id'];
	        $internacao->numero_internacao = $linha['numero_internacao'];
	        $internacao->data_internacao = $linha['data_internacao'];
	        $internacao->paciente = $paciente->listarPorId($linha['id_paciente']);
	        $internacao->convenio = $convenio->listarPorId($linha['id_convenio']);
	        $internacao->setor = $setor->listarPorId($linha['id_setor']);
	        $internacoes[] = $internacao;
	    }
	    return $internacoes;
	}
	
	public function listarInternacaoPorCpf($cpf){
		$sql = "SELECT i.numero_internacao, i.id as id, p.id as id_paciente, p.id_convenio as id_convenio, p.cpf, i.id_setor as id_setor
                FROM internacao i, paciente p 
                WHERE i.id_paciente = p.id 
                AND   p.cpf = '$cpf' 
                ORDER BY i.data_internacao desc limit 1 ";
		$query = executarSql($sql);
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		$internacao = null;
		foreach ($array as $linha) {
		    $internacao = new Internacao();
		    $convenio = new Convenio();
		    $paciente = new Paciente();
		    $setor   = new Setor();
		    
		    $internacao->id = $linha['id'];
		    $internacao->numero_internacao = $linha['numero_internacao'];
		    $internacao->data_internacao = $linha['data_internacao'];
		    $internacao->paciente = $paciente->listarPorId($linha['id_paciente']);
		    $internacao->convenio = $convenio->listarPorId($linha['id_convenio']);
		    $internacao->setor = $setor->listarPorId($linha['id_setor']);
		}
		return $internacao;
	}
	
	public function listarPorId($id){
	    self::listarObjetosPorId($id);
	    
	    $internacao = new Internacao();
	    $convenio   = new Convenio();
	    $paciente   = new Paciente();
	    $setor   = new Setor();
	    
	    foreach ($this->array as $linha) {
	        $internacao->id = $linha['id'];
	        $internacao->numero_internacao = $linha['numero_internacao'];
	        $internacao->data_internacao = $linha['data_internacao'];
	        $internacao->paciente = $paciente->listarPorId($linha['id_paciente']);
	        $internacao->convenio = $convenio->listarPorId($linha['id_convenio']);
	        $internacao->setor = $setor->listarPorId($linha['id_setor']);
	    }
	    return $internacao;
	}
	
}