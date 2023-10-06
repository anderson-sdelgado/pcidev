<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of VerItemDAO
 *
 * @author anderson
 */
class ItemOSDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($idOS) {


        $select = " SELECT "
                . " ITOSMECAN_ID AS \"idItem\" "
                . " , SEQ AS \"seqItem\" "
                . " , OS_ID AS \"idOsItem\" "
                . " , COMPONENTE_ID AS \"idPlantaItem\" "
                . " , SERVICO_ID AS \"idServicoItem\" "
                . " , NVL(EQUIPCOMPO_ID, 0) AS \"idComponenteItem\" "
                . " FROM "
                . " USINAS.V_ITOS_CHECKLIST_IND "
                . " WHERE "
                . " OS_ID = " . $idOS;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
