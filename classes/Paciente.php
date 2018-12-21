<?php

class Paciente extends Base
{
	
	protected $id;
	protected $nome;
	protected $cpf;
	protected $nascimento;
	protected $genero;
	protected $registro;
	
	protected $convenio;
	
	public function __construct(){
	    $this->convenio = new Convenio();
	}
	
	public function inserir($obj) {
		echo $sql = "INSERT INTO paciente (id, nome, cpf, nascimento, genero, registro, id_convenio) 
                VALUES (null, '$obj->nome', '$obj->cpf', '$obj->nascimento', '$obj->genero','$obj->registro', ".$obj->convenio->id.")";
		$result = executarSql($sql);
		if($result->errno != null){
		    if ($result->errno == 1062) {
		        $mensagem = "Este CPF já está cadastrado em nossa base de dados.";
		        aprensentaMensagem(ERROR, $mensagem);
		        exit;
		    }
		}
		return $result;
	}
	
	public function editar($obj){
		$sql = "UPDATE paciente 
                SET nome = '$obj->nome',
                    cpf = '$obj->cpf',
                    nascimento = '$obj->nascimento',
                    genero = '$obj->genero',
                    registro = '$obj->registro',
                    id_convenio = ".$obj->convenio->id."
                WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
	    $sql = "SELECT * FROM paciente WHERE 1=1 order by nome";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    $pacientes = [];
	    
	    foreach ($array as $linha) {
	        $paciente = new Paciente();
	        $paciente->id            = $linha['id'];
	        $paciente->nome          = $linha['nome'];
	        $paciente->cpf           = $linha['cpf'];
	        $paciente->nascimento    = $linha['nascimento'];
	        $paciente->genero    = $linha['genero'];
	        $paciente->registro    = $linha['registro'];
	        $paciente->convenio      = $paciente->convenio->listarPorId($linha['id_convenio']);
	        $pacientes[]             = $paciente;
	    }
	    return $pacientes;
	}
	
	public function listarPorId($id){
	    $sql = "SELECT * FROM paciente WHERE 1=1 AND id = $id ";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    $paciente = new Paciente();
	    $convenio = new Convenio();
	    
	    foreach ($array as $linha) {
	        $paciente->id            = $linha['id'];
	        $paciente->nome          = $linha['nome'];
	        $paciente->cpf           = $linha['cpf'];
	        $paciente->nascimento    = $linha['nascimento'];
	        $paciente->genero    = $linha['genero'];
	        $paciente->registro    = $linha['registro'];
	        $paciente->convenio = $convenio->listarPorId($linha['id_convenio']);
	    }
	    return $paciente;
	}
	
	
	public function listarPorCpf($obj){
	    $sql = "SELECT * FROM paciente WHERE 1=1 AND cpf = '$obj->cpf' ";
	    $query = executarSql($sql);
	    $array = $query->fetch_all(MYSQLI_ASSOC);
	    $paciente = null;
	    $convenio = null;
	    
	    foreach ($array as $linha) {
	        $paciente = new Paciente();
	        $convenio = new Convenio();
	        $paciente->id            = $linha['id'];
	        $paciente->nome          = $linha['nome'];
	        $paciente->cpf           = $linha['cpf'];
	        $paciente->nascimento    = $linha['nascimento'];
	        $paciente->genero    = $linha['genero'];
	        $paciente->registro    = $linha['registro'];
	        $paciente->convenio      = $convenio->listarPorId($linha['id_convenio']);
	    }
	    return $paciente;
	}
	
	public function deletar($id){
		$sql = "DELETE FROM paciente WHERE id = " . $id;
		return executarSql($sql);
	}
	
}