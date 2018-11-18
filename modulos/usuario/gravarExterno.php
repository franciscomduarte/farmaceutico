<?php 

	include_once '../../config.php';
	include_once '../../util/functions.php';
	include_once '../../classes/Usuario.php';

	#dados do formulario
	$usuario = new Usuario();
	$usuario->nome 			= $_REQUEST['nome'];
	$usuario->email  		= $_REQUEST['email'];
	$usuario->senha 		= md5($_REQUEST['senha']);
	$usuario->ativo 		= $_REQUEST['ativo'];
	$usuario->data_cadastro = date('yyyy-mm-dd');
	$usuario->id_perfil     = EXTERNO;
	$usuario->cpf 			= $_REQUEST['cpf'];
	$usuario->siape 		= $_REQUEST['siape'];
	$usuario->rg 			= $_REQUEST['rg'];
	$usuario->nascimento 	= $_REQUEST['nascimento'];
	$usuario->endereco 		= $_REQUEST['endereco'];
	$usuario->municipio 	= $_REQUEST['municipio'];
	$usuario->cep 			= $_REQUEST['cep'];
	$usuario->telefone 		= $_REQUEST['telefone'];
	$usuario->cargo 		= $_REQUEST['cargo'];
	$usuario->uf_id 		= $_REQUEST['uf_id'];
	$usuario->lotacao_id 	= NULL;
	$usuario->foto 			= NULL;
	
	//TODO
	// Realizar validação de CPF -> verficar se o CPF informado já exite.
	
	$usuario->inserir($usuario);
	redirecionar("/login.php?mensagem=1");

?>