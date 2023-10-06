<?php

require_once('../control/CheckListCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $checkListCTR = new CheckListCTR();
    echo $checkListCTR->salvarDados($info);

endif;
