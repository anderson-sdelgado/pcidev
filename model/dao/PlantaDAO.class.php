<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('./dbutil/Conn.class.php');
/**
 * Description of PlantaDAO
 *
 * @author anderson
 */
class PlantaDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " COMPONENTE_ID AS \"idPlanta\" "
                    . " , PLANTA_CD AS \"codPlanta\" "
                    . " , CARACTER(PLANTA_DESCR) AS \"descrPlanta\" "
                . " FROM "
                    . " USINAS.V_PLANTAS_CHECKLIST_IND ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
