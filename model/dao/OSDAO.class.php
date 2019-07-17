<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of VerOSDAO
 *
 * @author anderson
 */
class OSDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($dado) {

        $this->Conn = parent::getConn();

        $select = " SELECT "
                . " OS_ID AS \"idOS\" "
                . " , OS_NRO AS \"nroOS\" "
                . " , COMPONENTE_ID AS \"idPlantaOS\" "
                . " , PERIODO AS \"qtdeDiaOS\" "
                . " , TIPO_PERIODO AS \"descrPeriodo\" "
                . " , 0 AS \"statusOS\" "
                . " FROM "
                . " USINAS.V_OS_CHECKLIST_IND "
                . " WHERE "
                . " OFICSECAO_ID = " . $dado
                . " AND "
                . " ((PERIODO = 1 "
                . " AND "
                . " SYSDATE BETWEEN DT_INI_TURNO and DT_FIM_TURNO) "
                . " OR "
                . " (PERIODO > 1 "
                . " AND " 
                . " SYSDATE BETWEEN DT_PREV_INIC AND DT_PREV_TERM_CALC))"
                ;

        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

}
