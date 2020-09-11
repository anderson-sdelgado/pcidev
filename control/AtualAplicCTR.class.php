<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('./model/dao/AtualAplicDAO.class.php');
/**
 * Description of AtualAplicCTR
 *
 * @author anderson
 */
class AtualAplicCTR {
    //put your code here
    
    private $base = 2;
    
    public function atualAplic($versao, $info) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 1.00){
        
            $atualAplicDAO = new AtualAplicDAO();

            $jsonObj = json_decode($info['dado']);
            $dados = $jsonObj->dados;

            foreach ($dados as $d) {
                $celular = $d->idCelularAtual;
                $va = $d->versaoAtual;
            }
            $retorno = 'N';
            $v = $atualAplicDAO->verAtual($celular, $this->base);
            if ($v == 0) {
                $atualAplicDAO->insAtual($celular, $va, $this->base);
            } else {
                $result = $atualAplicDAO->retAtual($celular, $this->base);
                foreach ($result as $item) {
                    $vn = $item['VERSAO_NOVA'];
                    $vab = $item['VERSAO_ATUAL'];
                }
                if ($va != $vab) {
                    $atualAplicDAO->updAtualNova($equip, $va, $this->base);
                } else {
                    if ($va != $vn) {
                        $retorno = 'S';
                    } else {
                        if (strcmp($va, $vab) <> 0) {
                            $atualAplicDAO->updAtual($equip, $va, $this->base);
                        }
                    }
                }
            }
            $dthr = $atualAplicDAO->dataHora($this->base);
            if ($retorno == 'S') {
                return $retorno;
            } else {
                return $retorno . "#" . $dthr;
            }
        
        }
        
    }
    
}
