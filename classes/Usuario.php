<?php

class Usuario
{
	
	protected $id;
	protected $nome;
	protected $email;
	protected $senha;
	protected $ativo;
	protected $data_cadastro;
	protected $cpf;
	protected $siape;
	protected $rg;
	protected $nascimento;
	protected $endereco;
	protected $municipio;
	protected $cep;
	protected $telefone;
	protected $cargo;
	protected $uf_id;
	protected $lotacao_id;
	protected $foto;
	protected $id_perfil;
	
	public function inserir($obj){
		
		$locacao = $obj->lotacao_id == null ? 'null' : $obj->lotacao_id;
		$uf 	 = $obj->uf_id == null ? 'null' : $obj->uf_id;
		
		$sql = "INSERT INTO usuario (id, 
									 nome,
									 email,
									 senha,
									 ativo,
									 id_perfil,
									 cpf,
									 siape,
									 rg,
									 nascimento,
									 endereco,
									 municipio,
									 cep,
									 telefone,
									 cargo,
									 uf_id,
									 lotacao_id,
									 foto) 
				VALUES 				(null, 
									'$obj->nome',
									'$obj->email',
									'$obj->senha',
									 1,
									'$obj->id_perfil',
									'$obj->cpf',
									'$obj->siape',
									'$obj->rg',
									'$obj->nascimento',
								    '$obj->endereco',
									'$obj->municipio',
									'$obj->cep',
									'$obj->telefone',
									'$obj->cargo',
									 $uf,
									 $locacao,
									'')";
		return executarSql($sql);
	}
	
	public function atualizarSenha($idUsuario, $obj) {
			
		$sql = "UPDATE usuario set
		senha 		= '$obj->senha'
		WHERE id 		= $idUsuario";
		return executarSql ( $sql );
	}
	
	public function editar($obj){
		$sql = "UPDATE usuario 
                SET nome 		= '$obj->nome',
					email 		= '$obj->email',
					senha 		= '$obj->senha',
					ativo 		= '$obj->ativo',
					id_perfil	= '$obj->id_perfil',
					cpf 		= '$obj->cpf',
					siape 		= '$obj->siape',
					rg 			= '$obj->rg',
					nascimento 	= '$obj->nascimento',
					endereco 	= '$obj->endereco', 
					municipio 	= '$obj->municipio',
					cep 		= '$obj->cep',
					telefone 	= '$obj->telefone',
					cargo 		= '$obj->cargo',
					uf_id 		= '$obj->uf_id',
					lotacao_id 	= '$obj->lotacao_id'
                WHERE id 		= $obj->id ";
		return executarSql($sql);
	}
	
	public function atualizarDadosBasicos($obj){
		$sql = "UPDATE usuario
		SET nome 		= '$obj->nome',
		cpf 		= '$obj->cpf',
		siape 		= '$obj->siape',
		rg 			= '$obj->rg',
		nascimento 	= '$obj->nascimento',
		endereco 	= '$obj->endereco',
		municipio 	= '$obj->municipio',
		cep 		= '$obj->cep',
		telefone 	= '$obj->telefone',
		cargo 		= '$obj->cargo',
		uf_id 		= '$obj->uf_id',
		lotacao_id 	= '$obj->lotacao_id'
		WHERE id 		= $obj->id ";
		return executarSql($sql);
	}
	
	public function desativar($id){
		$sql = "UPDATE usuario set ativo = 0 WHERE id = $id ";
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM usuario WHERE 1=1";
		$query = executarSql($sql);
		return $query->fetch_all(MYSQLI_ASSOC);
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM usuario WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorLoginESenha($login, $senha){
		$sql = " SELECT *
				 FROM usuario
				 WHERE email = '$login'
				 AND   senha = '" . md5($senha) . "'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorLogin($login){
		$sql = " SELECT *
				FROM usuario
				WHERE email = '$login'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorCpf($cpf){
		$sql = " SELECT *
		FROM usuario
		WHERE cpf = '$cpf'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM usuario WHERE id = " . $id;
		return executarSql($sql);
	}
	
	public function retornaIdInserido() {
		return retornaId();
	}
	
	public function __get($valor){
		return $this->$valor;
	}
	public function __set($propriedade,$valor){
		$this->$propriedade = addslashes($valor);
	}
	
}