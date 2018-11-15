<?php

/*
* Arquivo para fazer a conexao com o banco de dados.
* Esse arquivo sera incluido aonde for necessario a utilizacao de conexao com o
* banco de dados.
*/

class Conexao {
	
	private static $pg;
	private static $mysqli;
	private static $sqlserver;
	
	private function __construct() {
	} 
	
	public static function getInstance($type=NULL) {
		switch ($type){
			case "mysql":
				getInstanceMySQL();
			break;
			case "postgresql":
				getInstancePostGreSQL();
			break;
			case "sqlserver":
				getInstanceSqlServer();
			break;
			default:
				getInstanceMySQL();
			break;
		}		
	}

	public static function getInstanceMySQL() {

		if (!isset(self::$mysql)) {
			self::$mysqli = new mysqli('p:'. MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DBNAME);
 			self::$mysqli->set_charset("utf8");
			// Caso algo tenha dado errado, exibe uma mensagem de erro
			if (pg_connection_status(self::$mysqli) !== 0) { 
				aprensentaMensagem(ERROR, "Problemas com a conexão do banco de dados");
			}
		}
		return self::$mysqli;
	}

	public static function getInstancePostGreSQL() {
		
		if (!isset(self::$pg)) {
			self::$pg = @pg_connect("host=".PG_HOST." port=5432 dbname=".PG_DBNAME." user=".PG_USER." password=".PG_PASSWORD." options='--client_encoding=".PG_CHARSET."'");
			// Caso algo tenha dado errado, exibe uma mensagem de erro
			if (pg_connection_status(self::$pg) !== 0) { 
				aprensentaMensagem(ERROR, "Problemas com a conexão do banco de dados");
			}
		}
		return self::$pg;
	}
	
	public static function getInstanceSqlServer() {
		$local = "10.224.8.27";
		$user = "Usr_vw_BDENAP";
		$password = "enap@view";
		if (!isset(self::$sqlserver)) {
			self::$sqlserver =  mssql_connect($local,$user,$password) or die('Erro ao conectar ao banco de dados!');
		}
		return self::$sqlserver;
	}
	
}
?>
