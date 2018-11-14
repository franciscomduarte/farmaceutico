<?php 

	###################################################################
	## PARAMENTROS INTERNOS DO SISTEMA
	###################################################################
	define('NOME_SISTEMA', 'DASHBOARD - EVG'); 
	define('SIGLA_SISTEMA', 'EVG'); 

	###################################################################
	## PARAMENTROS DO BANCO DE DADOS
	###################################################################
	define('HOST', '10.224.8.34');
	define('DBNAME', 'db_secretaria_virtual');
	define('CHARSET', 'utf8');
	define('USER', 'cgead_user');
	define('PASSWORD', 'e13VV4sEXS'); 
	
	
	$ip = getenv("REMOTE_ADDR");
	if($ip == '127.0.0.1') {
		define('URL_SISTEMA', '');
		define('ENDERECO', 'http://projeto-exemplo:83/');
	} else {
		define('URL_SISTEMA', '/projeto-exemplo');
		define('ENDERECO', 'http://e2f.com.br/projeto-exemplo');
	}
	
// 	define('HOST', 'localhost');
// 	define('DBNAME', 'secretaria');
// 	define('CHARSET', 'utf8');
// 	define('USER', 'postgres');
// 	define('PASSWORD', ''); 

// 	IP: 10.224.8.34
// 	Porta: 5432
// 	Database: db_secretaria_virtual
// 	User: cgead_user
// 	Password: e13VV4sEXS
	
	
?>