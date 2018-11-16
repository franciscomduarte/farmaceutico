<?php

class Permissao
{
	
	protected $id;
	protected $descricao;
	protected $url;
	protected $tipoMenu;
	
	public function inserir($obj){
		$sql = "INSERT INTO permissao (id, descricao, url) VALUES (null, '$obj->descricao', '$obj->url')";
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE permissao set descricao = '$obj->descricao' WHERE id = $obj->id ";
		return executarSql($sql);
	}
	
	public function listar() {
		$sql = "SELECT * FROM permissao WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarMenus() {
		$sql = "SELECT * 
				FROM permissao 
				WHERE 1=1 AND id_permissao_pai is NULL";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarSubMenus() {
		$sql = "SELECT *
				FROM permissao
				WHERE 1=1 AND a.id_permissao_pai is NOT NULL";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM permissao WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function montarMenuPorIdPerfilUsuario($idPerfilUsuario){
		$sql = "SELECT * 
                FROM permissao a, permissao_perfil b
                WHERE 1=1 
				AND a.id = b.id_permissao
				AND a.id_permissao_pai is NULL
				AND b.id_perfil = $idPerfilUsuario ";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	
	public function montarSubMenuPorIdPerfilUsuario($idPerfilUsuario, $idPermissaoPai){
		$sql = "SELECT *
		FROM permissao a, permissao_perfil b
		WHERE 1=1
		AND a.id = b.id_permissao
		AND a.id_permissao_pai = $idPermissaoPai
		AND b.id_perfil = $idPerfilUsuario ";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM permissao WHERE id = " . $id;
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