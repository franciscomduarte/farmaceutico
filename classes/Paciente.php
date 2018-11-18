<?php

class Paciente
{
	
	protected $id;
	protected $nome;
	protected $cpf;
	protected $nascimento;
	protected $id_convenio;
	
	public function inserir($obj) {
		$sql = "INSERT INTO paciente (id, nome, cpf, nascimento, id_convenio) 
                VALUES (null, '$obj->nome', '$obj->cpf', '$obj->nascimento', $obj->id_convenio)";
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
                    id_convenio = $obj->id_convenio
                WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM paciente WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM paciente WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM paciente WHERE id = " . $id;
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