<?php

class Alternativa extends Base
{
    public $id;
    public $descricao;
    public $mensagem;
    
    public function __construct(){
        $this->tabela = "alerta";
    }
    public function inserir($obj)
    {
        
        $sql = "INSERT INTO ".$this->tabela." (id,descricao,mensagem)
				             VALUES (null,'$obj->descricao','$obj->mensagem')";
        
        return executarSql($sql);
        
    }

    public function listar()
    {}

    public function editar($obj)
    {}

    public function listarPorId($id)
    {}
    
}