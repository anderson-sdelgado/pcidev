<?php

require('./dao/FuncionarioDAO.class.php');

$funcionarioDAO = new FuncionarioDAO();

//cria o array associativo
$dados = array("dados"=>$funcionarioDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
