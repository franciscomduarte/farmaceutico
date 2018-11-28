<?php

###################################################################
## PARAMENTROS INTERNOS DO SISTEMA
###################################################################
define('NOME_SISTEMA', 'Sistema de Checklist para UTIs');
define('SIGLA_SISTEMA', 'c.UTI');
define('AMBIENTE','PROD');

###################################################################
## PARAMENTROS DO BANCO DE DADOS
###################################################################

$ip = getenv("REMOTE_ADDR");
if($ip == '127.0.0.1' && AMBIENTE == "DEV") {
    define('HOST', 'localhost');
    define('DBNAME', 'exemplo');
    define('CHARSET', 'utf8');
    define('USER', 'root');
    define('PASSWORD', '');
} else {
    define('HOST', 'mysql.e2f.com.br');
    define('DBNAME', 'e2f10');
    define('CHARSET', 'utf8');
    define('USER', 'e2f10');
    define('PASSWORD', 'e2f12345678');
}

###################################################################
## PERFIS FIXOS DO SISTEMA
###################################################################

define('ADMINISTRADOR', 1);
define('SERVIDOR', 2);
define('RECRUTADOR', 3);
define('EXTERNO', 4);

?>
