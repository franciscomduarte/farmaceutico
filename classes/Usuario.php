<?php
spl_autoload_register(function ($class) {
    include 'classes/'.$class .'.php';
});

class Usuario extends Base
{	
    protected $id;
	protected $nome;
	protected $email;
	protected $senha;
	protected $ativo;
	protected $data_cadastro;
	protected $cpf;
	protected $perfil;
	
	public function __construct(){
	    $this->perfil = new Perfil();
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO usuario (id,nome,email,senha,
                                     ativo,id_perfil,cpf) 
				             VALUES (null,'$obj->nome','$obj->email','$obj->senha',
                                     1,".$obj->perfil->id.",'$obj->cpf')";
		
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE usuario 
                SET nome 		= '$obj->nome',
					email 		= '$obj->email',
					senha 		= '$obj->senha',
					ativo 		= '$obj->ativo',
					id_perfil	= '".$obj->perfil->id."',
					cpf 		= '$obj->cpf'
                WHERE id 		= $obj->id ";
		
		return executarSql($sql);
	}
	
	public function desativar($id){
		$sql = "UPDATE usuario set ativo = 0 WHERE id = $id ";
		
		return executarSql($sql);
	}
	
	public function listar(){
		$sql = "SELECT * FROM usuario WHERE 1=1 order by nome";
		$query = executarSql($sql);
		
		$array = $query->fetch_all(MYSQLI_ASSOC);
		
		$usuarios = [];
		
		foreach ($array as $linha) {
		    $usuario = new Usuario();
		    $usuario->id            = $linha['id'];
		    $usuario->nome          = $linha['nome'];
		    $usuario->email         = $linha['email'];
		    $usuario->ativo         = $linha['ativo'];
		    $usuario->cpf           = $linha['cpf'];
		    $usuario->data_cadastro = $linha['data_cadastro'];
		    $usuario->perfil        = $usuario->perfil->listarPorId($linha['id_perfil']);
		    
		    $usuarios[] = $usuario;
		}
		
		return $usuarios;
	}
	
	public function listarPorId($id){
		$sql = "SELECT * FROM usuario WHERE 1=1 AND id = $id ";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorLoginESenha($login, $senha){
		$sql = "SELECT *
				FROM usuario
				WHERE email = '$login'
				AND   senha = '" . md5($senha) . "'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorLogin($login){
		$sql = "SELECT *
				FROM usuario
				WHERE email = '$login'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($id){
		$sql = "DELETE FROM usuario WHERE id = " . $id;
		return executarSql($sql);
	}
	
}