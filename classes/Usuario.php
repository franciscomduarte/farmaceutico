<?php
spl_autoload_register(function ($class) {
    include 'classes/'.$class .'.php';
});

class Usuario extends Base
{	
    public $id;
	public $nome;
	public $email;
	public $senha;
	public $ativo;
	public $data_cadastro;
	public $cpf;
	public $perfil;
	
	public function __construct(){
	    $this->tabela = "usuario";
	    $this->perfil = new Perfil();
	}
	
	public function inserir($obj){
		$sql = "INSERT INTO ".$this->tabela." (id,nome,email,senha,
                                     ativo,id_perfil,cpf,chave) 
				             VALUES (null,'$obj->nome','$obj->email','$obj->senha',
                                     1,".$obj->perfil->id.",'$obj->cpf','".$this->gerarChave()."')";
		
		return executarSql($sql);
	}
	
	public function editar($obj){
		$sql = "UPDATE ".$this->tabela."  
			SET nome      = '$obj->nome',
			    email     = '$obj->email',
			    senha     = '$obj->senha',
			    ativo     = '$obj->ativo',
			    id_perfil = '".$obj->perfil->id."',
			    cpf       = '$obj->cpf'
                WHERE chave = '$obj->chave' ";

		return executarSql($sql);
	}
	
	public function listar(){
		self::listarObjetos();
		$usuarios = [];
		
		foreach ($this->array as $linha) {
		    $usuario = new Usuario();
		    $usuario->id            = $linha['id'];
		    $usuario->nome          = $linha['nome'];
		    $usuario->email         = $linha['email'];
		    $usuario->ativo         = $linha['ativo'];
		    $usuario->cpf           = $linha['cpf'];
		    $usuario->data_cadastro = $linha['data_cadastro'];
		    $usuario->perfil        = $usuario->perfil->listarPorId($linha['id_perfil']);
		    $usuario->chave         = $linha['chave'];
		    
		    $usuarios[] = $usuario;
		}
		
		return $usuarios;
	}
	
	public function listarPorId($id){
		self::listarObjetosPorId($id);
		$usuario = new Usuario();
		
		foreach ($this->array as $linha) {
		    $usuario->id            = $linha['id'];
		    $usuario->nome          = $linha['nome'];
		    $usuario->email         = $linha['email'];
		    $usuario->ativo         = $linha['ativo'];
		    $usuario->cpf           = $linha['cpf'];
		    $usuario->data_cadastro = $linha['data_cadastro'];
		    $usuario->senha	        = $linha['senha'];
		    $usuario->perfil        = $usuario->perfil->listarPorId($linha['id_perfil']);
		    $usuario->chave         = $linha['chave'];
		}
		
		return $usuario;
	}

	public function listarPorChave($chave){
	    self::listarObjetosPorChave($chave);
	    $usuario = new Usuario();
	    
	    foreach ($this->array as $linha) {
	        $usuario->id            = $linha['id'];
	        $usuario->nome          = $linha['nome'];
	        $usuario->email         = $linha['email'];
	        $usuario->ativo         = $linha['ativo'];
	        $usuario->cpf           = $linha['cpf'];
	        $usuario->data_cadastro = $linha['data_cadastro'];
	        $usuario->senha	        = $linha['senha'];
	        $usuario->perfil        = $usuario->perfil->listarPorId($linha['id_perfil']);
	        $usuario->chave         = $linha['chave'];
	    }
	    
	    return $usuario;
	}
	
	public function listarPorLoginESenha($login, $senha){
		$sql = "SELECT *
				FROM ".$this->tabela."
				WHERE email = '$login'
				AND   senha = '" . md5($senha) . "'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function listarPorLogin($login){
		$sql = "SELECT *
				FROM ".$this->tabela."
				WHERE email = '$login'";
		$query = executarSql($sql);
		return $query->fetch_array(MYSQLI_ASSOC);
	}
	
	public function deletar($chave) {
	    self::desativarComChave($chave);
	}
	
}
