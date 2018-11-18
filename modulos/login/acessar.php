<?php

	require_once '../../config.php';
	require_once '../../util/functions.php';
	require_once '../../classes/Usuario.php';
	
	session_start();
	


	$login = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	/* Validação de acesso, primeiramente será feito um busca via banco, caso não encontre será feito a busca no ldap */ 
	if(validaUsuarioExterno($login, $senha)) {
		redirecionar("/index.php");
	}elseif(validaUsuarioInterno($login, $senha)) {
		redirecionar("/index.php");
	}else{
		$_SESSION['usuario'] = NULL;
		redirecionar("/login.php?erro=1");
	}
	
	function validaUsuarioExterno($login, $senha){
		$usuario = new Usuario();
		$resultado = $usuario->listarPorLoginESenha($login, $senha);
		
		if(!empty($resultado)){
			$_SESSION['usuario'] = $resultado;
			
			$id = $resultado['id'];
			$sqlHistorico = "INSERT INTO historico_acesso VALUES (null, now(), '$id')";
			executarSql($sqlHistorico);
			
			return true;
		}
		return false;
	}
	
?>