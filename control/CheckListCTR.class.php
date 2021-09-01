<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/CabecDAO.class.php');
require_once('../model/dao/RespItemDAO.class.php');

/**
 * Description of InserirDadosCTR
 *
 * @author anderson
 */
class CheckListCTR {

    private $base = 2;

    public function salvarDados($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina, $this->base);

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
            $v = $cabecDAO->verifCabec($cab, $this->base);
            if ($v == 0) {
                $cabecDAO->insCabec($cab, $this->base);
            } else {
                $cabecDAO->updCabec($cab, $this->base);
            }
            $idCab = $cabecDAO->idCabec($cab, $this->base);
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
                        $v = $respItemDAO->verifRespItem($idCabecBD, $item, $this->base);
                        if ($v == 0) {
                            $respItemDAO->insRespItem($idCabecBD, $item, $this->base);
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
    
    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina, $this->base);
    }

}
