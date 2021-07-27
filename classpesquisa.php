<?php
include("ClassConexao.php");

class ClassPesquisa extends ClassConexao{

    public function pesquisaDb($busca)
    {
        $buscaLike='%'.$busca.'%';
        $crud=$this->conectaDB()->prepare("select * from boletim where nome like :nome");
        $crud->bindValue(':nome',$buscaLike);
        $crud->execute();
        return $f=$crud->fetchAll();
    }
}