<?php

require('./dao/VerOSDAO.class.php');

$verOSDAO = new VerOSDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $dados = array("dados" => $verOSDAO->dados($info['dado']));
    $json_str = json_encode($dados);
    echo $json_str;
    
endif;