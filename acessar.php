<?php

	session_start();

	echo $login = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	if(validaUsuarioExterno($login, $senha)) {
	    $_SESSION['usuario'] = true; // remover
		redirecionar("index.php");
	}else{
		$_SESSION['usuario'] = NULL;
		redirecionar("/login.php?erro=1");
	}
	
	function validaUsuarioExterno($login, $senha){
// 		$usuario = new Usuario();
// 		$resultado = $usuario->listarPorLoginESenha($login, $senha);
		
// 		if(!empty($resultado)){
// 			$_SESSION['usuario'] = $resultado;
			
// 			$id = $resultado['id'];
// 			$sqlHistorico = "INSERT INTO historico_acesso VALUES (null, now(), '$id')";
// 			executarSql($sqlHistorico);
			
// 			return true;
// 		}
		return true;
	}
	
?>