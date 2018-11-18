<?php 


	#dados do formulario
	$usuario = new Usuario();
	$usuario->id 			= $_REQUEST['id'];
	$usuario->nome 			= $_REQUEST['nome'];
	$usuario->email  		= $_REQUEST['email'];
	$usuario->senha 		= md5($_REQUEST['senha']);
	$usuario->ativo 		= $_REQUEST['ativo'];
	$usuario->data_cadastro = date('yyyy-mm-dd');
	$usuario->id_perfil     = $_REQUEST['perfil'];
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
	$usuario->lotacao_id 	= $_REQUEST['lotacao_id'];
	$usuario->foto 			= isset($_REQUEST['foto']) ? $_REQUEST['foto'] : NULL;
	
	if($usuario->id){
		$usuario->editar($usuario);
	} else {
		$usuario->inserir($usuario);
	}
	redirecionar("/usuario");

?>