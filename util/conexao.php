<?php

/*
 * Arquivo para fazer a conexao com o banco de dados.
* Esse arquivo sera incluido aonde for necessario a utilizacao de conexao com o
* banco de dados.
*/

class Conexao {
	
	private static $pg;
	private static $sqlserver;
	
	private function __construct() {
	} 
	
	public static function getInstance() {
		if (!isset(self::$pg)) {
			self::$pg = @pg_connect("host=".HOST." port=5432 dbname=".DBNAME." user=".USER." password=". PASSWORD);
// 			self::$mysqli->set_charset("utf8");
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
