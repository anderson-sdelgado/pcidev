<?php

require_once('./control/AtualAplicCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

   $atualAplicCTR = new AtualAplicCTR();
   echo $atualAplicCTR->verAtualAplic($info);

endif;


//$dados = '{"dados":[{"idEquipAtualizacao":663,"versaoAtual":"1.1"}]}';