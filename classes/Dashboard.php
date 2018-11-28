<?php

class Dashboard{
    
    protected $total;
    protected $total_internados;
        
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
        
        $sql = "select c.id, date_format(r.data_resposta,'%Y-%m-%d') as data_resposta, c.nome, c.meta,
                count(*) as total_respondido,
                (select count(*) from internacao where (data_saida is null or data_saida <= r.data_resposta)) as total_esperado,
                (select ROUND((count(*)*100)/total_esperado)) as porcentagem
                from resposta_checklist r, checklist c
                where c.id = r.id_checklist
                group by c.id, date_format(r.data_resposta,'%Y-%m-%d')";
       
    }
       
}
?>