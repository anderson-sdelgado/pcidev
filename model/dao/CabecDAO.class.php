<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of CabecalhoDAO
 *
 * @author anderson
 */
class CabecDAO extends Conn {

    public function verifCabec($cab, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " CHECKLIST_INDUSTRIA_CABECALHO "
                . " WHERE "
                . " DATA_CLI_CABEC = TO_DATE('" . $cab->dataCabec . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNCIONARIO_CLI_CABEC = " . $cab->idFuncCabec . " ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idCabec($cab, $base) {

        $select = " SELECT "
                . " ID_CLI_CABEC AS ID "
                . " FROM "
                . " CHECKLIST_INDUSTRIA_CABECALHO "
                . " WHERE "
                . " DATA_CLI_CABEC = TO_DATE('" . $cab->dataCabec . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNCIONARIO_CLI_CABEC = " . $cab->idFuncCabec . " ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabec($cab, $base) {

        $sql = "INSERT INTO CHECKLIST_INDUSTRIA_CABECALHO ("
                . " ID_CLI_CABEC "
                . " , OS_CLI_CABEC "
                . " , FUNCIONARIO_CLI_CABEC "
                . " , DATA_CLI_CABEC "
                . " , STATUS_CLI_CABEC "
                . " ) "
                . " VALUES ("
                . " INTERFACE.CABEC_CHECKLIST_SEQ.NEXTVAL "
                . " , " . $cab->idOSCabec
                . " , " . $cab->idFuncCabec
                . " , TO_DATE('" . $cab->dataCabec . "','DD/MM/YYYY HH24:MI') "
                . " , " . $cab->statusCabec
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
    public function updCabec($cab, $base) {
                
        $sql = "UPDATE CHECKLIST_INDUSTRIA_CABECALHO "
                . " SET "
                . " STATUS_CLI_CABEC = " . $cab->statusCabec
                . " WHERE "
                . " DATA_CLI_CABEC = TO_DATE('" . $cab->dataCabec . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNCIONARIO_CLI_CABEC = " . $cab->idFuncCabec;

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
