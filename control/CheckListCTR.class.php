<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/CabecDAO.class.php');
require_once('../model/RespItemDAO.class.php');

/**
 * Description of InserirDadosCTR
 *
 * @author anderson
 */
class CheckListCTR {

    public function salvarDados($info) {

        $dados = $info['dado'];

        $pos1 = strpos($dados, "_") + 1;
        $pos2 = strpos($dados, "#") + 1;
        
        $cabec = substr($dados, 0, ($pos1 - 1));
        $planta = substr($dados, $pos1, (($pos2 - 1) - $pos1));
        $item = substr($dados, $pos2);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjPlanta = json_decode($planta);
        $jsonObjItem = json_decode($item);

        $dadosCab = $jsonObjCabec->cabecalho;
        $dadosPlanta = $jsonObjPlanta->planta;
        $dadosItem = $jsonObjItem->item;

        return $this->salvarCabec($dadosCab, $dadosPlanta, $dadosItem);
    }

    private function salvarCabec($dadosCab, $dadosPlanta, $dadosItem) {
        $cabecDAO = new CabecDAO();
        $idCabecArray = array();
        foreach ($dadosCab as $cab) {
            $v = $cabecDAO->verifCabec($cab);
            if ($v == 0) {
                $cabecDAO->insCabec($cab);
            } else {
                $cabecDAO->updCabec($cab);
            }
            $idCab = $cabecDAO->idCabec($cab);
            $retPlanta = $this->salvarPlantaItem($idCab, $cab->idCabec, $dadosPlanta, $dadosItem);
            $idCabecArray[] = array("idCabec" => $cab->idCabec);
        }
        $dadoCabec = array("cabecalho"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return "GRAVOU-CHECKLIST_" . $retCabec . "#" . $retPlanta;
    }

    private function salvarPlantaItem($idCabecBD, $idCabecCel, $dadosPlanta, $dadosItem) {
        $respItemDAO = new RespItemDAO();
        $idPlantaArray = array();
        foreach ($dadosPlanta as $planta) {
            if($idCabecCel == $planta->idCabec) {
                foreach ($dadosItem as $item) {
                    if($planta->idPlantaCabec == $item->idPlantaCabecItem) {
                        $v = $respItemDAO->verifRespItem($idCabecBD, $item);
                        if ($v == 0) {
                            $respItemDAO->insRespItem($idCabecBD, $item);
                        }
                    }
                }
                $idPlantaArray[] = array("idPlantaCabec" => $planta->idPlantaCabec);
            }
        }
        $dadoPlanta = array("planta"=>$idPlantaArray);
        $retPlanta = json_encode($dadoPlanta);
        return $retPlanta;
    }
    
}
