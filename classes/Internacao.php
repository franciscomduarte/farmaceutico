<?php

class Internacao extends Base
{
	
	protected $id;
	protected $numero_internacao;
	protected $data_internacao;
	protected $id_setor;
	protected $id_paciente;
	protected $id_convenio;
	
	public function inserir($obj){
		$sql = "INSERT INTO internacao (id, numero_internacao, data_internacao, id_setor, id_paciente, id_convenio) 
                VALUES (null, '$obj->numero_internacao', '$obj->data_internacao', $obj->id_setor, $obj->id_paciente, $obj->id_convenio)";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE internacao 
                SET numero_internacao = '$obj->numero_internacao', 
                data_internacao = '$obj->data_internacao',
                id_setor = $obj->id_setor,
                id_paciente = $obj->id_paciente,
                id_convenio = $obj->id_convenio
                WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM internacao WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM internacao WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM internacao WHERE id = " . $id;
		return executarSql($sql);
	}
	
}