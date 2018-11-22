<?php

class Alternativa extends Base
{
    protected $id;
    protected $descricao;
    protected $item;
    
    public function __construct(){
        $this->item = new Item();
    }
    
    public function inserir($obj){
       
        $sql = "INSERT INTO alternativa (id,descricao,id_item)
    				               VALUES (null,'$obj->descricao',".$obj->item->id.")";
            
        return executarSql($sql);
        
    }
    
    public function editar($obj){
        $sql = "UPDATE alternativa
                SET descricao = '$obj->nome',
					id_item   = '".$obj->item->id."'
                WHERE id 	= $obj->id";
        
        return executarSql($sql);
    }
    
    public function listarPorIdCkelist($id_checklist) {
        $sql = " SELECT a.* FROM alternativa a, item b, checklist_item c, checklist d WHERE 1 = 1 and a.id_item = b.id and b.id = c.id_item and c.id_checklist = d.id and d.id = $id_checklist";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $alternativas = [];
        
        foreach ($array as $linha) {
            $alternativa = new Alternativa();
            $alternativa->id         = $linha['id'];
            $alternativa->descricao  = $linha['descricao'];
            $alternativa->item       = $alternativa->item->listarPorId($linha['id_item']);
            $alternativas[] = $alternativa;
        }
        
        return $alternativas;
    }
    
    
    public function listar() {
        $sql = "SELECT * FROM alternativa WHERE 1=1 ";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $alternativas = [];
        
        foreach ($array as $linha) {
            $alternativa = new Alternativa();
            $alternativa->id         = $linha['id'];
            $alternativa->descricao  = $linha['descricao'];
            $alternativa->item       = $alternativa->item->listarPorId($linha['id_item']);
            
            $alternativas[] = $alternativa;
        }
        
        return $alternativas;
    }
    
    public function listarComChecklist($id_checklist){
        $sql = "SELECT * FROM alternativa WHERE id_item = $id_checklist";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $alternativas = [];
        
        foreach ($array as $linha) {
            $alternativa = new Alternativa();
            $alternativa->id         = $linha['id'];
            $alternativa->descricao  = $linha['descricao'];
            $alternativa->item       = $alternativa->item->listarPorId($linha['id_item']);
            
            $alternativas[] = $alternativa;
        }
        
        return $alternativas;
    }
    
    public function listarComItem($id_item){
        $sql = "SELECT * FROM alternativa WHERE id_item = $id_item";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $alternativas = [];
        
        foreach ($array as $linha) {
            $alternativa = new Alternativa();
            $alternativa->id         = $linha['id'];
            $alternativa->descricao  = $linha['descricao'];
            $alternativa->item       = $alternativa->item->listarPorId($linha['id_item']);
            
            $alternativas[] = $alternativa;
        }
        
        return $alternativas;
    }
    
    public function listarPorId($id){
        $sql = "SELECT * FROM alternativa WHERE 1=1 AND id = $id ";
        $query = executarSql($sql);
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        $alternativa = new Alternativa();
        
        foreach ($array as $linha) {
            $alternativa->id         = $linha['id'];
            $alternativa->descricao  = $linha['descricao'];
            $alternativa->item       = $alternativa->item->listarPorId($linha['id_item']);
        }
        
        return $alternativa;
        
    }
    
    public function deletar($id){
        #fazer consulta no checklist_resposta pra verificar se já tem resposta
        #se tiver não pode excluir.
        $sql = "DELETE FROM alternativa WHERE id = " . $id;
        return executarSql($sql);
    }
    
}