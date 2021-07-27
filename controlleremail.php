<?php
include "../class/ClassPesquisa.php";

$busca=filter_input(INPUT_POST,'busca',FILTER_SANITIZE_SPECIAL_CHARS);
$pesquisa=new ClassPesquisa();
$retorno=$pesquisa->pesquisaDb($busca);
echo json_encode($retorno);