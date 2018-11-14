<?php 

	include_once '../../classes/Teste.php';
	include_once '../../config.php';
	include_once '../../util/functions.php';

	
	$teste = new Teste();
	$teste->editar($teste);
	
	$lista = $teste->listar();
	
	$arrayT = array();
	foreach ($lista as $teste) {
		array_push($arrayT, ["DT_RowId"=>$teste['id'], 
				             "descricao"=>$teste['descricao'], 
				             "acao"=>""
							]);
	}
	
 	echo "{\"data\":".json_encode($arrayT)."}";
 	
 	
?>