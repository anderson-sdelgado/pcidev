<?php

require('./control/FuncionarioCTR.class.php');

$funcionarioCTR = new FuncionarioCTR();

echo $funcionarioCTR->dados();
