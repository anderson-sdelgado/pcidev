<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/LogDAO.class.php');
require_once('./model/dao/CabecDAO.class.php');
require_once('./model/dao/ItemDAO.class.php');

/**
 * Description of InserirDadosCTR
 *
 * @author anderson
 */
class InserirDadosCTR {

    //put your code here

    public function salvarDados($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $posicao = strpos($dados, "_") + 1;
        $cabec = substr($dados, 0, ($posicao - 1));
        $item = substr($dados, $posicao);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjItem = json_decode($item);

        $dadosCab = $jsonObjCabec->cabecalho;
        $dadosItem = $jsonObjItem->item;

        return $this->salvarCabec($dadosCab, $dadosItem);
    }

    private function salvarCabec($dadosCab, $dadosItem) {
        $cabecDAO = new CabecDAO();
        foreach ($dadosCab as $cab) {
            $v = $cabecDAO->verifCabec($cab);
            if ($v == 0) {
                $cabecDAO->insCabec($cab);
            } else {
                $cabecDAO->updCabec($cab);
            }
            $idCab = $cabecDAO->idCabec($cab);
            $this->salvarItem($idCab, $cab->idCabec, $dadosItem);
            if ($cab->statusCabec == 1) {
                $retorno = "GRAVOU-CLABERTO";
            } else {
                $retorno = "GRAVOU-CLFECHADO";
            }
        }
        return $retorno;
    }

    private function salvarItem($idCabecBD, $idCabecCel, $dadosItem) {
        $itemDAO = new ItemDAO();
        foreach ($dadosItem as $item) {
            if ($idCabecCel == $item->idCabRespItem) {
                $v = $itemDAO->verifItem($idCabecBD, $item);
                if ($v == 0) {
                    $itemDAO->insItem($idCabecBD, $item);
                }
            }
        }
    }

}
