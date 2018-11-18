<?php
var_dump($_REQUEST);

include_once '../../classes/Arquivo.php';
include_once '../../util/functions.php';

$arquivo = new Arquivo();

if(!empty($_FILES)) {
	
	$targetDir = "uploads";
	$arquivo->nome = $_REQUEST['fileName'];
	$arquivo->url  = "/".$targetDir."/".$arquivo->nome.".pdf";
	$arquivo->tipo = "pdf";
	$arquivo->tamanho = $_REQUEST['filesize'];
	$arquivo->id_curriculo = $_REQUEST['id_curriculo'];
	
	$targetFile = $_SERVER['DOCUMENT_ROOT'].$arquivo->url;
	if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
		$arquivo->inserir($arquivo);
	}
}
?> 