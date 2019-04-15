<?php

require('./dao/VerItemOSDAO.class.php');

$verItemOSDAO = new VerItemOSDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"equip":663,"os":994349}]}';

    $dados = array("dados" => $verItemOSDAO->dados($info['dado']));
    $json_str = json_encode($dados);
    echo $json_str;
    
endif;