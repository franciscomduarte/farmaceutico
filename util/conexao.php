<?php

/*
 * Arquivo para fazer a conexao com o banco de dados.
* Esse arquivo sera incluido aonde for necessario a utilizacao de conexao com o
* banco de dados.
*/

class Conexao {
	
	private static $mysqli;
	
	private function __construct() {
	} 
	
	public static function getInstance() {
		if (!isset(self::$mysqli)) {
			self::$mysqli = new mysqli(HOST, USER, PASSWORD, DBNAME);
			self::$mysqli->set_charset("utf8");
			// Caso algo tenha dado errado, exibe uma mensagem de erro
			if (mysqli_connect_errno()) { 
				trigger_error(mysqli_connect_error());
				aprensentaMensagem(ERROR, "Problemas com a conexão do banco de dados");
			}
		}
		return self::$mysqli;
	}
	
}

?>
