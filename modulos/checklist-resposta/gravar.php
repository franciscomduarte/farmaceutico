<?php 
    
	#dados do formulario
	$usuario = new Usuario();
	$usuario->id 			= $_REQUEST['id'];
	$usuario->nome 			= $_REQUEST['nome'];
	$usuario->email  		= $_REQUEST['email'];
	$usuario->senha 		= md5($_REQUEST['senha']);
	$usuario->ativo 		= $_REQUEST['ativo'];
	$usuario->perfil->id    = $_REQUEST['perfil'];
	$usuario->cpf 			= $_REQUEST['cpf'];
	$usuario->foto 			= isset($_REQUEST['foto']) ? $_REQUEST['foto'] : NULL;
		
	if($usuario->id){
		$usuario->editar($usuario);
	} else {
		$usuario->inserir($usuario);
	}
	redirecionar("/usuario");

?>