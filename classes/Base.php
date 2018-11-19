<?php

abstract class Base
{
    
    public abstract function inserir($obj);
    
    public abstract function editar($obj);
    
    public abstract function listar();
    
    public abstract function listarPorId($id);
    
    public abstract function deletar($id);
    
    public function retornaIdInserido() {
        return retornaId();
    }
    
    public function __get($valor){
        return $this->$valor;
    }
    
    public function __set($propriedade,$valor){
        $this->$propriedade = addslashes($valor);
    }
}

