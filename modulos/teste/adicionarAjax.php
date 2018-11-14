<?php 

	include_once '../../classes/Teste.php';
	include_once '../../config.php';
	include_once '../../util/functions.php';

	//{"action":"create","data":[{"descricao":"adsaasd"}]}
	$action = $_POST['action'];
	if($action == "create"){
		$dados = $_POST['data'][0];
	 	$teste = new Teste();
	 	$teste->descricao = $dados['descricao'];
	 	$teste->inserir($teste);
	}
	
	echo json_encode($_POST);
?>