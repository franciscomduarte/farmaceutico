<?php

class Dashboard{
    
    protected $total;
    protected $total_internados;
    protected $grafico_barras_inicial;
        
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
                       (SELECT COUNT(*) FROM internacao WHERE data_saida is not null $sqlsetor) as dispensado,
	                   (SELECT COUNT(*) FROM internacao WHERE data_saida is null $sqlsetor) as internado";  
        
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
        $this->total_internados   = $this->array[0];
            
    }
    
    public function getDashboardRespostasCheckListPorDia($setor=NULL){
        
        if ($setor==NULL){
            $sql = "select c.id, date_format(r.data_resposta,'%d/%m') as data_resposta, c.nome, c.meta,
                    count(*) as total_respondido,
                    (select count(*) from internacao where (data_saida is null or data_saida <= r.data_resposta)) as total_esperado
                    from resposta_checklist r, checklist c
                    where c.id = r.id_checklist
                    group by c.id, date_format(r.data_resposta,'%Y-%m-%d')";
        }else{
            $sql = "select c.id, date_format(r.data_resposta,'%d/%m') as data_resposta, c.nome, c.meta, count(*) as total_respondido,
                    (select count(*) from internacao where (data_saida is null or data_saida <= r.data_resposta) and id_setor='$setor') as total_esperado
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
       
}



?>