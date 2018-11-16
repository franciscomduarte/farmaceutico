<?php

class PermissaoPerfil
{

	protected $id_permissao;
	protected $id_perfil;
	
	public function inserir($obj){
		$sql = "INSERT INTO permissao_perfil (id_permissao, id_perfil) VALUES ('$obj->id_permissao', '$obj->id_perfil')";
		return executarSql($sql);
	}
	
	public function deletar($id_permissao, $id_perfil){
		$sql = "DELETE FROM permissao_perfil WHERE id_tema = " . $id_permissao. " AND  id_curriculo = " . $id_perfil;
		return executarSql($sql);
	}

	public function listar(){
		$sql = "SELECT ps.id, ps.descricao
				FROM permissao ps
				ORDER BY ps.id_permissao_pai";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}

	public function listarPorPerfil($id){
		$sql = "SELECT ps.id, ps.descricao
				FROM perfil p, permissao ps, permissao_perfil pp
				WHERE p.id = pp.id_perfil
				AND   ps.id = pp.id_permissao
				AND   p.id = $id 
				ORDER BY ps.id_permissao_pai";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function deleteAll($id){
		$sql = "DELETE from permissao_perfil where id_perfil = $id";
		$query = executarSql($sql);
	}

	public function listarPorIdCurriculo($id){
		$sql = "SELECT b.descricao as descricao 
                FROM permissao_perfil a, tema b 
                WHERE a.id_tema = b.id AND a.id_curriculo = $id ";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	// Criação dos métodos __Get e __Set
	public function __get($valor){
		return $this->$valor;
	}
	public function __set($propriedade,$valor){
		$this->$propriedade = addslashes($valor);
	}
	
	
}