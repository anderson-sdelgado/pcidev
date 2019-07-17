<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of ComponenteDAO
 *
 * @author anderson
 */
class ComponenteDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " EQUIPCOMPO_ID AS \"idComponente\" " 
                    . " , COMPONENTE_CD AS \"codComponente\" "
                    . " , CARACTER(COMPONENTE_DESCR) AS \"descrComponente\" " 
                . " FROM "
                    . " USINAS.V_COMPONENTE_IND ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    
    }
    
}
