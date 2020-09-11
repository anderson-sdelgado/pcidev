<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of ItemDAO
 *
 * @author anderson
 */
class RespItemDAO extends Conn {

    public function verifRespItem($idCab, $item, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " CHECKLIST_INDUSTRIA_ITEM "
                . " WHERE "
                . " DTHR_CLI_ITEM = TO_DATE('" . $item->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " ID_CAB_CLI_ITEM = " . $idCab
                . " AND "
                . " ID_IT_OS_MEC_CLI_ITEM = " . $item->idItOsMecanRespItem;

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

    public function insRespItem($idCab, $item, $base) {

        if ($item->obsRespItem == "null") {
            $obs = "null";
        }
        else{
            $obs = "'" . $item->obsRespItem . "'";
        }
        
        $sql = " INSERT INTO CHECKLIST_INDUSTRIA_ITEM ( "
                . " ID_CLI_ITEM "
                . " , ID_CAB_CLI_ITEM "
                . " , ID_IT_OS_MEC_CLI_ITEM"
                . " , OPCAO_CLI_ITEM "
                . " , OBSERVACAO_CLI_ITEM "
                . " , DTHR_CLI_ITEM "
                . " ) "
                . " VALUES ("
                . " INTERFACE.ITEM_CHECKLIST_SEQ.NEXTVAL "
                . " , " . $idCab
                . " , " . $item->idItOsMecanRespItem
                . " , " . $item->opcaoRespItem
                . " , " . $obs
                . " ,  TO_DATE('" . $item->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
