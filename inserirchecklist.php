<?php

require('./dao/InserirCheckListDAO.class.php');

$inserirCheckListDAO = new InserirCheckListDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $dados = $info['dado'];
    $posicao = strpos($dados, "_") + 1;
    $cabec = substr($dados, 0, ($posicao - 1));
    $item = substr($dados, $posicao);

    $jsonObjCabec = json_decode($cabec);
    $jsonObjItem = json_decode($item);
    $dadosCab = $jsonObjCabec->cabecalho;
    $dadosItem = $jsonObjItem->item;
    
    echo $inserirCheckListDAO->salvarDados($dadosCab, $dadosItem);

endif;
