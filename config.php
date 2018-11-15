<?php 

	###################################################################
	## PARAMENTROS INTERNOS DO SISTEMA
	###################################################################
	define('NOME_SISTEMA', 'SISTEMA EXEMPLO - SISTEMA-EXP'); 
	define('SIGLA_SISTEMA', 'EXP'); 

	###################################################################
	## PARAMENTROS DO BANCO DE DADOS MYSQL
	###################################################################
	define('MYSQL_HOST', 'mysql.e2f.com.br');
	define('MYSQL_DBNAME', 'e2f10');
	define('MYSQL_CHARSET', 'utf8');
	define('MYSQL_USER', 'e2f10');
	define('MYSQL_PASSWORD', 'e2f12345678'); 

	###################################################################
	## PARAMENTROS DO BANCO DE DADOS POSTGRESQL
	###################################################################
	define('PG_HOST', '192.168.56.101');
	define('PG_DBNAME', 'exemplo');
	define('PG_CHARSET', 'UTF8');
	define('PG_USER', 'postgre');
	define('PG_PASSWORD', 'e2f12345678'); 
	
	$ip = getenv("REMOTE_ADDR");
	if($ip == '127.0.0.1') {
		define('URL_SISTEMA', '/projeto-exemplo');
		define('ENDERECO', 'http://localhost/projeto-exemplo');
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