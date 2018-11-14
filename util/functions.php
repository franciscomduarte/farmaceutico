<?php 
	
	include_once 'conexao.php';
	
	define ('ERROR', 'error');
	define ('SUCCESS', 'Success');

	function redirecionar($pagina) {
		echo "<script>location.href='$pagina';</script>";
	}
	
	function aprensentaMensagem($tipo, $mensagem) {
		if($tipo == ERROR) {
			echo "<script> apresentaMensagemErro('$mensagem') </script>";
		} else if ($tipo == SUCCESS) {
			echo "<script> apresentaMensagemSucesso('$mensagem') </script>";
		}
	}
	
	function verificarPermissaoComId($url) {
		$urlSeparada = explode("{", $url);
		$usuario = $_SESSION['usuario'];
		
		$urlFormatada   = $urlSeparada[0];
		$id             = isset($urlSeparada[1]) ? $urlSeparada[1] : null;
		
		// Verifica se a URL necessita se montada com id_usuario 
		// Caso seja necessário outros ids, acrescentar outros ifs
		if ($id == 'id_usuario}') {
			$urlFormatada .= $usuario['id'];
		}
		return $urlFormatada;
	}
	
	function executarSqlMysql($sql) {
		$mysqli = Conexao::getInstance();
		$result = $mysqli->query($sql);
		if ($mysqli->errno) { 
			$mensagem = "MySQL error:". trim(addslashes($mysqli->errno)) .":". trim(addslashes($mysqli->error));
			aprensentaMensagem(ERROR, $mensagem);
			//TODO criar rotina para salvar os erros sql numa tabela
			exit();
		}
		return $result;
	}
	
	function executarSqlSqlServer($sql) {
		$conn = Conexao::getInstanceSqlServer();
// 		$result = $mysqli->query($sql);
// 		if ($mysqli->errno) {
// 			$mensagem = "MySQL error:". trim(addslashes($mysqli->errno)) .":". trim(addslashes($mysqli->error));
// 			aprensentaMensagem(ERROR, $mensagem);
// 			//TODO criar rotina para salvar os erros sql numa tabela
// 			exit();
// 		}
// 		return $result;
	}
	
	function executarSql($sql) {
		$conn = Conexao::getInstance();
		$result=pg_query($conn, $sql);
		
		if (!$result) {
			$mensagem = "Postgres error:". pg_last_error($result);
			aprensentaMensagem(ERROR, $mensagem);
			//TODO criar rotina para salvar os erros sql numa tabela
			exit();
		}
		return $result;
	}
	
	function retornaId(){
		$mysqli = Conexao::getInstance();
		return $mysqli->insert_id;
	}
	
	function retornaParametrosUrl($r){
		return explode("/", $r);
	}
	
	function caculaProgresso($item, $total) {
		return ($item/$total)*100;
	}
	
	function formatarData($date){
		$date = date_create($date);
		return date_format($date, 'd/m/Y');
	}
	
	function formatarDataHora($date){
		//$date = date_create($date);
		return date("d/m/y H:i:s", strtotime($date));;
	}
	
	function formataCpfCnpj($cpfCnpj, $formatado = true){
	    
	    // RETIRA FORMATO
	    $codigoLimpo = preg_replace("/[' '-.\/]/",'', $cpfCnpj);
	    
	    // PEGA O TAMANHO DA STRING MENOS OS DIGITOS VERIFICADORES
	    $tamanho = (strlen($codigoLimpo) -2);
	    
	    // VERIFICA SE O TAMANHO DO CÓDIGO INFORMADO É VÁLIDO
	    if ($tamanho != 9 && $tamanho != 12){
	        return false;
	    }
	    
	    if ($formatado){
	        // SELECIONA A MÁSCARA PARA CPF OU CNPJ
	        $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';
	        
	        $indice = -1;
	        for ($i=0; $i < strlen($mascara); $i++) {
	            if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
	        }
	        
	        // RETORNA O CAMPO FORMATADO
	        $retorno = $mascara;
	        
	    } else {
	        // RETIRA '.' '/' '-'
	        $retorno = str_replace('.', '', str_replace('/', '', str_replace('-', '', $codigoLimpo)));
	    }
	    
	    return $retorno;
	}
	
	function retiraPontoTraco($string) {
		$string = str_replace("'" , "" , $string );
		if (strpos($string, '@')) {
			$valor = $string;
		} else {
			$valor = str_replace("." , "" , $string );
			$valor = str_replace("-" , "" , $valor);
		}
		return $valor;
	}
	
	function verificarProgresso($objeto){
		if ($objeto['progresso'] == NULL){
			echo 'active';
		}else{
			echo $objeto['progresso'] == 0 ? 'active' : '';
		}
	}
	
	function retornaMesPorExtenso($mes){
		switch ($mes) {
			case 1:
				return "JAN";
			;
			break;
			case 2:
				return "FEV";
			break;
			case 3:
				return "MAR";
				break;
			case 4:
				return "ABR";
			break;
			case 5:
				return "MAI";
			break;
			case 6:
				return "JUN";
			break;
			case 7:
				return "JUL";
			break;
			case 8:
				return "AGO";
			break;
			case 9:
				return "SET";
			break;
			case 10:
				return "OUT";
			break;
			case 11:
				return "NOV";
			break;
			case 12:
				return "DEC";
			break;
			
			default:
				return "Mês não encontrado";
				;
			break;
		}
	}
	
	function mask($val, $mask)
	{
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}

?>