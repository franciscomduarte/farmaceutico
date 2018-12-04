<?php

class Dashboard{
    
    protected $total;
    protected $total_internados;
    protected $grafico_barras_inicial;
    protected $filtro_grafico_checklist;
        
    function __construct() {
        $sql = "SELECT TABLE_NAME, TABLE_ROWS 
                FROM INFORMATION_SCHEMA.TABLES 
                WHERE TABLE_SCHEMA = '".DBNAME."' ";
        
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
            
        $this->total  = [];
        
        foreach ($this->array as $linha) {
            $key   = $linha['TABLE_NAME'];
            $value = $linha['TABLE_ROWS'];
            
            $this->total += [$key => $value];
        }
        
    }    
    
    public function __get($valor){
        return $this->$valor;
    }
 
    public function getDashboardInternados($setor=NULL) {
        if($setor != NULL){
           $sqlsetor = "and setor=$setor";
        }
        
        $sql = "select (SELECT COUNT(*) FROM internacao WHERE 1=1 $sqlsetor) as total,
                       (SELECT COUNT(*) FROM internacao i, internacao_checklist ic WHERE i.id = ic.id_internacao $sqlsetor) as dispensado,
	                   (SELECT COUNT(*) FROM internacao i, internacao_checklist ic WHERE i.id = ic.id_internacao $sqlsetor) as internado";  
        
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
        $this->total_internados   = $this->array[0];
            
    }
    
    public function getDashboardRespostasCheckListPorDia($setor=NULL){
        
        if ($setor==NULL){
            $sql = "select c.id, date_format(r.data_resposta,'%d/%m') as data_resposta, c.nome, c.meta,
                    count(*) as total_respondido,
                    (select count(*) from internacao i, internacao_checklist ic where i.id = ic.id_internacao and (ic.data_saida is null or ic.data_saida <= r.data_resposta)) as total_esperado
                    from resposta_checklist r, checklist c
                    where c.id = r.id_checklist
                    group by c.id, date_format(r.data_resposta,'%Y-%m-%d')";
        }else{
            $sql = "select c.id, date_format(r.data_resposta,'%d/%m') as data_resposta, c.nome, c.meta, count(*) as total_respondido,
                    (select count(*) from internacao i, internacao_checklist ic where i.id = ic.id_internacao and (data_saida is null or data_saida <= r.data_resposta) and id_setor='$setor') as total_esperado
                    from resposta_checklist r, checklist c, internacao i
                    where c.id = r.id_checklist
                    and   r.id_internacao = i.id
                    and   i.id_setor = '$setor'  
                    group by c.id, date_format(r.data_resposta,'%Y-%m-%d')";
        }
        
        $query = executarSql($sql);
        
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
        
        $array_dias = [];
        $array_respondidos = [];
        $array_esperados = [];
        
        $soma_total_respondido = 0;
        $soma_total_esperados  = 0;
        $soma_total_metas      = 0;
        $maior_valor           = 0;
        
        foreach ($this->array as $linha){
            $array_dias[]        = $linha['data_resposta'];
            $array_respondidos[] = $linha['total_respondido'];
            $array_esperados[]   = $linha['total_esperado'];
            
            $soma_total_respondido += $linha['total_respondido'];
            $soma_total_esperados  += $linha['total_esperado'];
            $soma_total_metas      += $linha['meta'];
            
            if ($maior_valor < $linha['total_esperado'])
                $maior_valor   = $linha['total_esperado'];
        }
       
        $porcentagem_resposta = $soma_total_esperados > 0 ? round(($soma_total_respondido*100)/$soma_total_esperados) : 0;
        $porcentagem_meta     = sizeof($array_dias)   > 0 ? $soma_total_metas/sizeof($array_dias) : 0;
        
        $this->grafico_barras_inicial = 
                array(
                    "dias"                  => '"'.implode('","',$array_dias).'"',
                    "previstos"             => implode(',',$array_esperados),
                    "respondidos"           => implode(',',$array_respondidos),
                    "meta_calculada"        => $porcentagem_meta,
                    "porcetagem_resposta"   => $porcentagem_resposta,
                    "maior_valor_grafico"   => round($maior_valor*1.25)
                );
    }
    
    public function getDashboarFiltroPorChecklist(){
        
        $sql = "select r.id, date_format(r.data_resposta,'%Y-%m-%d') as data_resposta,
            	       c.sigla, r.id_checklist, r.id_internacao, count(*) as total_respostas
                from resposta_checklist r, checklist c
                group by  date_format(r.data_resposta,'%Y-%m-%d'), r.id_checklist 
                order by data_resposta desc limit 5";
        
        $query = executarSql($sql);
        
        $array_filtro = [];
        
        foreach ($query->fetch_all(MYSQLI_ASSOC) as $linha){
            $array_filtro[] = array("id_checklist" => $linha['id_checklist'],
                                  "data_resposta" => $linha['data_resposta'],
                                  "sigla"         => $linha['sigla'],
                                  "label"         => $linha['sigla']." # ".formatarData($linha['data_resposta'])
                             );   
        }
        return $array_filtro;
    }
    
    public function getDashboarPorChecklist($filtro){
        
        $lista        = explode("|", $filtro);
        $id_checklist = $lista[0];
        $data_resposta_checklist = $lista[1];
        
        $sql = "select item.id, item.enunciado, item.meta, alternativa.descricao,
        		IFNULL((select count(id_resposta_alternativa)              
        		 from resposta_checklist_item r, item i, alternativa a              
        		 where r.id_item = i.id 
        		 and   i.id = item.id
        		 and   a.id = alternativa.id              
        		 and   a.id = r.id_resposta_alternativa              
        		 and   r.id_resposta_checklist in (select r.id as id_resposta    
        		 								   from resposta_checklist r                        
        		 								   where r.id_checklist = '".$id_checklist."'                        
        		 								   and   date_format(r.data_resposta,'%Y-%m-%d') = '".$data_resposta_checklist."')              
        		group by r.id_resposta_alternativa),0) as total_resposta 
                from item, checklist_item c, alternativa
                where item.id = c.id_item
                and   alternativa.id_item = item.id
                group by item.id, alternativa.id
                order by item.enunciado, alternativa.descricao";
        
        
        $query = executarSql($sql);
        $enunciado = "";
        $array_labels = [];
        $array_nao    = [];
        $array_sim    = [];
	    $array_nao_porcentagem = [];
	    $array_sim_porcentagem = [];
        $maior_valor  = 0;
        
        foreach ($query->fetch_all(MYSQLI_ASSOC) as $linha){
            
            if ($enunciado != $linha["enunciado"]){
                $array_labels[] = $linha["enunciado"];
                $enunciado = $linha["enunciado"];
            }
                
            if (strtolower($linha["descricao"]) == "não")
                $array_nao[] =  $linha["total_resposta"];
            
            if (strtolower($linha["descricao"]) == "sim")
                $array_sim[] =  $linha["total_resposta"];
            
                if ($maior_valor < $linha['total_resposta'])
                    $maior_valor = $linha['total_resposta'];
                        
        }
        
    	for($i=0;$i<sizeof($array_sim);$i++){
    	   $array_sim_porcentagem[]=calculaPorcentagem($array_sim[$i],$array_nao[$i]);
    	   $array_nao_porcentagem[]=calculaPorcentagem($array_nao[$i],$array_sim[$i]);
    	}

        $this->grafico_barras_inicial =
        array(
            "labels"            => '"'.implode('","',$array_labels).'"',
            "resposta_tipo_1"   => implode(',',$array_sim_porcentagem),
            "resposta_tipo_2"   => implode(',',$array_nao_porcentagem),
            "maior_valor"       => 100    
        );
        
    }
       
}



?>
