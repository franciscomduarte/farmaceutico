<?php 

	#dados do formulario

	$permissoesSelecionadas = array();
	foreach ($_REQUEST as $key => $elemento) {
		if (strstr($key,"check_") != NULL){
			array_push($permissoesSelecionadas,$elemento);
		}
	} 
	
	$perfil = new Perfil();
	$perfil->id = $_REQUEST['id'];
	$perfil->descricao = $_REQUEST['descricao'];
	
	if($perfil->id){
		$perfil->editar($perfil);
	} else {
		$perfil->inserir($perfil);
	}
	
	$permissoes = new PermissaoPerfil();
	$permissoes->deleteAll($perfil->id);

 	foreach ($permissoesSelecionadas as $value) {
		$permissao = new PermissaoPerfil();
		$permissao->id_permissao = $value;
		$permissao->id_perfil = $perfil->id;
		$permissoes->inserir($permissao);
		
	}

	redirecionar("/perfil");

?>