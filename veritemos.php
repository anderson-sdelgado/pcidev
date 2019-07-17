<?php

require('./control/ItemOSCTR.class.php');

$itemOSCTR = new ItemOSCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $retorno = $itemOSCTR->dados($info);

endif;