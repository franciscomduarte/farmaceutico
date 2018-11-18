<?php
	$targetDir = $_SERVER['DOCUMENT_ROOT']."/uploads/";
	$fileName= $_POST['filetodelete'];
	$targetFile = $targetDir.$fileName;
	echo json_encode($_POST);
	//unlink($targetFile);
?>
