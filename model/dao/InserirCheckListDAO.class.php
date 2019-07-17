<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of InserirCheckList
 *
 * @author anderson
 */
class InserirCheckListDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab, $dadosItem) {

        $this->Conn = parent::getConn();

        $retorno = "";

        foreach ($dadosCab as $c) {

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                    . " FROM "
                    . " CHECKLIST_INDUSTRIA_CABECALHO "
                    . " WHERE "
                    . " OS_CLI_CABEC = " . $c->osCabec . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $res1 = $this->Read->fetchAll();

            foreach ($res1 as $item1) {
                $v = $item1['QTDE'];
            }

            if ($v == 0) {

                $sql = "INSERT INTO CHECKLIST_INDUSTRIA_CABECALHO ("
                        . " ID_CLI_CABEC "
                        . " , OS_CLI_CABEC "
                        . " , FUNCIONARIO_CLI_CABEC "
                        . " , DATA_CLI_CABEC "
                        . " , STATUS_CLI_CABEC "
                        . " ) "
                        . " VALUES ("
                        . " INTERFACE.CABEC_CHECKLIST_SEQ.NEXTVAL "
                        . " , " . $c->osCabec
                        . " , " . $c->idFuncCabec
                        . " , TO_DATE('" . $c->dataCabec . "','DD/MM/YYYY HH24:MI') "
                        . " , " . $c->statusCabec
                        . " )";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                $select = " SELECT "
                        . " ID_CLI_CABEC AS ID "
                        . " FROM "
                        . " CHECKLIST_INDUSTRIA_CABECALHO "
                        . " WHERE "
                        . " DATA_CLI_CABEC = TO_DATE('" . $c->dataCabec . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNCIONARIO_CLI_CABEC = " . $c->idFuncCabec . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $id = $item['ID'];
                }

                foreach ($dadosItem as $i) {

                    if ($c->idCabec == $i->idCabRespItem) {

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " CHECKLIST_INDUSTRIA_ITEM "
                                . " WHERE "
                                . " DTHR_CLI_ITEM = TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                . " AND "
                                . " ID_CAB_CLI_ITEM = " . $id
                                . " AND "
                                . " ID_IT_OS_MEC_CLI_ITEM = " . $i->idItOsMecanRespItem;

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $res3 = $this->Read->fetchAll();

                        foreach ($res3 as $item3) {
                            $v = $item3['QTDE'];
                        }

                        if ($v == 0) {

                            if ($i->obsRespItem == "null") {

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
                                        . " , " . $id
                                        . " , " . $i->idItOsMecanRespItem
                                        . " , " . $i->opcaoRespItem
                                        . " , null"
                                        . " ,  TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                        . " )";
                            } else {

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
                                        . " , " . $id
                                        . " , " . $i->idItOsMecanRespItem
                                        . " , " . $i->opcaoRespItem
                                        . " , '" . $i->obsRespItem . "' "
                                        . " ,  TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                        . " )";
                            }

                            $this->Create = $this->Conn->prepare($sql);
                            $this->Create->execute();
                        }
                    }
                }
            } else {
                
                $sql = "UPDATE CHECKLIST_INDUSTRIA_CABECALHO "
                        . " SET "
                        . " STATUS_CLI_CABEC = " . $c->statusCabec
                        . " , DATA_CLI_CABEC = TO_DATE('" . $c->dataCabec . "','DD/MM/YYYY HH24:MI') "
                        . " , FUNCIONARIO_CLI_CABEC = " . $c->idFuncCabec
                        . " WHERE "
                        . " OS_CLI_CABEC = " . $c->osCabec;

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                $select = " SELECT "
                        . " ID_CLI_CABEC AS ID "
                        . " FROM "
                        . " CHECKLIST_INDUSTRIA_CABECALHO "
                        . " WHERE "
                        . " DATA_CLI_CABEC = TO_DATE('" . $c->dataCabec . "','DD/MM/YYYY HH24:MI') "
                        . " AND "
                        . " FUNCIONARIO_CLI_CABEC = " . $c->idFuncCabec
                        . " AND "
                        . " OS_CLI_CABEC = " . $c->osCabec . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $id = $item['ID'];
                }

                foreach ($dadosItem as $i) {

                    if ($c->idCabec == $i->idCabRespItem) {

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " CHECKLIST_INDUSTRIA_ITEM "
                                . " WHERE "
                                . " DTHR_CLI_ITEM = TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                . " AND "
                                . " ID_CAB_CLI_ITEM = " . $id
                                . " AND "
                                . " ID_IT_OS_MEC_CLI_ITEM = " . $i->idItOsMecanRespItem;

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $res3 = $this->Read->fetchAll();

                        foreach ($res3 as $item3) {
                            $v = $item3['QTDE'];
                        }

                        if ($v == 0) {

                            if ($i->obsRespItem == "null") {

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
                                        . " , " . $id
                                        . " , " . $i->idItOsMecanRespItem
                                        . " , " . $i->opcaoRespItem
                                        . " , null"
                                        . " ,  TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                        . " )";
                            } else {

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
                                        . " , " . $id
                                        . " , " . $i->idItOsMecanRespItem
                                        . " , " . $i->opcaoRespItem
                                        . " , '" . $i->obsRespItem . "' "
                                        . " ,  TO_DATE('" . $i->dthrRespItem . "','DD/MM/YYYY HH24:MI') "
                                        . " )";
                            }

                            $this->Create = $this->Conn->prepare($sql);
                            $this->Create->execute();
                        }
                    }
                }
            }

            if ($c->statusCabec == 1) {
                $retorno = "GRAVOU-CLABERTO";
            } else {
                $retorno = "GRAVOU-CLFECHADO";
            }
        }

        return $retorno;
    }

}
