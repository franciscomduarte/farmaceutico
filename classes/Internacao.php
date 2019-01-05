<?php

class Internacao extends Base
{
	
	protected $id;
	protected $numero_internacao;
	protected $data_internacao;
	protected $setor;
	protected $paciente;
	protected $convenio;
	
	protected $checklists = [];
	
	public function __construct(){
	    $this->tabela   = "internacao";
	    $this->tabela_relacionada = "internacao_checklist";
	    $this->setor    = new Setor();
	    $this->convenio = new Convenio();
	    $this->paciente = new Paciente();
	}
	
	public function inserir($obj){
		echo $sql = "INSERT INTO ".$this->tabela." (id, numero_internacao, data_internacao, id_setor, id_paciente, id_convenio) 
                VALUES (null, '$obj->numero_internacao', '$obj->data_internacao', ".$obj->setor->id.", 
		                ".$obj->paciente->id.", ".$obj->convenio->id.")";
	    executarSql($sql);
	    
	    $id_internacao_inserida = self::retornaIdInserido();
	    
	    // insere na tabela internacao_checklist
	    foreach ($obj->checklists as $checklist) {
	        echo $sqlRelacionado = "INSERT INTO ".$this->tabela_relacionada." (id_internacao, id_checklist)
                               VALUES ($id_internacao_inserida, $checklist)";
	        executarSql($sqlRelacionado);
	    }
	}
	
	public function inserirTabelaRelacionada($id_internacao, $id_checklist){
	        $sqlRelacionado = "INSERT INTO ".$this->tabela_relacionada." (id_internacao, id_checklist)
                               VALUES ($id_internacao, $id_checklist)";
	        executarSql($sqlRelacionado);
	}
	
	public function editar($obj){
		$sql = "UPDATE ".$this->tabela." 
                SET numero_internacao = '$obj->numero_internacao', 
                data_internacao = '$obj->data_internacao',
                id_setor    = ".$obj->setor->id.",
                id_paciente = ".$obj->paciente->id.",
                id_convenio = ".$obj->convenio->id."
                WHERE id = $obj->id ";
		
	   executarSql($sql);
	   
	   // insere na tabela internacao_checklist
	   foreach ($obj->checklists as $checklist) {
	       echo $sqlRelacionado = "INSERT INTO ".$this->tabela_relacionada." (id_internacao, id_checklist)
                               VALUES ($obj->id, $checklist)";
	       executarSql($sqlRelacionado);
	   }
	}
	
	public function atualizarDataSaida($id_internacao, $id_checklist){
	    $sql = "UPDATE ".$this->tabela_relacionada."
                SET data_saida = '" . date('Y-m-d H:i') . "'
                WHERE id_internacao = " . $id_internacao . " and id_checklist = " . $id_checklist ;
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
	
	public function listarAtivas($id_checklist){
	    
	    $sql = "SELECT *
                FROM internacao i, internacao_checklist ic
                WHERE 1 = 1
                AND i.id = ic.id_internacao
                AND ic.data_saida is null
                AND ic.id_checklist = $id_checklist
                ORDER BY i.data_internacao ";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    
	    $internacoes = array();
	    foreach ($array as $linha) {
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